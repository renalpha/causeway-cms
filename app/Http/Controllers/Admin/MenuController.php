<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostMenuItemRequest;
use App\Http\Requests\PostMenuRequest;
use Domain\Entities\Menu\Menu;
use Domain\Entities\Menu\MenuItem;
use Domain\Services\MenuService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class MenuController
 * @package App\Http\Controllers\Admin
 */
class MenuController extends Controller
{
    /**
     * @var MenuService
     */
    protected $menuService;

    /**
     * MenuController constructor.
     * @param MenuService $menuService
     */
    public function __construct(MenuService $menuService)
    {
        $this->menuService = $menuService;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.menu.index');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.menu.new');
    }

    /**
     * @param Request $request
     * @param Menu $menu
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Request $request, Menu $menu)
    {
        return view('admin.menu.update', [
            'menu' => $menu,
        ]);
    }

    /**
     * @param Request $request
     * @param Menu $menu
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Request $request, Menu $menu)
    {
        $menu->delete();
        return redirect()->back();
    }

    /**
     * @param Request $request
     * @param Menu $menu
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Request $request, Menu $menu)
    {
        return view('admin.menu.show', [
            'menu' => $menu,
        ]);
    }

    public function update(PostMenuRequest $request, Menu $menu)
    {
        $page = $this->store($request, $menu);
    }

    public function store(PostMenuRequest $request, Menu $menu = null)
    {

    }

    /**
     * @param Request $request
     * @param Menu $menu
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createItem(Request $request, Menu $menu)
    {
        return view('admin.menu.item.new', [
            'menu' => $menu,
        ]);
    }

    /**
     * @param Request $request
     * @param Menu $menu
     * @param MenuItem $item
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editItem(Request $request, Menu $menu, MenuItem $item)
    {
        return view('admin.menu.item.update', [
            'menu' => $menu,
            'item' => $item,
        ]);
    }

    /**
     * @param PostMenuItemRequest $request
     * @param Menu $menu
     * @param MenuItem|null $item
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeItem(PostMenuItemRequest $request, Menu $menu, MenuItem $item = null)
    {
        $request->request->add(['menu_id' => $menu->id]);

        $this->menuService->updateOrCreateItem([
            'id' => $item->id ?? null,
        ], $request->only(['menu_id', 'parent_id', 'label', 'url', 'access_level']));

        return redirect()
            ->route('admin.menu.show', ['id' => $menu->id]);
    }

    /**
     * @param PostMenuItemRequest $request
     * @param Menu $menu
     * @param MenuItem $item
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateItem(PostMenuItemRequest $request, Menu $menu, MenuItem $item)
    {
        return $this->storeItem($request, $menu, $item);
    }
    /**
     * Get Datatables.
     *
     * @return mixed
     * @throws \Exception
     */
    public function getAjaxMenu()
    {
        $menu = Menu::get();

        return Datatables::of($menu)
            ->addColumn('label', function ($row) {
                return $row->label;
            })
            ->addColumn('name', function ($row) {
                return $row->name;
            })
            ->addColumn('items', function ($row) {
                return count($row->items);
            })
            ->addColumn('manage', function ($row) {
                return '<a href="' . route('admin.menu.show', ['id' => $row->id]) . '" class="btn btn-sm btn-primary">Manage</a>
                        <a href="' . route('admin.menu.update', ['id' => $row->id]) . '" class="btn btn-sm btn-warning">Edit</a>
                        <a href="' . route('admin.menu.remove', ['id' => $row->id]) . '" class="btn btn-sm btn-danger">Remove</a>
                        ';
            })
            ->rawColumns(['label', 'name', 'items', 'manage'])
            ->make(true);
    }

    /**
     * @param Request $request
     * @param Menu $menu
     * @return false|string
     */
    public function sort(Request $request, Menu $menu)
    {
        $items = $request->data;
        $items = json_decode($items);

        foreach ($items as $position => $item) {
            $item = (object)$item;
            if (isset($item->id)) {
                $condition = MenuItem::where('menu_id', $menu->id)->findOrFail($item->id);
                $condition->sequence = $item->left;
                $condition->parent_id = $item->parent_id;
                $condition->save();
            }
        }

        return json_encode(['status' => true]);
    }

}