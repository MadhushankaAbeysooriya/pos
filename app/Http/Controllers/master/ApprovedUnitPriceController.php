<?php

namespace App\Http\Controllers\master;

use App\DataTables\master\ApprovedUnitPriceDataTable;
use App\Models\master\Item;
use Illuminate\Http\Request;
use App\Models\master\Quarter;
use App\Http\Controllers\Controller;
use App\Http\Requests\master\StoreApprovedUnitPriceRequest;
use App\Http\Requests\master\UpdateApprovedUnitPriceRequest;
use App\Models\master\ApprovedUnitPrice;
use App\Models\master\Brand;

class ApprovedUnitPriceController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:master-approved-unit-price-list|master-approved-unit-price-create|master-approved-unit-price-edit|master-approved-unit-price-delete', ['only' => ['index','store']]);
        $this->middleware('permission:master-approved-unit-price-create', ['only' => ['create','store']]);
        $this->middleware('permission:master-approved-unit-price-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:master-approved-unit-price-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(ApprovedUnitPriceDataTable $dataTable)
    {
        return $dataTable->render('master.approved_unit_price.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $quarter = Quarter::get();
        $itemList = Item::get();
        $brandList = Brand::get();
        return view('master.approved_unit_price.create', compact('quarter', 'itemList', 'brandList'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreApprovedUnitPriceRequest $request)
    {
        ApprovedUnitPrice::create($request->all());
        return redirect()->route('approved_unit_price.index')->with('success','Unit price created');
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
    public function edit(ApprovedUnitPrice $approved_unit_price)
    { 
        $quarter = Quarter::get();
        $itemList = Item::get();
        $brandList = Brand::get();
 
        return view('master.approved_unit_price.edit', compact('approved_unit_price', 'quarter', 'itemList', 'brandList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateApprovedUnitPriceRequest $request, ApprovedUnitPrice $approved_unit_price)
    {
        $approved_unit_price->update($request->toArray());
        return redirect()->route('approved_unit_price.index')->with('message', 'Price Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ApprovedUnitPrice $approved_unit_price)
    {
        $approved_unit_price->delete();
        return redirect()->route('approved_unit_price.index')->with('danger', 'Price Deleted successfully');
    }
}
