<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostPageRequest;
use Domain\Entities\Page\Page;
use Domain\Services\PageService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PageController extends Controller
{
    /**
     * @var PageService
     */
    protected $pageService;

    /**
     * PageController constructor.
     * @param PageService $pageService
     */
    public function __construct(PageService $pageService)
    {
        $this->pageService = $pageService;
    }

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
        return view('admin.pages.update', [
            'page' => $page,
        ]);
    }

    /**
     * @param PostPageRequest $request
     * @param Page $page
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update(PostPageRequest $request, Page $page)
    {
        return $this->store($request, $page);
    }

    /**
     * @param PostPageRequest $request
     * @param Page|null $page
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function store(PostPageRequest $request, Page $page = null)
    {
        $page = $this->pageService->savePage($request, $page->id ?? null);

        $request->session()->flash('status', 'Page ' . $page->name . ' created');

        return redirect()
            ->to(route('admin.pages.index'));

    }

    /**
     * @param Request $request
     * @param Page $page
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Request $request, Page $page)
    {
        $page->delete();
        return redirect()->back();
    }

    /**
     * Get Datatables.
     *
     * @return mixed
     * @throws \Exception
     */
    public function getAjaxPages()
    {
        $pages = Page::get();

        return Datatables::of($pages)
            ->addColumn('name', function ($row) {
                return $row->name;
            })
            ->addColumn('url', function ($row) {
                return $row->slug;
            })
            ->addColumn('access_level', function ($row) {
                return $row->access_level;
            })
            ->addColumn('manage', function ($row) {
                return '<a href="' . route('admin.pages.update', ['id' => $row->id]) . '" class="btn btn-sm btn-warning">Edit</a>
                        <a href="' . route('admin.pages.remove', ['id' => $row->id]) . '" class="btn btn-sm btn-danger">Remove</a>
                        ';
            })
            ->rawColumns(['name', 'url', 'access_level', 'manage'])
            ->make(true);
    }

}
