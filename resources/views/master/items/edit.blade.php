@extends('layouts.app')


@section('content')
<div class="container-fluid">
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Items</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item ">Master Data</li>
                  <li class="breadcrumb-item ">Items Management</li>
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
                    <h3 class="card-title">Update Item</h3>
                    {{-- <div class="card-tools">
                        <a class="btn btn-primary" href="{{ route('roles.index') }}"> Back</a>
                    </div> --}}
                </div>

                <form role="form" action="{{ route('items.update',$item->id) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="card-body">

                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Name<span style="color: red;">*</span></label>
                                    <input type="text" class="form-control @error('name')
                                        is-invalid @enderror" name="name" value="{{ $item->name }}" id="name"
                                        autocomplete="off">
                                    <span class="text-danger">@error('name') {{ $message }} @enderror</span>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Barcode<span style="color: red;">*</span></label>
                                    <input type="text" class="form-control @error('barcode')
                                        is-invalid @enderror" name="barcode" value="{{ $item->barcode }}" id="barcode"
                                        autocomplete="off">
                                    <span class="text-danger">@error('barcode') {{ $message }} @enderror</span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Item Category<span style="color: red;">*</span></span></label>
                                    <select class="form-control select2" name="item_category_id" id="item_category_id" autocomplete="off">
                                            <option value="">Please Select</option>
                                            @foreach($itemCategorys as $itemCategory)
                                                <option value="{{$itemCategory->id}}" {{$item->item_category_id == $itemCategory->id ?'selected':''}}>{{$itemCategory->name}}</option>
                                            @endforeach
                                    </select>
                                    <span class="text-danger">@error('item_category_id') {{ $message }} @enderror</span>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Denomination<span style="color: red;">*</span></span></label>
                                    <select class="form-control select2" name="measurement_id" id="measurement_id"
                                            autocomplete="off">
                                        <option value="">Please Select</option>
                                        @foreach($measurements as $measurement)
                                            <option value="{{$measurement->id}}" {{$item->measurement_id == $measurement->id ?'selected':''}}>{{$measurement->name}}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger">@error('measurement_id') {{ $message }} @enderror</span>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Brand</span></label>
                                    <select class="form-control select2" name="brand_id" id="brand_id"
                                            autocomplete="off">
                                        <option value="">Please Select</option>
                                        @foreach($brands as $brand)
                                            <option value="{{$brand->id}}" {{$item->brand_id == $brand->id ?'selected':''}}>{{$brand->name}}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger">@error('brand_id') {{ $message }} @enderror</span>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Alert Quantity<span style="color: red;">* </span>
                                        <i class="fa fa-exclamation-circle text-info hover-q no-print" data-toggle="tooltip" data-html="true"
                                        title="Get alert when product stock reaches or goes below
                                        the specified quantity.<br><br><small class='text-muted'>Products with low stock will be displayed in
                                        dashboard - Product Stock Alert section.</small>"></i>
                                    </label>
                                    <input type="text" class="form-control @error('rol')
                                        is-invalid @enderror" name="rol" value="{{ $item->rol }}" id="rol"
                                        autocomplete="off">
                                    <span class="text-danger">@error('rol') {{ $message }} @enderror</span>
                                </div>
                            </div>

                            {{-- <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Product Image</label>
                                        {{-- <input type="file" name="product_image" class="custom-file-input @error('product_image') is-invalid @enderror" id="product_image" value="{{ old('product_image') }}"
                                        accept=".jpeg,.png,.jpg">
                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                        <span class="text-danger">@error('product_image') {{ $message }} @enderror</span> --}}

                            {{--            <input type="file" class="form-control @error('product_image') is-invalid @enderror" name="product_image" value="{{ old('product_image') }}" accept=".jpeg,.png,.jpg">
                                        <span class="text-danger">@error('product_image') {{ $message }} @enderror</span>
                                </div>
                            </div> --}}

                        </div>

                    </div>

                        <div class="card-footer">
                            <a href="{{ route('items.index') }}" class="btn btn-sm bg-info"><i class="fa fa-arrow-circle-left"></i> Back</a>
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

@push('page_scripts')

<script>

    $(document).ready(function () {
        $('.select2').select2();
    });

</script>

@endpush
