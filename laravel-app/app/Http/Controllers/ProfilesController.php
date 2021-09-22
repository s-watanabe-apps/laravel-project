<?php

namespace App\Http\Controllers;

use App\Models\Articles;
use App\Models\Users;
use App\Models\ProfileImages;
use App\Models\Favorites;
use App\Models\Profiles;
use App\Models\ProfileValues;
use App\Models\Images;
use App\Models\VisitedUsers;
use App\Http\Requests\ProfilePostRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class ProfilesController extends Controller
{
    /**
     * Member list.
     * 
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
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
    public function get(Request $request)
    {
        if ($request->filled('id') || !is_numeric($request->id)) {
            return view('404');
        }

        $profileUser = Users::getById($request->id);
        if ($profileUser == null) {
            abort(404);
        }

        $articles = Articles::getArticleHeadlines($request->id, 20);

        $isFavorite = $this->isFavorite($request);

        $isMine = $request->id == $request->user->id;
/*
        if ($isMine) {
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
    public function edit(Request $request)
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
     * Save profile.
     * 
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\View\View
     */
    public function post(ProfilePostRequest $request)
    {
        $profileValues = ProfileValues::getProfileValuesHashByUserId($request->user->id);
        $inputValues = $request->validated();

        \DB::beginTransaction();
        try {
            if (isset($inputValues['choose_profile_image'])) {
                $file = $inputValues['choose_profile_image'];
                $extension = Images::getExtensions()[$file->getMimetype()];
                $fileName = "profiles/" . $request->user->id . '.' . $extension;
                $file->storeAs('contents/images/', $fileName);
        
                ProfileImages::insert([
                    'user_id' => $request->user->id,
                    'file' => urlencode($fileName),
                ]);

                unset($inputValues['choose_profile_image']);
            }

            $request->user->saveUsers($inputValues);

            ProfileValues::saveProfileValues(
                $request->user->id, $inputValues['dynamic_values']);

            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollback();
            \Log::error($e->getMessage());
            abort(500);
        }

        return redirect()->route('profiles.get', ['id' => $request->user->id])->with('result', 1);
    }
}
