<?php

namespace Domain\Services;

use Illuminate\Http\Request;
use Infrastructure\Repositories\MenuItemRepository;
use Infrastructure\Repositories\MenuRepository;
use Infrastructure\Repositories\SoundRepository;

/**
 * Class MenuService
 * @package Domain\Services
 */
class MenuService extends AbstractService
{
    /**
     * @var MenuItemRepository
     */
    protected $menuitemRepository;

    /**
     * SoundService constructor.
     * @param MenuRepository $menuRepository
     * @param MenuItemRepository $menuItemRepository
     */
    public function __construct(MenuRepository $menuRepository, MenuItemRepository $menuItemRepository)
    {
        $this->menuitemRepository = $menuItemRepository;
        $this->repository = $menuRepository;
    }

    /**
     * @param array $match
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function updateOrCreateItem(array $match, Request $request)
    {
        $this->repository = $this->menuitemRepository;

        $request->request->add([
            'en' => $request->only(['label', 'url'])
        ]);

        return parent::updateOrCreate($match, $request->only(['menu_id', 'access_level', 'en']));
    }
}