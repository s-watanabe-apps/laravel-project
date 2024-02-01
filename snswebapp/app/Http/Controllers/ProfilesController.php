<?php
namespace App\Http\Controllers;

use App\Models\Favorites;
use App\Models\VisitedUsers;
use App\Services\ArticlesService;
use App\Services\FavoritesService;
use App\Services\ProfilesService;
use App\Services\UsersService;
use App\Services\GroupsService;
use App\Http\Requests\ProfilesRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class ProfilesController extends Controller
{
    // Instance variables.
    private $articlesService;
    private $favoritesService;
    private $profilesService;
    private $usersService;
    private $groupsService;

    /**
     * Create a new controller instance.
     *
     * @param App\Services\ArticlesService
     * @param App\Services\FavoritesService
     * @param App\Services\ProfilesService
     * @param App\Services\UsersService
     * @return void
     */
    public function __construct(
        ArticlesService $articlesService,
        FavoritesService $favoritesService,
        ProfilesService $profilesService,
        UsersService $usersService,
        GroupsService $groupsService
    ) {
        $this->articlesService = $articlesService;
        $this->favoritesService = $favoritesService;
        $this->profilesService = $profilesService;
        $this->usersService = $usersService;
        $this->groupsService = $groupsService;
    }

    /**
     * ユーザー一覧.
     * 
     * @param Illuminate\Http\Request
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
        $validator = Validator::make([
            'keyword' => $request->keyword,
            'group_code' => $request->group_code,
            'page' => $request->page,
        ], [
            'keyword' => 'string|nullable',
            'group_code' => 'string|nullable',
            'page' => 'integer|nullable',
        ]);
        if ($validator->fails()) {
            abort(404);
        }

        $validated = $validator->validated();

        $page = $validated['page'] ?? 1;
        $profile_users = $this->usersService->get_enabled_users($validated['keyword'], $validated['group_code']);
        $profile_users = $this->pager($profile_users, 10, $page, '/members/');
        
        $groups = $this->groupsService->all();

        return view('profiles.index', compact(
            'profile_users',
            'groups',
            'validated'
        ));
    }

    /**
     * ユーザープロフィール.
     * 
     * @param Illuminate\Http\Request
     * @return Illuminate\View\View
     */
    public function get(Request $request)
    {
        if ($request->filled('id') || !is_numeric($request->id)) {
            return view('404');
        }

        $profiles = $this->usersService->get($request->id);
        if ($profiles == null) {
            abort(404);
        }

        $articles = $this->articlesService->get_latest_articles_by_user_id($request->id);

        $isFavorite = $this->favoritesService->isFavorite($request);

        $user_profiles = $this->profilesService->get_user_profiles($request->id);

        return view('profiles.viewer', compact(
            'profiles',
            'user_profiles',
            'articles',
            'isFavorite'
        ));
    }

    /**
     * プロフィール編集.
     * 
     * @param Illuminate\Http\Request
     * @return Illuminate\View\View
     */
    public function edit(Request $request)
    {
        $profiles = user();

        $user_profiles = $this->profilesService->get_user_profiles(user()->id);

        $choices = $this->profilesService->get_profile_choices_hash();

        return view('profiles.editor', compact(
            'profiles',
            'user_profiles',
            'choices'
        ));
    }

    /**
     * Save profile values.
     * 
     * @param App\Http\Requests\ProfilesRequest
     * @return Illuminate\View\View
     */
    public function register(ProfilesRequest $request)
    {
        $params = $request->validated();

        \DB::transaction(function() use ($params) {
            $this->profilesService->save($params);
        });

        return redirect()->route('profiles.get', ['id' => user()->id])->with('result', 1);
    }
}
