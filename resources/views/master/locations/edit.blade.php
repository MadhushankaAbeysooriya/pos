@extends('layouts.app')


@section('content')
<div class="container-fluid">
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Location/</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item ">Master Data</li>
                  <li class="breadcrumb-item ">Location Management</li>
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
                    <h3 class="card-title">Update Location Type</h3>
                    {{-- <div class="card-tools">
                        <a class="btn btn-primary" href="{{ route('roles.index') }}"> Back</a>
                    </div> --}}
                </div>

                <form role="form" action="{{ route('locations.update',$location->id) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="card-body">

                        <div class="form-group row">
                            <label for="location_type_id" class="col-sm-2 col-form-label">Location Type</label>
                            <div class="col-sm-6">
                                <select class="form-control" name="location_type_id" id="location_type_id" autocomplete="off">
                                    @foreach($locationTypes as $item)
                                        <option value="{{$item->id}}" {{$location->location_type_id == $item->id ?'selected':''}}>{{$item->name}}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger">@error('location_type_id') {{ $message }} @enderror</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control @error('name')
                                is-invalid @enderror" name="name" value="{{ $location->name }}" id="name" autocomplete="off">
                                <span class="text-danger">@error('name') {{ $message }} @enderror</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="under_cmd_location_id" class="col-sm-2 col-form-label">Under Command Location</label>
                            <div class="col-sm-6">
                                <select class="form-control select2" name="under_cmd_location_id" id="under_cmd_location_id"
                                        autocomplete="off">
                                    <option value="" selected>select one</option>
                                    @foreach($locations as $item)
                                        <option value="{{$item->id}}" {{$location->under_cmd_location_id == $item->id ?'selected':''}}>{{$item->name}}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger">@error('under_cmd_location_id') {{ $message }} @enderror</span>
                            </div>
                        </div>

                    </div>

                        <div class="card-footer">
                            <a href="{{ route('locations.index') }}" class="btn btn-sm bg-info"><i class="fa fa-arrow-circle-left"></i> Back</a>
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
