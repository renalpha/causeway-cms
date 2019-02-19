<?php

namespace Domain\Entities\Comment;

use Domain\Common\AggregateRoot;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Rennokki\Befriended\Contracts\Likeable;
use Rennokki\Befriended\Traits\CanBeLiked;

/**
 * Class Comment
 * @package Domain\Entities\Comments
 */
class Comment extends AggregateRoot implements Likeable
{
    use CanBeLiked;

    /**
     * @var string
     */
    protected $table = 'comments';

    /**
     * @var array
     */
    protected $appends = ['created_at_humans'];

    /**
     * Mass assign vars.
     *
     * @var array
     */
    protected $fillable = ['commentable_id', 'commentable_type', 'user_id', 'data'];

    /**
     * Get all of the owning commentable models.
     */
    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Get comment.
     *
     * @return string
     */
    public function getCommentAttribute()
    {
        return json_decode($this->data, false)->comment;
    }

    /**
     * Get comment.
     *
     * @return string
     */
    public function getNameAttribute()
    {
        try {
            return json_decode($this->data, false)->name;
        } catch (\Exception $e) {
            return 'Anonymous';
        }
    }
}