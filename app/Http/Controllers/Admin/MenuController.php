<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostMenuRequest;
use Domain\Entities\Menu\Menu;
use Domain\Entities\Menu\MenuItem;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class MenuController
 * @package App\Http\Controllers\Admin
 */
class MenuController extends Controller
{
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
        return view('admin.menu.edit', [
            'page' => $menu,
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
     * Get Datatables.
     *
     * @return mixed
     * @throws \Exception
     */
    public function getAjaxMenu()
    {
        $menu = Menu::getParents()->get();

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
        $conditions = $request->data;
        $items = json_decode($conditions);

        $conditions = $items;

        foreach ($conditions as $position => $item) {
            $item = (object)$item;
            if (isset($item->id)) {
                $condition = MenuItem::findOrFail($item->id);
                $condition->sequence = $position;
                $condition->parent_id = $item->parent_id;
                $condition->save();
            }
        }

        return json_encode(['status' => true]);
    }

}