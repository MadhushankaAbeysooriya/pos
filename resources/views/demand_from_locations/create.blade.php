@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Demand from Locations</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item ">Master Data</li>
                  <li class="breadcrumb-item ">Demand from Locations Management</li>
                  <li class="breadcrumb-item active">Create</li>
                </ol>
            </div>
          </div>
    </section>
  </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-teal">
                        <div class="card-header">
                            <h3 class="card-title">Create New Demand from Location</h3>
                        </div>

                        <form role="form" method="POST" action="{{route('demand_from_locations.store')}}"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">

                                <div class="form-group row">
                                    <label for="year" class="col-sm-2 col-form-label">Year</label>
                                    <div class="col-sm-6">
                                        <input type="number" class="form-control @error('year')
                                        is-invalid @enderror" name="year" value="{{ old('year') }}" id="year" autocomplete="off"
                                        min="{{ date('Y') }}" max="3000">
                                        <span class="text-danger">@error('year') {{ $message }} @enderror</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="demand_ref" class="col-sm-2 col-form-label">Demand Ref</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control @error('demand_ref')
                                        is-invalid @enderror" name="demand_ref" value="{{ old('demand_ref') }}" id="demand_ref" autocomplete="off">
                                        <span class="text-danger">@error('demand_ref') {{ $message }} @enderror</span>
                                    </div>
                                </div>

                                {{-- <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="item_id">Item</label>
                                    <div class="col-sm-6">
                                        <select name="item_id" id="item_id" class="form-control select2">
                                            <option value="">Please Select</option>
                                            @foreach($items as $item)
                                                <option value="{{ $item->id }}">
                                                    {{ $item->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('item_id')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div> --}}

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="supplier_id">Supplier</label>
                                    <div class="col-sm-6">
                                        <select name="supplier_id" id="supplier_id" class="form-control select2">
                                            <option value="">Please Select</option>
                                            @foreach($suppliers as $supplier)
                                                <option value="{{ $supplier->id }}">
                                                    {{ $supplier->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('supplier_id')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- <div class="form-group row">
                                    <label for="qty" class="col-sm-2 col-form-label">Qty</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control @error('qty')
                                        is-invalid @enderror" name="qty" value="{{ old('qty') }}" id="qty" autocomplete="off"
                                               min="{{ date('Y') }}" max="3000">
                                        <span class="text-danger">@error('qty') {{ $message }} @enderror</span>
                                    </div>
                                </div> --}}

                                {{-- <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="location_id">Location</label>
                                    <div class="col-sm-6">
                                        <select name="location_id" id="location_id" class="form-control select2">
                                            <option value="">Please Select</option>
                                            @foreach($locations as $location)
                                                <option value="{{ $location->id }}">
                                                    {{ $location->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('location_id')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div> --}}

                                <div class="form-group row">
                                    <label for="request_date" class="col-sm-2 col-form-label">Date</label>
                                    <div class="col-sm-6">
                                        <input type="date" class="form-control @error('request_date')
                                        is-invalid @enderror" name="request_date" value="{{ old('request_date') }}" id="request_date" autocomplete="off"
                                               min="{{ date('YYY-mm-dd') }}" max="3000">
                                        <span class="text-danger">@error('request_date') {{ $message }} @enderror</span>
                                    </div>
                                </div>


                            </div>

                                <div class="card-footer">
                                    <a href="{{ route('demand_from_locations.index') }}" class="btn btn-sm bg-info"><i class="fa fa-arrow-circle-left"></i> Back</a>
                                        <button type="reset" class="btn btn-sm btn-secondary">Cancel</button>
                                        <button type="submit" class="btn btn-sm btn-success" >Create</button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
@endsection

@push('page_scripts')

    <script>

        $(document).ready(function() {
            $('.select2').select2();
        });

    </script>

@endpush
