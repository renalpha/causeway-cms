<?php

namespace Infrastructure\Repositories;

use Domain\Entities\User\User;

/**
 * Class UserRepository
 * @package Infrastructure\Repositories
 */
class UserRepository extends AbstractRepository
{
    /**
     * GroupRepository constructor.
     * @param User $model
     */
    public function __construct(User $model)
    {
        parent::__construct($model);
    }
}