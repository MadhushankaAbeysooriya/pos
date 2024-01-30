<?php

namespace App\Http\Controllers\master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\master\ReceiptTypeDataTable;
use App\Models\master\ReceiptType;
use App\Http\Requests\master\StoreReceiptTypeRequest;
use App\Http\Requests\master\UpdateReceiptTypeRequest;

class ReceiptTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    function __construct()
    {
        $this->middleware('permission:master-receipt-type-list|master-receipt-type-create|master-receipt-type-edit|master-receipt-type-delete', ['only' => ['index','store']]);
        $this->middleware('permission:master-receipt-type-create', ['only' => ['create','store']]);
        $this->middleware('permission:master-receipt-type-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:master-receipt-type-delete', ['only' => ['destroy']]);
    }
    public function index(ReceiptTypeDataTable $dataTable)
    {
        return $dataTable->render('master.receipt_types.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('master.receipt_types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReceiptTypeRequest $request)
    {
        ReceiptType::create($request->all());
        return redirect()->route('receipt_types.index')->with('success','Receipt Type Created');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $receiptType = ReceiptType::find($id);
        return view('master.receipt_types.show',compact('receiptType'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $receiptType = ReceiptType::find($id);
        return view('master.receipt_types.edit',compact('receiptType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReceiptTypeRequest $request, ReceiptType $receiptType)
    {
        $receiptType->update($request->toArray());
        return redirect()->route('receipt_types.index')->with('message', 'Receipt Type Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $receiptType = ReceiptType::find($id);
        $receiptType->delete();
        return redirect()->route('receipt_types.index')
            ->with('danger', 'Receipt Type Deleted successfully');
    }
}
