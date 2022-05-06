<?php

namespace App\Http\Controllers;

use App\Models\Messages;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    private static function getSizes($userId)
    {
        $inbox = Messages::getByUserId($userId)->count();
        $outbox = Messages::getByFromUserId($userId)->count();
        $garbage = 0;

        return compact('inbox', 'outbox', 'garbage');
    }

    public static function inbox(Request $request)
    {
        $messages = Messages::getByUserId($request->user->id);

        return view('messages.inbox', compact(
            'messages'
        ) + [
            'index' => 1,
            'sizes' => self::getSizes($request->user->id),
        ]);
    }

    public static function get(Request $request)
    {
        $message = Messages::getByUserIdAndMessageId($request->user->id, $request->id);
        if (is_null($message)) {
            abort(404);
        }

        if (!$message->enable) {
            $backlink = [
                'name' => __('strings.garbage'),
                'link' => '/messages/inbox',
            ];
        } else if ($request->user->id == $message->to_user_id) {
            $backlink = [
                'name' => __('strings.outbox'),
                'link' => '/messages/outbox',
            ];
        } else {
            $backlink = [
                'name' => __('strings.inbox'),
                'link' => '/messages/inbox',
            ];
        }

        if (!$message->readed) {
            $message->readed = true;
            $message->save();
        }

        $fromUserMessages = Messages::getByUserIdAndFromUserId($request->user->id, $message->from_user_id);

        return view('messages.get', compact(
            'message',
            'backlink',
            'fromUserMessages'
        ) + [
            'index' => 1,
            'sizes' => self::getSizes($request->user->id),
        ]);
    }
}
