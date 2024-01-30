<?php

namespace App\Http\Controllers\master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\master\RationCategory;
use App\Models\master\RationSubCategory;
use App\Http\Requests\StoreRationCategoryRequest;
use App\Http\Requests\StoreRationSubCategoryRequest;
use App\DataTables\master\RationSubCategoryDataTable;
use App\Http\Requests\UpdateRationSubCategoryRequest;

class RationSubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(RationSubCategoryDataTable $dataTable)
    {
        return $dataTable->render('master.ration_sub_categories.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rationCategories = RationCategory::all();
        return view('master.ration_sub_categories.create',compact('rationCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRationSubCategoryRequest $request)
    {
        RationSubCategory::create($request->all());
        return redirect()->route('ration_sub_categories.index')->with('success','Ration Sub Category Created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $rationSubCategory = RationSubCategory::find($id);
        return view('master.ration_sub_categories.show',compact('rationSubCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $rationSubCategory = RationSubCategory::find($id);
        $rationCategories = RationCategory::all();

        return view('master.ration_sub_categories.edit',compact('rationSubCategory','rationCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRationSubCategoryRequest $request, RationSubCategory $rationSubCategory)
    {
        $rationSubCategory->update($request->toArray());
        return redirect()->route('ration_sub_categories.index')->with('message', 'Ration Sub Category Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $rationSubCategory = RationSubCategory::find($id);
        $rationSubCategory->delete();
        return redirect()->route('master.ration_sub_categories.index')
            ->with('danger', 'Ration Type Deleted successfully');
    }
}
