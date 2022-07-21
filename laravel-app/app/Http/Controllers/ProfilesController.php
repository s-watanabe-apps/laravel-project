<?php

namespace App\Http\Controllers;

use App\Models\Favorites;
use App\Models\ProfileValues;
use App\Models\Images;
use App\Models\VisitedUsers;
use App\Services\ArticlesService;
use App\Services\FavoritesService;
use App\Services\ProfilesService;
use App\Services\UsersService;
use App\Http\Requests\ProfilePostRequest;
use Carbon\Carbon;
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
        UsersService $usersService
    ) {
        $this->articlesService = $articlesService;
        $this->favoritesService = $favoritesService;
        $this->profilesService = $profilesService;
        $this->usersService = $usersService;
    }

    /**
     * Get user list.
     * 
     * @param Illuminate\Http\Request
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
        $profileUsers = $this->usersService->getUsers();

        return view('profiles.index', compact(
            'profileUsers'
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

        $profileUser = $this->usersService->getUser($request->id);
        if ($profileUser == null) {
            abort(404);
        }

        $articles = $this->articlesService->getArticleHeadlines($request->id, 20);

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
        $birthDate = $this->usersService->getBirthDate($request->user->birthdate);

        $profileUser = $request->user;

        $userProfiles = $this->profilesService->getUserProfiles($request->user->id);

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
     * @param App\Http\Requests\ProfilePostRequest
     * @return Illuminate\View\View
     */
    public function post(ProfilePostRequest $request)
    {
        $profileValues = ProfileValues::getProfileValuesHashByUserId($request->user->id);
        $inputValues = $request->validated();

        \DB::transaction(function() use ($request, $profileValues, $inputValues) {
            if (isset($inputValues['choose_profile_image'])) {
                $file = $inputValues['choose_profile_image'];
                $extension = Images::getExtensions()[$file->getMimetype()];
                $fileName = "profiles/" . $request->user->id . '.' . $extension;
                $file->storeAs('contents/images/', $fileName);
                $inputValues['image_file'] = urlencode($fileName);
            }

            $request->user->save($inputValues, $request->user->id);

            ProfileValues::saveProfileValues(
                $request->user->id, $inputValues['dynamic_values']);
        });

        return redirect()->route('profiles.get', ['id' => $request->user->id])->with('result', 1);
    }
}
