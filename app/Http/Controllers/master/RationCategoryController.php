<?php

namespace App\Http\Controllers\master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\master\RationCategoryDataTable;
use App\Models\master\RationCategory;
use App\Http\Requests\StoreRationCategoryRequest;
use App\Http\Requests\UpdateRationCategoryRequest;

class RationCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function __construct()
    {
        $this->middleware('permission:master-ration-categories-list|master-ration-categories-create|master-ration-categories-edit|master-ration-categories-delete', ['only' => ['index','store']]);
        $this->middleware('permission:master-ration-categories-create', ['only' => ['create','store']]);
        $this->middleware('permission:master-ration-categories-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:master-ration-categories-delete', ['only' => ['destroy']]);
    }

    public function index(RationCategoryDataTable $dataTable)
    {
        return $dataTable->render('master.ration_categories.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('master.ration_categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRationCategoryRequest $request)
    {
        RationCategory::create($request->all());
        return redirect()->route('ration_categories.index')->with('success','Ration Category Created');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $rationCategory = RationCategory::find($id);
        return view('master.ration_categories.show',compact('rationCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $rationCategory = RationCategory::find($id);
        return view('master.ration_categories.edit',compact('rationCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRationCategoryRequest $request, RationCategory $rationCategory)
    {
        $rationCategory->update($request->toArray());
        return redirect()->route('ration_categories.index')->with('message', 'Ration Category Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $rationCategory = RationCategory::find($id);
        $rationCategory->delete();
        return redirect()->route('ration_categories.index')
            ->with('danger', 'Ration Category Deleted successfully');
    }
}
