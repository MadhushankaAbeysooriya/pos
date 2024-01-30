<?php

namespace App\Http\Controllers\master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\master\MeasurementDataTable;
use App\Models\master\Measurement;
use App\Http\Requests\master\StoreMeasurementRequest;
use App\Http\Requests\master\UpdateMeasurementRequest;

class MeasurementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function __construct()
    {
        $this->middleware('permission:master-measurement-list|master-measurement-create|master-measurement-edit|master-measurement-delete', ['only' => ['index','store']]);
        $this->middleware('permission:master-measurement-create', ['only' => ['create','store']]);
        $this->middleware('permission:master-measurement-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:master-measurement-delete', ['only' => ['destroy']]);
    }

    public function index(MeasurementDataTable $dataTable)
    {
        return $dataTable->render('master.measurements.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('master.measurements.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMeasurementRequest $request)
    {
        Measurement::create($request->all());
        return redirect()->route('measurements.index')->with('success','Measurement Created');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $measurement = Measurement::find($id);
        return view('master.measurements.show',compact('measurement'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $measurement = Measurement::find($id);
        return view('master.measurements.edit',compact('measurement'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMeasurementRequest $request, Measurement $measurement)
    {
        $measurement->update($request->toArray());
        return redirect()->route('measurements.index')->with('message', 'Measurement Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $measurement = Measurement::find($id);
        $measurement->delete();
        return redirect()->route('measurements.index')
            ->with('danger', 'Measurement Deleted successfully');
    }
}
