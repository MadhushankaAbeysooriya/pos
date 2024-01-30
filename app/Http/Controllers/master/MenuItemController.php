<?php

namespace App\Http\Controllers\master;

use App\Models\master\Item;
use App\Models\master\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\master\MenuItemDataTable;
use App\Http\Requests\StoreMenuItemRequest;
use App\Models\master\MenuItem;

class MenuItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function __construct()
    {
        $this->middleware('permission:master-menu-list|master-menu-create|master-menu-edit|master-menu-delete', ['only' => ['index','store']]);
        $this->middleware('permission:master-menu-create', ['only' => ['create','store']]);
        $this->middleware('permission:master-menu-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:master-menu-delete', ['only' => ['destroy']]);
    }

    public function index(MenuItemDataTable $dataTable)
    {
        return $dataTable->render('master.menu_items.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(menu $menu)
    {
     //   $menu = Menu::find($id);
        $itemList = Item::all();
        return view('master.menu_items.create', compact('menu','itemList'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Menu $menu, StoreMenuItemRequest $request)
    {
        $menu->menuitem()->create([
            'item_id'=>$request->item_id,
            'per_qty'=>$request->per_qty
        ]);

        return redirect(route('menu_items.create',$menu->id))->with('success', 'Menu items created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu, MenuItem $menuItem)
    {
        $menuItem->delete();

        return redirect(route('menu_items.create',$menu->id))->with('danger', 'Menu items deleted created');
    }
}
