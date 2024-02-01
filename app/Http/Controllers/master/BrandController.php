<?php

namespace App\Http\Controllers\master;

use App\Models\master\Brand;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBrandRequest;
use App\DataTables\master\BrandDataTable;
use App\Http\Requests\UpdateBrandRequest;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function __construct()
    {
        $this->middleware('permission:master-brand-list|master-brand-create|master-brand-edit|master-brand-delete', ['only' => ['index','store']]);
        $this->middleware('permission:master-brand-create', ['only' => ['create','store']]);
        $this->middleware('permission:master-brand-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:master-brand-delete', ['only' => ['destroy']]);
    }

    public function index(BrandDataTable $dataTable)
    {
        return $dataTable->render('master.brands.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('master.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBrandRequest $request)
    {
        Brand::create($request->all());
        return redirect()->route('brands.index')->with('success','Brand Created');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $brand = Brand::find($id);
        return view('master.brands.show',compact('brand'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $brand = Brand::find($id);
        return view('master.brands.edit',compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBrandRequest $request, Brand $brand)
    {
        $brand->update($request->toArray());
        return redirect()->route('brands.index')->with('message', 'Brand Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $brand = Brand::find($id);
        $brand->delete();
        return redirect()->route('brands.index')
            ->with('danger', 'Brand Deleted successfully');
    }
}
