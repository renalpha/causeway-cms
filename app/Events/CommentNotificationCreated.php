<?php

namespace App\Events;

use App\Exceptions\CommentNotificationException;
use App\Models\Notification;
use Domain\Entities\Comment\Comment;
use Domain\Entities\Forum\Thread;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * Class PandaGroupCommentCreated
 *
 * @package App\Events
 */
class CommentNotificationCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var Comment
     */
    protected $comment;

    /**
     * PandaGroupCommentCreated constructor.
     *
     * @param Comment $comment
     */
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastWith()
    {
        return [
            'comment' => $this->comment->toArray(),
        ];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        $channel = null;
        switch ($this->comment->commentable_type) {
            case Thread::class:
                $channel = 'users.notification.thread.' . $this->comment->commentable_id;
                break;
            case Notification::class:

                break;
        }

        return new PrivateChannel($channel);
    }
}