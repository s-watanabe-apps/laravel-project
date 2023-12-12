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
     * Get user list.
     * 
     * @param Illuminate\Http\Request
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
        $validator = Validator::make([
            'keyword' => $request->keyword,
            'group_code' => $request->group_code
        ], [
            'keyword' => 'string|nullable',
            'group_code' => 'string|nullable',
        ]);
        if ($validator->fails()) {
            abort(422);
        }

        $validated = $validator->validated();

        $profileUsers = $this->usersService->getEnabledUsers($validated['keyword'], $validated['group_code']);

        $groups = $this->groupsService->all();

        return view('profiles.index', compact(
            'profileUsers',
            'groups',
            'validated'
        ));
    }

    /**
     * Get profile.
     * 
     * @param Illuminate\Http\Request
     * @return Illuminate\View\View
     */
    public function get(Request $request)
    {
        if ($request->filled('id') || !is_numeric($request->id)) {
            return view('404');
        }

        $profileUser = $this->usersService->get($request->id);
        if ($profileUser == null) {
            abort(404);
        }

        $articles = $this->articlesService->getLatestArticlesByUserId($request->id);

        $isFavorite = $this->favoritesService->isFavorite($request);

        $userProfiles = $this->profilesService->getUserProfiles($request->id);

        return view('profiles.viewer', compact(
            'profileUser',
            'userProfiles',
            'articles',
            'isFavorite'
        ));
    }

    /**
     * Edit profile.
     * 
     * @param Illuminate\Http\Request
     * @return Illuminate\View\View
     */
    public function edit(Request $request)
    {
        $birthDate = $this->usersService->getBirthDate(user()->birthdate);

        $profileUser = user();

        $userProfiles = $this->profilesService->getUserProfiles(user()->id);

        $choices = $this->profilesService->getProfileChoicesHash();

        return view('profiles.editor', compact(
            'profileUser',
            'birthDate',
            'userProfiles',
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
