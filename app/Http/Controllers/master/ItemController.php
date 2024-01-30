<?php

namespace App\Http\Controllers\master;

use App\Models\master\Item;
use Illuminate\Http\Request;
use App\Models\master\RationType;
use App\Models\master\Measurement;
use App\Models\master\ItemCategory;
use App\Http\Controllers\Controller;
use App\Models\master\RationCategory;
use App\Models\master\AlternativeItem;
use App\Http\Requests\StoreItemRequest;
use App\DataTables\master\ItemDataTable;
use App\Http\Requests\UpdateItemRequest;
use App\Models\master\RationSubCategory;
use App\Http\Requests\StoreAlternativeItemRequest;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function __construct()
    {
        $this->middleware('permission:master-item-list|master-item-create|master-item-edit|master-item-delete', ['only' => ['index','store']]);
        $this->middleware('permission:master-item-create', ['only' => ['create','store']]);
        $this->middleware('permission:master-item-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:master-item-delete', ['only' => ['destroy']]);
        $this->middleware('permission:master-item-add-alternative-item', ['only' => ['addAlternativeView']]);
    }

    public function index(ItemDataTable $dataTable)
    {
        return $dataTable->render('master.items.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $measurements = Measurement::get();
        $rationSubCategories = RationSubCategory::get();
        $itemCategorys = ItemCategory::get();
        return view('master.items.create', compact('measurements','rationSubCategories','itemCategorys'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreItemRequest $request)
    {

        Item::create($request->all());
        return redirect()->route('items.index')->with('success','Item Created');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $measurements = Measurement::get();
        $rationSubCategories = RationSubCategory::get();
        $itemCategorys = ItemCategory::get();

        $item =  Item::with(['itemCategory', 'measurement', 'rationCategory'])
            ->where('id', $id)
            ->select('id', 'name', 'item_category_id', 'measurement_id', 'ration_category_id')
            ->first();

        return view('master.items.show',compact('item','measurements','rationSubCategories','itemCategorys'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //dd($id);
        $measurements = Measurement::get();
        $rationSubCategories = RationSubCategory::get();
        $itemCategorys = ItemCategory::get();

        $item =  Item::find($id);

        return view('master.items.edit',compact('item','measurements','rationSubCategories','itemCategorys'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateItemRequest $request, Item $item)
    {
        $item->update($request->toArray());
        return redirect()->route('items.index')->with('message', 'Item Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $items = Item::find($id);
        $items->delete();
        return redirect()->route('items.index')
            ->with('danger', 'Item Deleted successfully');
    }

    public function addAlternativeView($id)
    {
        $items = Item::get();
        $item =  Item::find($id);
        $alternativeItems = AlternativeItem::with(['Item'])
                            ->where('item_id',$id)
                            ->get();

        return view('master.items.create_alternative_items',compact('item','items','alternativeItems'));
    }

    public function saveAlternative(StoreAlternativeItemRequest $request, $id)
    {

//        dd('pass');
        AlternativeItem::create($request->all());

        $items = Item::get();
        $item =  Item::find($id);

        $alternativeItems = AlternativeItem::with(['Item'])
                            ->where('item_id',$id)
                            ->get();

        return view('master.items.create_alternative_items',compact('item','items','alternativeItems'))->with('message', 'Alternative');

    }


    public function deleteAlternative(Request $request, $id)
    {

        AlternativeItem::where('id', $id)->forceDelete();

        $items = Item::get();
        $item =  Item::find($id);

        $alternativeItems = AlternativeItem::with(['item'])
                            ->where('item_id',$request->item_id)
                            ->get();

        return view('master.items.create_alternative_items',compact('item','items','alternativeItems'));
    }
}
