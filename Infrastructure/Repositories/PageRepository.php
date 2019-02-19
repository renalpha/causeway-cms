<?php

namespace Infrastructure\Repositories;

use Domain\Entities\Page\Page;

/**
 * Class PageRepository
 * @package Infrastructure\Repositories
 */
class PageRepository extends AbstractRepository
{
    /**
     * PageRepository constructor.
     * @param Page $model
     */
    public function __construct(Page $model)
    {
        parent::__construct($model);
    }
}