<?php

namespace App\Http\Controllers;

use App\Models\master\Item;
use App\Models\AnnualDemand;
use App\Models\master\Brand;
use Illuminate\Http\Request;
use App\Models\master\Location;
use App\Models\master\Supplier;
use App\Http\Controllers\Controller;
use App\DataTables\AnnualDemandDataTable;

class AnnualDemandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function __construct()
    {
        $this->middleware('permission:annual-demand-list|annual-demand-create|annual-demand-edit|annual-demand-delete', ['only' => ['index','store']]);
        $this->middleware('permission:annual-demand-create', ['only' => ['create','store']]);
        $this->middleware('permission:annual-demand-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:annual-demand-delete', ['only' => ['destroy']]);
    }

    public function index(AnnualDemandDataTable $dataTable)
    {
        return $dataTable->render('annual_demands.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $locations = Location::all();
        $items = Item::all();
        $suppliers = Supplier::all();
        $brands = Brand::all();

        return view('annual_demands.create',compact('locations','items', 'suppliers', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'year' => 'required|numeric|min:' . date('Y'),
            'item_id' => 'required|exists:items,id',
            'location_id' => 'required|exists:locations,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'qty' => 'required|numeric|min:1',
            'brand_id' => 'required|exists:brands,id',
        ]);

        AnnualDemand::create([
            'year' => $request->year,
            'item_id' => $request->item_id,
            'location_id' => $request->location_id,
            'supplier_id' => $request->supplier_id,
            'qty' => $request->qty,
            'avl_qty' => $request->qty,
            'brand_id' => $request->brand_id,
        ]);

        return redirect()->route('annual_demands.index')->with('success','Annual Demand successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $annualDemand = AnnualDemand::find($id);

        return view('annual_demands.show',compact('annualDemand'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $annualDemand = AnnualDemand::find($id);

        $locations = Location::all();
        $items = Item::all();
        $suppliers = Supplier::all();
        $brands = Brand::all();

        return view('annual_demands.edit',compact('annualDemand','locations','items', 'suppliers', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AnnualDemand $annualDemand)
    {
        $this->validate($request, [
            'year' => 'required|numeric|min:' . date('Y'),
            'item_id' => 'required|exists:items,id',
            'location_id' => 'required|exists:locations,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'qty' => 'required|numeric|min:1',
            'brand_id' => 'required|exists:brands,id',
        ]);

        $annualDemand->update([
            'year' => $request->year,
            'item_id' => $request->item_id,
            'location_id' => $request->location_id,
            'supplier_id' => $request->supplier_id,
            'qty' => $request->qty,
            'avl_qty' => $request->qty,
            'brand_id' => $request->brand_id,
        ]);

        return redirect()->route('annual_demands.index')->with('message', 'Annual demand Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $annualDemand = AnnualDemand::find($id);
        $annualDemand->delete();

        return redirect()->route('annual_demands.index')->with('danger', 'Annual Demand Deleted successfully');
    }
}
