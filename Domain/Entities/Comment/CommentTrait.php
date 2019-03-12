<?php

namespace Domain\Entities\Comment;

use Domain\Services\CommentService;
use Infrastructure\Repositories\CommentRepository;

/**
 * Trait CommentTrait
 * @package Domain\Entities\Comment
 */
trait CommentTrait
{
    /**
     * @return mixed
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')
            ->orderBy('created_at', 'desc');
    }

    /**
     * @param $object
     * @param $id
     * @param $data
     */
    public function commentOn($object, $id, $data)
    {
        $comment = new CommentService(new CommentRepository(new Comment()));

        $comment->commentSubjectByTypeAndId($object, $id, $data);
    }
}