<?php

namespace App\Http\Controllers\master;

use Exception;
use App\Models\master\Item;
use App\Models\master\Brand;
use Illuminate\Http\Request;
use App\Models\master\RationType;
use App\Models\master\Measurement;
use Illuminate\Support\Facades\DB;
use App\Models\master\ItemCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
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
        $measurements = Measurement::all();
        $itemCategorys = ItemCategory::all();
        $brands = Brand::all();

        return view('master.items.create', compact('measurements','itemCategorys','brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreItemRequest $request)
    {
        try {
            DB::beginTransaction();

            // Create the item
            $item = Item::create($request->all());

            if ($request->hasFile('product_image')) {
                // Define the destination path for personal photos
                $destinationProductImage = public_path('/upload/productimage/'.$item->id.'/');

                // Ensure the destination directory exists, create it if not
                if (!File::isDirectory($destinationProductImage)) {
                    File::makeDirectory($destinationProductImage, 0777, true, true);
                }

                // Generate a unique filename for the uploaded product_image
                $extProductImage = $request->file('product_image')->extension();
                $fileProductImage = $item->id.'.'.$extProductImage;

                // Move the uploaded file to the destination
                $request->file('product_image')->move($destinationProductImage, $fileProductImage);

                // Update the item record with the product_image path
                $item->update([
                    'product_image' => '/upload/productimage/'.$item->id.'/'.$fileProductImage,
                ]);
            }

            DB::commit();

            return redirect()->route('items.index')->with('success', 'Item Created');
        } catch (Exception $e) {
            // If an exception occurs, rollback the database transaction
            DB::rollBack();

            // Log or handle the exception as needed
            return redirect()->back()->with('error', 'Failed to create item. ' . $e->getMessage());
        }

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $item =  Item::findOrFail($id);

        return view('master.items.show',compact('item','measurements','itemCategorys'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $measurements = Measurement::all();
        $itemCategorys = ItemCategory::all();
        $brands = Brand::all();

        $item =  Item::findOrFail($id);

        return view('master.items.edit',compact('item','measurements','itemCategorys','brands'));
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

}
