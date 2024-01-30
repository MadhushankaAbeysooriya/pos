<?php

namespace App\Http\Controllers\master;

use Illuminate\Http\Request;
use App\Models\master\RationDate;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRationDateRequest;
use App\DataTables\master\RationDateDataTable;
use App\Http\Requests\UpdateRationDateRequest;

class RationDateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function __construct()
    {
        $this->middleware('permission:master-ration-date-list|master-ration-date-create|master-ration-date-edit|master-ration-date-delete', ['only' => ['index','store']]);
        $this->middleware('permission:master-ration-date-create', ['only' => ['create','store']]);
        $this->middleware('permission:master-ration-date-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:master-ration-date-delete', ['only' => ['destroy']]);
    }

    public function index(RationDateDataTable $dataTable)
    {
        return $dataTable->render('master.ration_date.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('master.ration_date.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRationDateRequest $request)
    {
        RationDate::create($request->all());
        return redirect()->route('ration_dates.index')->with('success','Ration date Created');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $rationDate = RationDate::find($id);

        return view('master.ration_date.show',compact('rationDate'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $rationDate = RationDate::find($id);
        return view('master.ration_date.edit',compact('rationDate'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRationDateRequest $request, RationDate $rationDate)
    {
        $rationDate->update($request->toArray());
        return redirect()->route('ration_dates.index')->with('message', 'Ration Date Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $rationDate = RationDate::find($id);
        $rationDate->delete();
        return redirect()->route('ration_dates.index')
            ->with('danger', 'Ration Date Deleted successfully');
    }
}
