<?php

namespace App\Http\Controllers;

use App\Services\MessagesService;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    // Instance variables.
    private $articlesService;

    /**
     * Constructor.
     *
     * @param App\Services\MessagesService
     * @return void
     */
    public function __construct(
        MessagesService $messagesService
    ) {
        $this->messagesService = $messagesService;
    }

    private function getSizes($userId)
    {
        $inbox = $this->messagesService->getByUserId($userId)->count();
        $outbox = $this->messagesService->getByFromUserId($userId)->count();
        $garbage = 0;

        return compact('inbox', 'outbox', 'garbage');
    }

    public function inbox(Request $request)
    {
        $messages = $this->messagesService->getByUserId($request->user->id);

        return view('messages.inbox', compact(
            'messages'
        ) + [
            'index' => 1,
            'sizes' => $this->getSizes($request->user->id),
        ]);
    }

    public function get(Request $request)
    {
        $message = $this->messagesService->getByUserIdAndMessageId($request->user->id, $request->id);
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

        $fromUserMessages = $this->messagesService->getByUserIdAndFromUserId($request->user->id, $message->from_user_id);

        return view('messages.get', compact(
            'message',
            'backlink',
            'fromUserMessages'
        ) + [
            'index' => 1,
            'sizes' => $this->getSizes($request->user->id),
        ]);
    }
}
