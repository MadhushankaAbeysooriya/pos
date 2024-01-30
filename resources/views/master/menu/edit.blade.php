@extends('layouts.app')


@section('content')
<div class="container-fluid">
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Menus</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item ">Master Data</li>
                  <li class="breadcrumb-item ">Menus Management</li>
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
                    <h3 class="card-title">Update Menu</h3>
                    {{-- <div class="card-tools">
                        <a class="btn btn-primary" href="{{ route('roles.index') }}"> Back</a>
                    </div> --}}
                </div>

                <form role="form" action="{{ route('menus.update',$menu->id) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="card-body">

                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control @error('name')
                                is-invalid @enderror" name="name" value="{{ $menu->name }}" id="name" autocomplete="off">
                                <span class="text-danger">@error('name') {{ $message }} @enderror</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Ration Date</label>
                            <div class="col-sm-6">
                                <select name="ration_date_id" id="ration_date_id" class="form-control">
                                    <option value=""></option>
                                    @foreach($rationDate as $item)
                                        <option value="{{ $item->id }}" @if ($menu->ration_date_id == $item->id)
                                            @selected(true)
                                        @endif>
                                            {{ $item->name}}
                                        </option>
                                    @endforeach
                                </select>
                                @error('ration_date_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Ration Type</label>
                            <div class="col-sm-6">
                                <select name="ration_type_id" id="ration_type_id" class="form-control">
                                    <option value=""></option>
                                    @foreach($rationType as $item)
                                        <option value="{{ $item->id }}" @selected($menu->ration_type_id==$item->id)>
                                            {{ $item->name}}
                                        </option>
                                    @endforeach
                                </select>
                                @error('ration_type_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Ration Time</label>
                            <div class="col-sm-6">
                                <select name="ration_time_id" id="ration_time_id" class="form-control">
                                    <option value=""></option>
                                    @foreach($rationTime as $item)
                                        <option value="{{ $item->id }}" @selected($menu->ration_time_id==$item->id)>
                                            {{ $item->name}}
                                        </option>
                                    @endforeach
                                </select>
                                @error('ration_time_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="year" class="col-sm-2 col-form-label">Year</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control @error('year')
                                is-invalid @enderror" name="year" value="{{ $menu->year }}" id="year" autocomplete="off">
                                <span class="text-danger">@error('year') {{ $message }} @enderror</span>
                            </div>
                        </div>

                    </div>

                        <div class="card-footer">
                            <a href="{{ route('menus.index') }}" class="btn btn-sm bg-info"><i class="fa fa-arrow-circle-left"></i> Back</a>
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
