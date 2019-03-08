<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostForumCategoryRequest;
use Domain\Entities\Forum\Category;
use Domain\Services\ForumService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class MenuController
 * @package App\Http\Controllers\Admin
 */
class ForumController extends Controller
{
    /** @var ForumService */
    protected $forumService;

    /**
     * EventController constructor.
     * @param ForumService $forumService
     */
    public function __construct(ForumService $forumService)
    {
        $this->forumService = $forumService;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.forum.index');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.forum.new', [
            'forumCategories' => Category::getParents()->pluck('title', 'id')->toArray(),
        ]);
    }

    /**
     * @param Request $request
     * @param Category $forum
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Request $request, Category $forum)
    {
        return view('admin.forum.update', [
            'forumCategories' => Category::getParents()->pluck('title', 'id')->toArray(),
            'category' => $forum,
        ]);
    }

    /**
     * @param PostForumCategoryRequest $request
     * @param Category|null $forum
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PostForumCategoryRequest $request, Category $forum = null)
    {
        $this->forumService->updateOrCreateCategory([
            'id' => $forum->id ?? null,
        ], $request->only([
            'title',
            'slug',
            'description',
            'parent_id',
        ]));

        $request->session()->flash('status', isset($forum->id) && $forum->id !== null ? 'Category has successfully been updated!' : 'Category has successfully been created!');

        return redirect()
            ->route('admin.forum.index');
    }

    /**
     * @param PostForumCategoryRequest $request
     * @param Category $forum
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PostForumCategoryRequest $request, Category $forum)
    {
        return $this->store($request, $forum);
    }

    /**
     * @param Request $request
     * @param Category $forum
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Request $request, Category $forum)
    {
        $forum->delete();

        return redirect()
            ->back();
    }

    /**
     * Get Datatables.
     *
     * @return mixed
     * @throws \Exception
     */
    public function getAjaxCategories()
    {
        $categories = Category::getParents()->get();

        return Datatables::of($categories)
            ->addColumn('title', function ($row) {
                return $row->title;
            })
            ->addColumn('subcategory', function ($row) {
                $html = '<ul class="list-group">';
                foreach ($row->children as $child) {
                    $html .= '<li class="list-group-item list-group-item-action">' . $child->title;
                    $html .= '<span class="pull-right">
                                <a href="' . route('admin.forum.remove', ['id' => $child->id]) . '" class="btn btn-sm btn-danger">Remove</a>
                                <a href="' . route('admin.forum.update', ['id' => $child->id]) . '" class="btn btn-sm btn-warning">Edit</a></span>';
                    $html .= '</li>';
                }

                $html .= '</ul>';

                return $html;
            })
            ->addColumn('manage', function ($row) {
                return '<a href="' . route('admin.forum.update', ['id' => $row->id]) . '" class="btn btn-sm btn-warning">Edit</a>
                        <a href="' . route('admin.forum.remove', ['id' => $row->id]) . '" class="btn btn-sm btn-danger">Remove</a>
                        ';
            })
            ->rawColumns(['title', 'subcategory', 'manage'])
            ->make(true);
    }
}