<?php
namespace App\Services;

use App\Models\Images;
use App\Models\Profiles;
use App\Models\ProfileChoices;
use App\Models\ProfileValues;
use App\Models\Users;
use App\Libs\ProfileInputType;
use App\Services\UsersService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class ProfilesService extends Service
{
    /**
     * 基本クエリ.
     * 
     * @return Illuminate\Database\Eloquent\Builder
     */
    private function base()
    {
        return Profiles::query()
            ->select([
                'profiles.*',
            ]);
    }

    /**
     * Get user profiles.
     * 
     * @param int
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getUserProfiles($user_id)
    {
        $subQuery = $this->base()->addSelect([
                'profile_choices.id as profile_choice_id',
                'profile_choices.name as value',
                'profile_values.user_id',
            ])->leftJoin('profile_values', function ($join) use ($user_id) {
                $join->on('profiles.id', '=', 'profile_values.profile_id')
                    ->where('profile_values.user_id', $user_id);
            })->leftJoin('profile_choices', 'profile_values.value', '=', 'profile_choices.id')
            ->where('profiles.type', ProfileInputType::CHOICE);

        $query = $this->base()
            ->addSelect([
                DB::raw('null as profile_choice_id'),
                'profile_values.value',
                'profile_values.user_id',
            ])->leftJoin('profile_values', function ($join) use ($user_id) {
                $join->on('profiles.id', '=', 'profile_values.profile_id')
                    ->where('profile_values.user_id', $user_id);
            })
            ->whereIn('profiles.type', [ProfileInputType::FILLIN, ProfileInputType::DESCRIPTION,])
            ->union($subQuery);

        $data = DB::table($query)->select([
                'id',
                'type',
                'name',
                'required',
                'user_id',
                'profile_choice_id',
                'value',
                'order'
            ])->orderBy('order', 'asc')
            ->get()
            ->toArray();
        
        return array_map(function($value) {
            return (array) $value;
        }, $data);
    }

    /**
     * プロフィール設定項目取得.
     * 
     * @return array
     */
    public function getProfileChoicesHash()
    {
        $results = $this->base()
            ->select([
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
     * プロフィール一覧ハッシュ取得.
     * 
     * @return array
     */
    public function getProfilesHash()
    {
        $profiles = $this->base()->orderBy('order')->get();

        $hash = [];
        foreach ($profiles as $profile) {
            $hash[$profile->id] = $profile;
        }

        return $hash;
    }

    /**
     * プロフィール設定項目取得.
     * 
     * @return array
     */
    public function getProfileItems()
    {
        $data = $this->base()
            ->addSelect([
                'profiles.order',
            ])
            ->orderBy('order')
            ->get()
            ->toArray();

        $profiles = array_map(function($value) {
            if ($value['type'] == ProfileInputType::CHOICE) {
                $value['choices'] = ProfileChoices::where('profile_id', $value['id'])->get()->toArray();
            }
            return $value;
        }, $data);

        return $profiles;
    }

    /**
     * プロフィール保存.
     * 
     * @params array $params
     */
    public function save($params)
    {
        $users = (new Users())->find(user()->id);

        if (isset($params['image_file'])) {
            $id = sprintf('%06d', user()->id);
            $hash = base64_encode(substr(Hash::make($id), -27));
            $file = $params['image_file'];
            $extension = Images::getExtensions()[$file->getMimetype()];
            $fileName = sprintf('profiles/image-%s-%s.%s', $id, $hash, $extension);
    
            $file->storeAs('contents/images/', $fileName);
            $users->image_file = urlencode($fileName);
        } else if (($params['image_file_clear'] ?? 0) == 1) {
            $users->image_file = null;
        }
        
        $users->name = $params['name'];
        if (isset($params['name_kana']))
            $users->name_kana = $params['name_kana'];
        if (isset($params['birth_date']))
            $users->birthdate = $params['birth_date'];
        $users->save();
        
        ProfileValues::save_profile_values(user()->id, $params['dynamic_values']);

        $key = sprintf(Service::CACHE_KEY_USERS_BY_ID, user()->id);
        $this->cacheForget($key);
    }
}
