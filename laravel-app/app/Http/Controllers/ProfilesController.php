<?php

namespace App\Http\Controllers;

use App\Models\Articles;
use App\Models\Users;
use App\Models\Favorites;
use App\Models\Profiles;
use App\Models\ProfileValues;
use App\Models\Images;
use App\Models\VisitedUsers;
use App\Http\Requests\AppRequest;
use App\Http\Requests\ProfilePostRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class ProfilesController extends Controller
{
    /**
     * Get user list.
     * 
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\View\View
     */
    public function index(AppRequest $request)
    {
        $profileUsers = Users::getUsers();

        return view('profiles.index', compact(
            'profileUsers'
        ));
    }

    /**
     * Get profile.
     * 
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\View\View
     */
    public function get(AppRequest $request)
    {
        if ($request->filled('id') || !is_numeric($request->id)) {
            return view('404');
        }

        $profileUser = Users::getUser($request->id);
        if ($profileUser == null) {
            abort(404);
        }

        $articles = Articles::getArticleHeadlines($request->id, 20);

        $isFavorite = $this->isFavorite($request);

        $isSelf = $request->id == $request->user->id;
/*
        if ($isSelf) {
            $visitedUsers = VisitedUsers::getVisitedUsers($request->user->id);
        } else {
            VisitedUsers::visit($request->id, $request->user->id);
        }
*/

        $userProfiles = Profiles::getUserProfiles($request->id);

        return view('profiles.get', compact(
            'profileUser',
            'userProfiles',
            'articles',
            'isFavorite'
        ));
    }

    /**
     * Edit profile.
     * 
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\View\View
     */
    public function edit(AppRequest $request)
    {
        $birthDate = $request->user->getBirthDate();

        $profileUser = $request->user;

        $userProfiles = Profiles::getUserProfiles($request->user->id);

        $choices = Profiles::getProfileChoicesHash();

        return view('profiles.edit', compact(
            'profileUser',
            'birthDate',
            'userProfiles',
            'choices'
        ));
    }

    /**
     * Save profile values.
     * 
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\View\View
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

            $request->user->saveUsers($inputValues);

            ProfileValues::saveProfileValues(
                $request->user->id, $inputValues['dynamic_values']);
        });

        return redirect()->route('profiles.get', ['id' => $request->user->id])->with('result', 1);
    }
}
