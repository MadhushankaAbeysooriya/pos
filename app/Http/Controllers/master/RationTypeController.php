<?php

namespace App\Http\Controllers\master;

use Illuminate\Http\Request;
use App\Models\master\RationType;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRationTypeRequest;
use App\DataTables\master\RationTypeDataTable;
use App\Http\Requests\UpdateRationTypeRequest;

class RationTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function __construct()
    {
        $this->middleware('permission:master-ration-type-list|master-ration-type-create|master-ration-type-edit|master-ration-type-delete', ['only' => ['index','store']]);
        $this->middleware('permission:master-ration-type-create', ['only' => ['create','store']]);
        $this->middleware('permission:master-ration-type-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:master-ration-type-delete', ['only' => ['destroy']]);
    }

    public function index(RationTypeDataTable $dataTable)
    {
        return $dataTable->render('master.ration_type.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('master.ration_type.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRationTypeRequest $request)
    {
        RationType::create($request->all());
        return redirect()->route('ration_types.index')->with('success','Ration Type Created');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $rationType = RationType::find($id);
        return view('master.ration_type.show',compact('rationType'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $rationType = RationType::find($id);
        return view('master.ration_type.edit',compact('rationType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRationTypeRequest $request, RationType $rationType)
    {
        $rationType->update($request->toArray());
        return redirect()->route('ration_types.index')->with('message', 'Ration Type Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $rationType = RationType::find($id);
        $rationType->delete();
        return redirect()->route('ration_types.index')
            ->with('danger', 'Ration Type Deleted successfully');
    }
}
