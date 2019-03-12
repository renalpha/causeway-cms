<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostCommentRequest;
use App\Models\Notification;
use Carbon\Carbon;
use Domain\Entities\Forum\Thread;
use Domain\Services\CommentService;

/**
 * Class CommentController
 * @package App\Http\Controllers\
 */
class CommentController extends Controller
{
    /**
     * @var CommentService
     */
    protected $commentService;

    /**
     * CommentController constructor.
     * @param CommentService $commentService
     */
    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    /**
     * @param PostCommentRequest $request
     * @param string $type
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function comment(PostCommentRequest $request, string $type, string $id)
    {
        switch ($type) {
            case 'groupNotification':
                $notification = Notification::where('id', $id)->firstOrFail();
                auth()->user()->commentOn($notification, $id, [
                    'comment' => clean($request->comment),
                    'profile_picture' => '/images/' . auth()->user()->profile_picture,
                    'name' => auth()->user()->name,
                ]);
                break;
            case 'Comment':
                break;
            case 'photoAlbumComment':
                break;
            case 'photoComment':
                break;
            case Thread::class:
                $thread = Thread::find($id);
                auth()->user()->commentOn($thread, $id, [
                    'comment' => $request->comment,
                    'formatted_date' => Carbon::now()->diffForHumans(),
                    'profile_picture' => '/images/' . auth()->user()->profile_picture,
                    'name' => auth()->user()->name,
                ]);
                break;
        }

        $request->session()->flash('info', 'Comment posted.');

        return redirect()
            ->back();
    }
}