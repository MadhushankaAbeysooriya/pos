@extends('layouts.app')


@section('content')
<div class="container-fluid">
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Ration Sub Category</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item ">Master Data</li>
                  <li class="breadcrumb-item ">Ration Sub Category Management</li>
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
                    <h3 class="card-title">Update Ration Sub Category</h3>
                    {{-- <div class="card-tools">
                        <a class="btn btn-primary" href="{{ URL::previous() }}"> Back</a>
                    </div> --}}
                </div>

                <form role="form" action="{{ route('ration_sub_categories.update',$rationSubCategory->id) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="card-body">

                        <div class="form-group row">
                            <label for="ration_category_id" class="col-sm-2 col-form-label">Ration Category</label>
                            <div class="col-sm-6">
                                <select class="form-control select2" name="ration_category_id" id="ration_category_id"
                                        autocomplete="off">
                                    <option value="" selected>Please Select</option>
                                    @foreach($rationCategories as $item)
                                        <option value="{{$item->id}}" {{$rationSubCategory->ration_category_id == $item->id ? 'selected':''}}>
                                            {{$item->name}}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="text-danger">@error('ration_category_id') {{ $message }} @enderror</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control @error('name')
                                is-invalid @enderror" name="name" value="{{ $rationSubCategory->name }}" id="name" autocomplete="off">
                                <span class="text-danger">@error('name') {{ $message }} @enderror</span>
                            </div>
                        </div>

                    </div>

                        <div class="card-footer">
                            <a href="{{ route('ration_sub_categories.index') }}" class="btn btn-sm bg-info"><i class="fa fa-arrow-circle-left"></i> Back</a>
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
