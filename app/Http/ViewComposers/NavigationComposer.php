<?php

namespace App\Http\ViewComposers;

use Domain\Entities\Menu\Menu;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class NavigationComposer
 * @package App\Http\ViewComposers
 */
class NavigationComposer
{
    /**
     * @param $view
     */
    public function compose($view)
    {
        $siteMenu = Menu::where('name', 'site-menu')
            ->getParents()
            ->firstOrFail();

        $view->with('site_menu', $siteMenu);
    }
}