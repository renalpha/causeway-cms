<?php

namespace Infrastructure\Repositories;

use Domain\Entities\Forum\Category;
use Domain\Entities\Menu\Menu;

/**
 * Class ForumCategoryRepository
 * @package Infrastructure\Repositories
 */
class ForumCategoryRepository extends AbstractRepository
{
    /**
     * PageRepository constructor.
     * @param Menu $model
     */
    public function __construct(Category $model)
    {
        parent::__construct($model);
    }
}