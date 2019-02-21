<?php

namespace Domain\Services;

use Infrastructure\Repositories\MenuRepository;
use Infrastructure\Repositories\SoundRepository;

/**
 * Class MenuService
 * @package Domain\Services
 */
class MenuService extends AbstractService
{
    /**
     * SoundService constructor.
     * @param MenuRepository $menuRepository
     */
    public function __construct(MenuRepository $menuRepository)
    {
        $this->repository = $menuRepository;
    }
}