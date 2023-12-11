<?php
namespace App\Services;

use App\Models\PictureComments;

class PictureCommentsService extends Service
{
    /**
     * Get base query builder.
     * 
     * @return Illuminate\Database\Eloquent\Builder
     */
    private function base()
    {
        return PictureComments::query()->select([
                'picture_comments.id',
                'picture_comments.picture_id',
                'picture_comments.user_id',
                \DB::raw('users.name as user_name'),
                'picture_comments.comment',
                'picture_comments.created_at',
                'picture_comments.updated_at',
                'picture_comments.deleted_at',
            ])
            ->leftJoin('users', 'picture_comments.user_id', '=', 'users.id');
    }

    public function getByPictureId($pictureId)
    {
        return $this->base()
            ->where('picture_id', $pictureId)
            ->orderBy('picture_comments.created_at')
            ->get();
    }

    public function save($userId, $params)
    {
        $pictureComments = new PictureComments();

        $pictureComments->user_id = $userId;
        $pictureComments->picture_id = $params['id'];
        $pictureComments->comment = $params['comment'];

        $pictureComments->save();
    }
}
