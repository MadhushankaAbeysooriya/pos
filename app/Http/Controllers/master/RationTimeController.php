<?php

namespace App\Http\Controllers\master;

use Illuminate\Http\Request;
use App\Models\master\RationTime;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRationTimeRequest;
use App\DataTables\master\RationTimeDataTable;
use App\Http\Requests\UpdateRationTimeRequest;

class RationTimeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function __construct()
    {
        $this->middleware('permission:master-ration-time-list|master-ration-time-create|master-ration-time-edit|master-ration-time-delete', ['only' => ['index','store']]);
        $this->middleware('permission:master-ration-time-create', ['only' => ['create','store']]);
        $this->middleware('permission:master-ration-time-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:master-ration-time-delete', ['only' => ['destroy']]);
    }

    public function index(RationTimeDataTable $dataTable)
    {
        return $dataTable->render('master.ration_time.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('master.ration_time.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRationTimeRequest $request)
    {
        RationTime::create($request->all());
        return redirect()->route('ration_times.index')->with('success','Ration Time Created');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $rationTime = RationTime::find($id);
        return view('master.ration_time.show',compact('rationTime'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $rationTime = RationTime::find($id);
        return view('master.ration_time.edit',compact('rationTime'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRationTimeRequest $request, RationTime $rationTime)
    {
        $rationTime->update($request->toArray());
        return redirect()->route('ration_times.index')->with('message', 'Ration Time Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $rationTime = RationTime::find($id);
        $rationTime->delete();
        return redirect()->route('ration_times.index')
            ->with('danger', 'Ration Time Deleted successfully');
    }
}
