<?php

namespace Infrastructure\Repositories;

use Domain\Entities\Comment\Comment;

/**
 * Class CommentRepository
 * @package Infrastructure\Repositories
 */
class CommentRepository extends AbstractRepository
{
    /**
     * GroupRepository constructor.
     * @param Comment $model
     */
    public function __construct(Comment $model)
    {
        parent::__construct($model);
    }
}