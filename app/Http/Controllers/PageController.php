<?php

namespace App\Http\Controllers;

use Domain\Entities\Page\Page;

class PageController extends Controller
{
    /**
     * @param Page $pageSlug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getSlug(Page $pageSlug)
    {
        // Default page view
        $pageView = 'page.default';

        // Find if custom page exists by slug and use that page
        if (view()->exists('page.custom.' . $pageSlug->slug)) {
            $pageView = 'page.custom.' . $pageSlug->slug;
        }

        return view($pageView, [
            'page' => $pageSlug,
        ]);
    }
}