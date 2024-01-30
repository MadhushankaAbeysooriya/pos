<?php

namespace App\Http\Controllers\master;

use App\DataTables\master\ItemCategoryDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreItemCategoryRequest;
use App\Http\Requests\UpdateItemCategoryRequest;
use App\Models\master\ItemCategory;
use Illuminate\Http\Request;

class ItemCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function __construct()
    {
        $this->middleware('permission:master-item-categories-list|master-item-categories-create|master-item-categories-edit|master-item-categories-delete', ['only' => ['index','store']]);
        $this->middleware('permission:master-item-categories-create', ['only' => ['create','store']]);
        $this->middleware('permission:master-item-categories-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:master-item-categories-delete', ['only' => ['destroy']]);
    }

    public function index(ItemCategoryDataTable $dataTable)
    {
        return $dataTable->render('master.item_categories.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('master.item_categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreItemCategoryRequest $request)
    {
        ItemCategory::create($request->all());
        return redirect()->route('item_categories.index')->with('success','Item Category Created');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $ItemCategory = ItemCategory::find($id);
        return view('master.item_categories.show',compact('ItemCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $ItemCategory = ItemCategory::find($id);
        return view('master.item_categories.edit',compact('ItemCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateItemCategoryRequest $request, ItemCategory $itemCategory)
    {
        $itemCategory->update($request->toArray());
        return redirect()->route('item_categories.index')->with('message', 'Item Category Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $itemCategory = ItemCategory::find($id);
        $itemCategory->delete();
        return redirect()->route('item_categories.index')
            ->with('danger', 'Item Category Deleted successfully');
    }
}
