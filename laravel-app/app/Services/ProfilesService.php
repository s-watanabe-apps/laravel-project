<?php

namespace App\Services;

use App\Models\Profiles;
use App\Models\ProfileChoices;
use App\Libs\ProfileInputType;
use Illuminate\Support\Facades\DB;

class ProfilesService
{
    /**
     * Get user profiles.
     * 
     * @param int
     * @return array
     */
    public function getUserProfiles($userId)
    {
        $subQuery = Profiles::query()->select([
                'profiles.id',
                'profiles.type',
                'profiles.name',
                'profiles.required',
                'profile_choices.id as profile_choice_id',
                'profile_choices.name as value',
                'profile_values.user_id',
                'profiles.order',
            ])->leftJoin('profile_values', function ($join) use ($userId) {
                $join->on('profiles.id', '=', 'profile_values.profile_id')
                    ->where('profile_values.user_id', $userId);
            })
            ->leftJoin('profile_choices', 'profile_values.value', '=', 'profile_choices.id')
            ->where('profiles.type', ProfileInputType::CHOICE);

        $query = Profiles::query()->select([
                'profiles.id',
                'profiles.type',
                'profiles.name',
                'profiles.required',
                DB::raw('null as profile_choice_id'),
                'profile_values.value',
                'profile_values.user_id',
                'profiles.order',
            ])->leftJoin('profile_values', function ($join) use ($userId) {
                $join->on('profiles.id', '=', 'profile_values.profile_id')
                    ->where('profile_values.user_id', $userId);
            })
            ->whereIn('profiles.type', [ProfileInputType::FILLIN, ProfileInputType::DESCRIPTION,])
            ->union($subQuery);

        return DB::table($query)->select([
                'id', 'type', 'name', 'required', 'user_id', 'profile_choice_id', 'value', 'order'
            ])->orderBy('order', 'asc')
            ->get()->toArray();
    }

    /**
     * Get profile choices hash.
     * 
     * @return array [profiles.id => [profile_choices.id => profile_choices.name]]
     */
    public function getProfileChoicesHash()
    {
        $results = Profiles::query()->select([
                'profiles.id',
                'profile_choices.id as choice_id',
                'profile_choices.name',
            ])->join('profile_choices', 'profiles.id', '=', 'profile_choices.profile_id')
            ->get();

        $choices = [];
        foreach ($results as $choice) {
            $choices[$choice->id][$choice->choice_id] = $choice->name;
        }

        return $choices;
    }

    /**
     * getProfilesHash
     * 
     * @return array [profiles.id => App\Models\Profiles]
     */
    public function getProfilesHash()
    {
        $profiles = Profiles::query()->orderBy('order')->get();

        $hash = [];
        foreach ($profiles as $profile) {
            $hash[$profile->id] = $profile;
        }

        return $hash;
    }

    public function getProfiles()
    {
        $profiles = Profiles::query()->orderBy('order')->get();

        foreach ($profiles as &$profile) {
            if ($profile->type == ProfileInputType::CHOICE) {
                $profile->choices = ProfileChoices::where('profile_id', $profile->id)->get();
            }
        }

        return $profiles;
    }
}
