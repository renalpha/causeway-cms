<?php

namespace Infrastructure\Repositories;

use Domain\Entities\Menu\Menu;

/**
 * Class MenuRepository
 * @package Infrastructure\Repositories
 */
class MenuRepository extends AbstractRepository
{
    /**
     * PageRepository constructor.
     * @param Menu $model
     */
    public function __construct(Menu $model)
    {
        parent::__construct($model);
    }
}