<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostPageRequest;
use Domain\Entities\Page\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.pages.index');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.pages.new');
    }

    /**
     * @param Request $request
     * @param Page $page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Request $request, Page $page)
    {
        return view('admin.pages.edit', [
            'page' => $page
        ]);
    }

    public function update(PostPageRequest $request, Page $page)
    {
        $page = $this->store($request, $page);
    }

    public function store(PostPageRequest $request, Page $page = null)
    {

    }
}
