<?php

namespace Infrastructure\Repositories;

use Domain\Entities\Menu\Menu;
use Domain\Entities\Menu\MenuItem;

/**
 * Class MenuItemRepository
 * @package Infrastructure\Repositories
 */
class MenuItemRepository extends AbstractRepository
{
    /**
     * PageRepository constructor.
     * @param MenuItem $model
     */
    public function __construct(MenuItem $model)
    {
        parent::__construct($model);
    }
}