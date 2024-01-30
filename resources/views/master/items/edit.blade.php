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

                        <div class="form-group row">
                            <label for="item_category_id" class="col-sm-2 col-form-label">Item Category</label>
                            <div class="col-sm-6">
                                <select class="form-control" name="item_category_id" id="item_category_id" autocomplete="off">
                                    <option value="" selected>select one</option>
                                    @foreach($itemCategorys as $itemCategory)
                                        <option {{isset($item->item_category_id)?$item->item_category_id==$itemCategory->id?'selected':'':''}} value="{{$itemCategory->id}}">{{$itemCategory->name}}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger">@error('item_category_id') {{ $message }} @enderror</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control @error('name')
                                        is-invalid @enderror" name="name" value="{{ isset($item->name)?$item->name:'' }}" id="name" autocomplete="off">
                                <span class="text-danger">@error('name') {{ $message }} @enderror</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="measurement_id" class="col-sm-2 col-form-label">Demomination</label>
                            <div class="col-sm-6">
                                <select class="form-control" name="measurement_id" id="measurement_id" autocomplete="off">
                                    <option value="" selected>select one</option>
                                    @foreach($measurements as $measurement)
                                        <option {{isset($item->measurement_id)?$item->measurement_id==$measurement->id?'selected':'':''}} value="{{$measurement->id}}">{{$measurement->name}}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger">@error('measurement_id') {{ $message }} @enderror</span>
                            </div>
                        </div>

                        {{-- <div class="form-group row">
                            <label for="ration_category_id" class="col-sm-2 col-form-label">Ration Category</label>
                            <div class="col-sm-6">
                                <select class="form-control" name="ration_category_id" id="ration_category_id" autocomplete="off">
                                    <option value="" selected>select one</option>
                                    @foreach($rationCategories as $rationCategory)
                                        <option {{isset($item->ration_category_id)?$item->ration_category_id==$rationCategory->id?'selected':'':''}} value="{{$rationCategory->id}}">{{$rationCategory->name}}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger">@error('ration_category_id') {{ $message }} @enderror</span>
                            </div>
                        </div> --}}

                        <div class="form-group row">
                            <label for="ration_sub_category_id" class="col-sm-2 col-form-label">Ration Sub Category</label>
                            <div class="col-sm-6">
                                <select class="form-control" name="ration_sub_category_id" id="ration_sub_category_id" autocomplete="off">
                                    <option value="" selected>select one</option>
                                    @foreach($rationSubCategories as $rationsubcat)
                                        <option {{isset($item->ration_sub_category_id)?$item->ration_sub_category_id==$rationsubcat->id?'selected':'':''}} value="{{$rationsubcat->id}}">{{$rationsubcat->name}}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger">@error('ration_sub_category_id') {{ $message }} @enderror</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="is_vat">VAT Number Available..? </label>
                            <div class="col-sm-9">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="customSwitch1" name="is_vat" {{ $item->is_vat ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="customSwitch1" id="isVatLabel">
                                        {{ $item->is_vat ? 'Yes' : 'No' }}
                                    </label>
                                    <input type="hidden" name="is_vat" value="0"> <!-- Hidden field for unchecked state -->
                                </div>

                                @error('is_vat')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
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

            function updateValue() {
                if ($('#customSwitch1').prop('checked')) {
                    $('#isVatLabel').text('Yes');
                    $('input[name="is_vat"]').val(1);
                } else {
                    $('#isVatLabel').text('No');
                    $('input[name="is_vat"]').val(0);
                }
            }

            // Set initial value on page load
            updateValue();

            // Handle change event
            $('#customSwitch1').change(updateValue);

            // Submit form event
            $('form').submit(function() {
                // Ensure that the hidden input value is set based on the checkbox state
                updateValue();
            });
        });

    </script>

@endpush
