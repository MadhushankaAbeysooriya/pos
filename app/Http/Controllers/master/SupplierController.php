<?php

namespace App\Http\Controllers\master;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\master\SupplierDataTable;
use App\Models\master\Supplier;
use App\Http\Requests\master\StoreSupplierRequest;
use App\Http\Requests\master\UpdateSupplierRequest;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function __construct()
    {
        $this->middleware('permission:master-supplier-list|master-supplier-create|master-supplier-edit|master-supplier-delete', ['only' => ['index','store']]);
        $this->middleware('permission:master-supplier-create', ['only' => ['create','store']]);
        $this->middleware('permission:master-supplier-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:master-supplier-delete', ['only' => ['destroy']]);
    }

    public function index(SupplierDataTable $dataTable)
    {
        return $dataTable->render('master.suppliers.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('master.suppliers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSupplierRequest $request)
    {
        Supplier::create($request->all());
        return redirect()->route('suppliers.index')->with('success','Supplier Created');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $supplier = Supplier::find($id);
        return view('master.suppliers.show',compact('supplier'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $supplier = Supplier::find($id);
        return view('master.suppliers.edit',compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSupplierRequest $request, Supplier $supplier)
    {
        $supplier->update($request->toArray());
        return redirect()->route('suppliers.index')->with('message', 'Supplier Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $supplier = Supplier::find($id);
        $supplier->delete();
        return redirect()->route('suppliers.index')
            ->with('danger', 'Supplier Deleted successfully');
    }
}
