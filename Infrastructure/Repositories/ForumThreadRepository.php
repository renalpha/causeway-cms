<?php

namespace Infrastructure\Repositories;

use Domain\Entities\Forum\Thread;

/**
 * Class ForumThreadRepository
 * @package Infrastructure\Repositories
 */
class ForumThreadRepository extends AbstractRepository
{
    /**
     * PageRepository constructor.
     * @param Thread $model
     */
    public function __construct(Thread $model)
    {
        parent::__construct($model);
    }
}