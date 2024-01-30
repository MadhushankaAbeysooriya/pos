<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\master\Item;
use App\Models\AnnualDemand;
use App\Models\master\Brand;
use Illuminate\Http\Request;
use App\Models\master\Location;
use App\Models\master\Supplier;
use App\Models\DemandFromLocation;
use Illuminate\Support\Facades\DB;
use App\Models\master\LocationType;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\DemandFromLocationItem;
use App\DataTables\DemandFromLocationDataTable;
use App\Http\Requests\StoreDemandFromLocationRequest;
use App\Http\Requests\UpdateDemandFromLocationRequest;

class DemandFromLocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function __construct()
    {
        $this->middleware('permission:demand-from-location-list|demand-from-location-create|demand-from-location-edit|demand-from-location-delete', ['only' => ['index','store']]);
        $this->middleware('permission:demand-from-location-create', ['only' => ['create','store']]);
        $this->middleware('permission:demand-from-location-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:demand-from-location-delete', ['only' => ['destroy']]);
    }

    public function index(DemandFromLocationDataTable $dataTable)
    {
        return $dataTable->render('demand_from_locations.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $locations = Location::get();
        $items = Item::get();
        $suppliers = Supplier::get();
        return view('demand_from_locations.create', compact('locations','items','suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     $this->validate($request, [
    //         'year' => 'required',
    //         'demand_ref' => 'required',
    //         'item_id' => 'required',
    //         'supplier_id' => 'required',
    //         'qty' => 'required',
    //         //'location_id' => 'required',
    //         'request_date' => 'required',
    //     ]);

    //     $annualDemand = AnnualDemand::where('year', $request->year)
    //                                     ->where('location_id', Auth::user()->location)
    //                                     ->where('supplier_id', $request->supplier_id)
    //                                     ->where('item_id', $request->item_id)
    //                                     ->first();


    //     if ($annualDemand && $annualDemand->avl_qty >= $request->qty) {

    //         DemandFromLocation::create([
    //             'year' => $request->year,
    //             'demand_ref' => $request->demand_ref,
    //             'item_id' => $request->item_id,
    //             'supplier_id' => $request->supplier_id,
    //             'qty' => $request->qty,
    //             'location_id' => Auth::user()->location,
    //             'request_date' => $request->request_date,
    //         ]);

    //             return redirect()->route('demand_from_locations.index')->with('success','Demand From Location Created');

    //     } else {
    //             // If annual demand record not found or quantity not available, throw an exception
    //             return redirect()->route('demand_from_locations.create')
    //                             ->with('danger', 'Insufficient quantity available in annual demand.');
    //     }
    // }

    // public function store(Request $request)
    // {
    //     // Wrap the entire function inside a database transaction
    //     DB::beginTransaction();

    //     try {
    //         $this->validate($request, [
    //             'year' => 'required',
    //             'demand_ref' => 'required',
    //             'item_id' => 'required',
    //             'supplier_id' => 'required',
    //             'qty' => 'required',
    //             'request_date' => 'required',
    //         ]);

    //         $annualDemand = AnnualDemand::where('year', $request->year)
    //                         ->where('location_id', Auth::user()->location)
    //                         ->where('supplier_id', $request->supplier_id)
    //                         ->where('item_id', $request->item_id)
    //                         ->first();

    //         if ($annualDemand && $annualDemand->avl_qty >= $request->qty) {

    //             DemandFromLocation::create([
    //                 'year' => $request->year,
    //                 'demand_ref' => $request->demand_ref,
    //                 'item_id' => $request->item_id,
    //                 'supplier_id' => $request->supplier_id,
    //                 'qty' => $request->qty,
    //                 'location_id' => Auth::user()->location,
    //                 'request_date' => $request->request_date,
    //             ]);

    //             // Commit the transaction if everything is successful
    //             DB::commit();

    //             return redirect()->route('demand_from_locations.index')->with('success', 'Demand From Location Created');

    //         } else {
    //             // Rollback the transaction if annual demand record not found or quantity not available
    //             DB::rollBack();

    //             // If you want to throw an exception, you can use ValidationException
    //             return redirect()->route('demand_from_locations.create')
    //                              ->with('danger', 'Insufficient quantity available in annual demand.');
    //         }
    //     } catch (Exception $e) {
    //         // Rollback the transaction in case of any exception
    //         DB::rollBack();

    //         // Log or handle the exception as needed
    //         return redirect()->route('demand_from_locations.create')
    //                         ->with('danger', 'An error occurred while processing your request.');
    //     }
    // }

    public function store(Request $request)
    {
        // Wrap the entire function inside a database transaction
        DB::beginTransaction();

        try {
            $this->validate($request, [
                'year' => 'required',
                'demand_ref' => 'required',
                'supplier_id' => 'required',
                'request_date' => 'required',
            ]);

            DemandFromLocation::create([
                'year' => $request->year,
                'demand_ref' => $request->demand_ref,
                'supplier_id' => $request->supplier_id,
                'location_id' => Auth::user()->location,
                'request_date' => $request->request_date,
            ]);

            // Commit the transaction if everything is successful
            DB::commit();

            return redirect()->route('demand_from_locations.index')->with('success', 'Demand From Location Created');


        } catch (Exception $e) {
            // Rollback the transaction in case of any exception
            DB::rollBack();

            // Log or handle the exception as needed
            return redirect()->route('demand_from_locations.create')
                            ->with('danger', 'An error occurred while processing your request.');
        }
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
    public function edit($id)
    {
        $locations = Location::get();
        $items = Item::get();
        $suppliers = Supplier::get();

        $demandFromLocation = DemandFromLocation::with(['item','location','supplier'])
            ->where('id',$id)
            ->first();

        $dateObject = new \DateTime($demandFromLocation->request_date);
        $demandFromLocation->request_date = ($dateObject->format('Y-m-d'));

        return view('demand_from_locations.edit',compact('locations','items','suppliers','demandFromLocation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDemandFromLocationRequest $request, DemandFromLocation $demandFromLocation)
    {
        $demandFromLocation->update($request->toArray());
        return redirect()->route('demand_from_locations.index')->with('success', 'demand From Location Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $demandFromLocation = DemandFromLocation::find($id);
        $demandFromLocation->delete();
        return redirect()->route('demand_from_locations.index')
            ->with('danger', 'Demand from location Deleted successfully');
    }

    public function storedemandfromlocationview($id)
    {
        $demandfromlocation = DemandFromLocation::findOrFail($id);
        $brands = Brand::all();
        $items = Item::get();

        return view('demand_from_locations.create_demand_from_location_item',compact('demandfromlocation','brands','items'));
    }

    public function storedemandfromlocation(Request $request, DemandFromLocation $demandFromLocation)
    {
        DB::beginTransaction();

        try {
            $this->validate($request, [
                'item_id' => 'required',
                'qty' => 'required',
                'brand_id' => 'required',
            ]);

            $annualDemand = AnnualDemand::where('year', $demandFromLocation->year)
                            ->where('location_id', Auth::user()->location_id)
                            ->where('item_id', $request->item_id)
                            ->where('brand_id', $request->brand_id)
                            ->first();

            if ($annualDemand && $annualDemand->avl_qty >= $request->qty) {

                $demandFromLocation->demandfromlocationitems()->create([
                    'item_id' => $request->item_id,
                    'brand_id' => $request->brand_id,
                    'qty' => $request->qty,
                ]);

                // Commit the transaction if everything is successful
                DB::commit();

                return redirect()->route('demand_from_locations.add_items_view',$demandFromLocation->id)->with('success', 'Item Added');

            } else {

                // Rollback the transaction if annual demand record not found or quantity not available
                DB::rollBack();

                // If you want to throw an exception, you can use ValidationException
                return redirect()->route('demand_from_locations.add_items_view',$demandFromLocation->id)
                                 ->with('danger', 'Insufficient quantity available in annual demand.');
            }
        } catch (Exception $e) {
            // Rollback the transaction in case of any exception
            DB::rollBack();

            // Log or handle the exception as needed
            return redirect()->route('demand_from_locations.add_items_view',$demandFromLocation->id)
                            ->with('danger', 'An error occurred while processing your request.');
        }
    }

    public function deletedemandfromlocationitem(DemandFromLocation $demandFromLocation, $id)
    {
        // Assuming you have an 'id' field in your IssueItem model
        $demandFromlocationitem = DemandFromLocationItem::find($id);

        if (!$demandFromlocationitem) {

            return redirect()->back()->with('error', 'Issue Item not found.');
        }

        $demandFromlocationitem->delete();

        // Redirect back with a success message or as needed
        return redirect()->back()->with('success', 'Issue Item deleted successfully.');
    }
}
