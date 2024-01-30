<?php

namespace App\Http\Controllers\master;

use App\DataTables\master\LocationDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLocationRequest;
use App\Http\Requests\UpdateLocationRequest;
use App\Models\master\Location;
use App\Models\master\LocationType;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function __construct()
    {
        $this->middleware('permission:master-location-list|master-location-create|master-location-edit|master-location-delete', ['only' => ['index','store']]);
        $this->middleware('permission:master-location-create', ['only' => ['create','store']]);
        $this->middleware('permission:master-location-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:master-location-delete', ['only' => ['destroy']]);
    }

    public function index(LocationDataTable $dataTable)
    {
        return $dataTable->render('master.locations.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $locationTypes = LocationType::get();
        return view('master.locations.create', compact('locationTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLocationRequest $request)
    {
        Location::create($request->all());
        return redirect()->route('locations.index')->with('success','Location Created');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $location = Location::join('location_types','location_types.id','=','locations.location_type_id')
        ->where('locations.id',$id)
        ->get(['locations.name','location_types.name as locationTypes']);

        return view('master.locations.show',compact('location'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $locationTypes = LocationType::get();

        $location = Location::leftJoin('location_types','location_types.id','=','locations.location_type_id')
            ->where('locations.id',$id)
            ->get(['locations.name','locations.id','location_types.id as location_type_id','location_types.name as location_type_name']);

        return view('master.locations.edit',compact('location','locationTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLocationRequest $request, Location $location)
    {
        $location->update($request->toArray());
        return redirect()->route('locations.index')->with('message', 'Location Type Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $location = Location::find($id);
        $location->delete();
        return redirect()->route('locations.index')
            ->with('danger', 'Location Deleted successfully');
    }
}
