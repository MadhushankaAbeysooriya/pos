<?php

namespace App\Http\Controllers\master;

use App\Models\master\Menu;
use Illuminate\Http\Request;
use App\Models\master\RationDate;
use App\Models\master\RationTime;
use App\Models\master\RationType;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMenuRequest;
use App\DataTables\master\MenuDataTable;
use App\Http\Requests\UpdateMenuRequest;

class MenuController extends Controller
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

    public function index(MenuDataTable $dataTable)
    {
        return $dataTable->render('master.menu.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rationDate = RationDate::all();
        $rationType = RationType::all();
        $rationTime = RationTime::all();
        return view('master.menu.create', compact('rationDate','rationType','rationTime'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMenuRequest $request)
    {
        Menu::create($request->all());
        return redirect()->route('menus.index')->with('success','Menu Created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $menu = Menu::find($id);
        $rationDate = RationDate::all();
        $rationType = RationType::all();
        $rationTime = RationTime::all();
        return view('master.menu.show', compact('menu','rationDate','rationType','rationTime'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu)
    {
        //$menu = Menu::find($id);
        $rationDate = RationDate::all();
        $rationType = RationType::all();
        $rationTime = RationTime::all();
        return view('master.menu.edit',compact('menu','rationDate','rationType','rationTime'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Menu $menu)
    {
        $request->validate(
            [
                'name' => 'required|unique:menus,name,'.$menu->id,
                'year' => 'required|numeric|max:2500|min:2023',
            ],[
                
            ]
        );

        $menu->update($request->toArray());
        return redirect()->route('menus.index')->with('message', 'Menus Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $menu = Menu::find($id);
        $menu->delete();
        return redirect()->route('menus.index')
            ->with('danger', 'Menus Deleted successfully');
    }
}
