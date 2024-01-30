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
use App\Models\master\ReceiptType;
use Illuminate\Support\Facades\DB;
use App\Models\ReceiptFromLocation;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\master\AlternativeItem;

class ReceiptFromLocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    function __construct()
    {
        $this->middleware('permission:demand-from-location-create-reciept', ['only' => ['create']]);
    }

    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(DemandFromLocation $demand_from_location)
    {
        $locations = Location::all();

        // Fetch all alternative items
        $alternativeItems = AlternativeItem::all();

        // Extract unique item IDs from both item_id and alternative_item_id columns
        $itemIds = $alternativeItems->pluck('item_id')->merge($alternativeItems->pluck('alternative_item_id'))->unique()->values();
        //dd($itemIds);

        // Fetch items based on the extracted IDs
        $items = Item::whereIn('id', $itemIds)->get();

        $suppliers = Supplier::all();
        $receiptTypes = ReceiptType::all();
        $brands = Brand::all();

        return view('receipt_from_locations.create', compact('demand_from_location','locations', 'items', 'suppliers','receiptTypes','brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request, DemandFromLocation $demand_from_location)
    // {
    //     $this->validate($request, [
    //         'item_id' => 'required|exists:items,id',
    //         'supplier_id' => 'required|exists:suppliers,id',
    //         'qty' => 'required|numeric|min:1',
    //         'receipt_type_id' => 'required|exists:receipt_types,id',
    //         'receipt_date' => 'required',
    //     ]);

    //     $demand_from_location->receiptfromlocation()->create([
    //         'year' => $demand_from_location->year,
    //         'receipt_type_id' => $request->receipt_type_id,
    //         'item_id' => $request->item_id,
    //         'location_id' => Auth::user()->location,
    //         'supplier_id' => $request->supplier_id,
    //         'qty' => $request->qty,
    //         'receipt_date' => $request->receipt_date,
    //     ]);

    //     return redirect()->route('demand_from_locations.index')->with('success','Reciept Created');
    // }

    // public function store(Request $request, DemandFromLocation $demand_from_location)
    // {
    //     try {

    //         $this->validate($request, [
    //             'item_id.*' => 'required|exists:items,id',
    //             'qty.*' => 'required|numeric|min:1',
    //             'brand_id.*' => 'required|exists:brands,id',
    //             'receipt_type_id' => 'required|exists:receipt_types,id',
    //             'receipt_date' => 'required',
    //         ], [
    //             'item_id.*.required' => 'Item is required.',
    //             'item_id.*.exists' => 'Selected item is invalid.',
    //             'qty.*.required' => 'Quantity is required.',
    //             'qty.*.numeric' => 'Quantity must be a number.',
    //             'qty.*.min' => 'Quantity must be at least :min.',
    //             'brand_id.*.required' => 'Brand is required.',
    //             'brand_id.*.exists' => 'Selected brand is invalid.',
    //             'receipt_type_id.required' => 'Receipt Type is required.',
    //             'receipt_type_id.exists' => 'Selected Receipt Type is invalid.',
    //             'receipt_date.required' => 'Receipt Date is required.',
    //         ]);

    //         // Start a database transaction
    //         DB::beginTransaction();

    //         // Create or update the receipt
    //         $receiptfromlocation = $demand_from_location->receiptfromlocation()->create([
    //             'year' => $demand_from_location->year,
    //             // 'receipt_type_id' => $request->receipt_type_id,
    //             // 'item_id' => $request->item_id,
    //             'location_id' => Auth::user()->location,
    //             'supplier_id' => $demand_from_location->supplier_id,
    //             // 'qty' => $request->qty,
    //             'receipt_date' => $request->receipt_date,
    //         ]);

    //         foreach($request->item_id as $index=>$item_id){

    //             $annualDemand = AnnualDemand::where('year', $demand_from_location->year)
    //                                         ->where('location_id', Auth::user()->location)
    //                                         ->where('supplier_id', $demand_from_location->supplier_id)
    //                                         ->where('item_id', $request->item_id[$index])
    //                                         ->where('brand_id', $request->brand_id[$index])
    //                                         ->first();

    //             if ($annualDemand && $annualDemand->avl_qty >= $request->qty[$index]) {

    //                 $annualDemand->update([
    //                     'avl_qty' => $annualDemand->avl_qty - $request->qty[$index],
    //                 ]);

    //                 $receiptfromlocation->receiptfromlocationitems()->create([
    //                     'item_id' => $request->item_id[$index],
    //                     'qty' => $request->qty[$index],
    //                     'brand_id' => $request->brand_id[$index],
    //                     'receipt_type_id' => 1,
    //                 ]);

    //                 // Commit the transaction
    //                 DB::commit();

    //                 return redirect()->route('demand_from_locations.index')->with('success', 'Receipt Created');
    //             } else {
    //                 // If annual demand record not found or quantity not available, throw an exception
    //                 return redirect()->route('receipt_from_locations.create',$demand_from_location->id)
    //                                 ->with('danger', 'Insufficient quantity available in annual demand.');

    //             }
    //         }

    //     } catch (Exception $e) {
    //         // An error occurred, rollback the transaction
    //         DB::rollBack();

    //         // Handle the error (you can log it or display an error message)
    //         return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
    //     }
    // }

    public function store(Request $request, DemandFromLocation $demand_from_location)
    {
        try {

            $this->validate($request, [
                'item_id.*' => 'required|exists:items,id',
                'qty.*' => 'required|numeric|min:1',
                'brand_id.*' => 'required|exists:brands,id',
                'receipt_type_id.*' => 'required|exists:receipt_types,id',
                'receipt_date' => 'required',
            ], [
                'item_id.*.required' => 'Item is required.',
                'item_id.*.exists' => 'Selected item is invalid.',
                'qty.*.required' => 'Quantity is required.',
                'qty.*.numeric' => 'Quantity must be a number.',
                'qty.*.min' => 'Quantity must be at least :min.',
                'brand_id.*.required' => 'Brand is required.',
                'brand_id.*.exists' => 'Selected brand is invalid.',
                'receipt_type_id.*.required' => 'Receipt Type is required.',
                'receipt_type_id.*.exists' => 'Selected Receipt Type is invalid.',
                'receipt_date.required' => 'Receipt Date is required.',
            ]);

            // Start a database transaction
            DB::beginTransaction();

            $locationId = Auth::user()->location_id;

            // Create or update the receipt
            $receiptFromLocation = $demand_from_location->receiptfromlocation()->create([
                'year' => $demand_from_location->year,
                'location_id' => $locationId,
                'supplier_id' => $demand_from_location->supplier_id,
                'receipt_date' => $request->receipt_date,
            ]);

            $itemDetails = AnnualDemand::whereIn('item_id', $request->item_id)
                            ->where('year', $demand_from_location->year)
                            ->where('location_id', $locationId)
                            ->where('supplier_id', $demand_from_location->supplier_id)
                            ->get();

            foreach ($request->item_id as $index => $itemId) {
                $annualDemand = $itemDetails->firstWhere('item_id', $itemId);

                if ($annualDemand && $annualDemand->avl_qty >= $request->qty[$index]) {
                    $annualDemand->update([
                        'avl_qty' => $annualDemand->avl_qty - $request->qty[$index],
                    ]);

                    $receiptFromLocation->receiptfromlocationitems()->create([
                        'item_id' => $itemId,
                        'qty' => $request->qty[$index],
                        'brand_id' => $request->brand_id[$index],
                        'receipt_type_id' => $request->receipt_type_id[$index],
                    ]);
                } else {
                    // If annual demand record not found or quantity not available, throw an exception
                    DB::rollBack();
                    return redirect()->route('receipt_from_locations.create', $demand_from_location->id)
                        ->with('danger', 'Insufficient quantity available in annual demand.');
                }
            }

            // Commit the transaction
            DB::commit();

            return redirect()->route('demand_from_locations.index')->with('success', 'Receipt Created');
        } catch (Exception $e) {
            // An error occurred, rollback the transaction
            DB::rollBack();

            // Handle the error (you can log it or display an error message)
            return redirect()->back()->with('danger', 'An error occurred: ' . $e->getMessage());
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
    public function destroy(string $id)
    {
        //
    }
}
