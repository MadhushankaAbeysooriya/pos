<?php

namespace App\Http\Controllers\master;

use Illuminate\Http\Request;
use App\Models\master\LocationType;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLocationTypeRequest;
use App\DataTables\master\LocationTypeDataTable;
use App\Http\Requests\UpdateLocationTypeRequest;

class LocationTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function __construct()
    {
        $this->middleware('permission:master-location-types-list|master-location-types-create|master-location-types-edit|master-location-types-delete', ['only' => ['index','store']]);
        $this->middleware('permission:master-location-types-create', ['only' => ['create','store']]);
        $this->middleware('permission:master-location-types-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:master-location-types-delete', ['only' => ['destroy']]);
    }

    public function index(LocationTypeDataTable $dataTable)
    {
        return $dataTable->render('master.location_types.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('master.location_types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLocationTypeRequest $request)
    {
        LocationType::create($request->all());
        return redirect()->route('location_types.index')->with('success','Location Type Created');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $locationType = LocationType::find($id);
        return view('master.location_types.show',compact('locationType'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $locationType = LocationType::find($id);
        return view('master.location_types.edit',compact('locationType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLocationTypeRequest $request, LocationType $locationType)
    {
        $locationType->update($request->toArray());
        return redirect()->route('location_types.index')->with('message', 'Location Type Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $locationType = LocationType::find($id);
        $locationType->delete();
        return redirect()->route('location_types.index')
            ->with('danger', 'Location Type Deleted successfully');
    }
}
