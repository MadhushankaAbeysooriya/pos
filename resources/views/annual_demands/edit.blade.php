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
                  <li class="breadcrumb-item active">Update</li>
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
                    <h3 class="card-title">Update Annual Demand</h3>
                    {{-- <div class="card-tools">
                        <a class="btn btn-primary" href="{{ URL::previous() }}"> Back</a>
                    </div> --}}
                </div>

                <form role="form" action="{{ route('annual_demands.update',$annualDemand->id) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="card-body">

                        <div class="form-group row">
                            <label for="year" class="col-sm-2 col-form-label">Year</label>
                            <div class="col-sm-6">
                                <input type="number" class="form-control @error('year')
                                is-invalid @enderror" name="year" value="{{ $annualDemand->year }}" id="year" autocomplete="off"
                                min="{{ date('Y') }}" max="3000">
                                <span class="text-danger">@error('year') {{ $message }} @enderror</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="item_id">Item</label>
                            <div class="col-sm-6">
                                <select name="item_id" id="item_id" class="form-control select2">
                                    <option value="">Please Select</option>
                                    @foreach($items as $item)
                                        <option value="{{ $item->id }}" {{$annualDemand->item_id == $item->id ? 'selected':''}}>
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
                                        <option value="{{ $item->id }}" {{$annualDemand->location_id == $item->id ? 'selected':''}}>
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
                                        <option value="{{ $item->id }}" {{$annualDemand->supplier_id == $item->id ? 'selected':''}}>
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
                                        <option value="{{ $item->id }}" {{$annualDemand->brand_id == $item->id ? 'selected':''}}>
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
                                is-invalid @enderror" name="qty" value="{{ $annualDemand->qty }}" id="qty" autocomplete="off"
                                min="0">
                                <span class="text-danger">@error('qty') {{ $message }} @enderror</span>
                            </div>
                        </div>

                    </div>

                        <div class="card-footer">
                            <a href="{{ url()->previous() }}" class="btn btn-sm bg-info"><i class="fa fa-arrow-circle-left"></i> Back</a>
                                <button type="reset" class="btn btn-sm btn-secondary">Cancel</button>
                                <button type="submit" class="btn btn-sm btn-success" >Update</button>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
  </div>
@endsection
