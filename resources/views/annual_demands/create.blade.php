@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Annual Demand</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item ">Master Data</li>
                            <li class="breadcrumb-item ">Annual Demand Management</li>
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
                        <h3 class="card-title">Create New Annual Demand</h3>
                    </div>

                    <form role="form" method="POST" action="{{route('annual_demands.store')}}"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">

                            <div class="form-group row">
                                <label for="year" class="col-sm-2 col-form-label">Year</label>
                                <div class="col-sm-6">
                                    <input type="number" class="form-control @error('year')
                                        is-invalid @enderror" name="year" value="{{ old('year') }}" id="year"
                                           autocomplete="off"
                                           min="{{ date('Y') }}" max="3000">
                                    <span class="text-danger">@error('year') {{ $message }} @enderror</span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="item_id">Item</label>
                                <div class="col-sm-6">
                                    <select name="item_id" id="item_id" class="form-control select2" required>
                                        <option value="">Please Select</option>
                                        @foreach($items as $item)
                                            <option value="{{ $item->id }}">
                                                {{ $item->name}}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('item_id')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="location_id">Location</label>
                                <div class="col-sm-6">
                                    <select name="location_id" id="location_id" class="form-control select2">
                                        <option value="">Please Select</option>
                                        @foreach($locations as $item)
                                            <option value="{{ $item->id }}">
                                                {{ $item->name}}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('location_id')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="supplier_id">Suppliers</label>
                                <div class="col-sm-6">
                                    <select name="supplier_id" id="supplier_id" class="form-control select2">
                                        <option value="">Please Select</option>
                                        @foreach($suppliers as $item)
                                            <option value="{{ $item->id }}">
                                                {{ $item->name}}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('supplier_id')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="brand_id">Brands</label>
                                <div class="col-sm-6">
                                    <select name="brand_id" id="brand_id" class="form-control select2">
                                        <option value="">Please Select</option>
                                        @foreach($brands as $item)
                                            <option value="{{ $item->id }}">
                                                {{ $item->name}}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('brand_id')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="qty" class="col-sm-2 col-form-label">Qty</label>
                                <div class="col-sm-6">
                                    <input type="number" class="form-control @error('qty')
                                        is-invalid @enderror" name="qty" value="{{ old('qty') }}" id="qty"
                                           autocomplete="off"
                                           min="0">
                                    <span class="text-danger">@error('qty') {{ $message }} @enderror</span>
                                </div>
                            </div>

                        </div>

                        <div class="card-footer">
                            <a href="{{ route('annual_demands.store') }}" class="btn btn-sm bg-info"><i
                                        class="fa fa-arrow-circle-left"></i> Back</a>
                            <button type="reset" class="btn btn-sm btn-secondary">Cancel</button>
                            @can('annual-demand-create')
                                <button type="submit" class="btn btn-sm btn-success">Create</button>
                            @endcan
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

        $(document).ready(function () {
            $('.select2').select2();
        });

    </script>

@endpush
