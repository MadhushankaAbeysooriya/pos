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
                            <li class="breadcrumb-item ">Menu Management</li>
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
                        <h3 class="card-title">Create New Menu</h3>
                        {{-- <div class="card-tools">
                            <a class="btn btn-primary" href="{{ route('roles.index') }}"> Back</a>
                        </div> --}}
                    </div>

                    <form role="form" method="POST" action="{{route('menus.store')}}"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">

                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control @error('name')
                                        is-invalid @enderror" name="name" value="{{ old('name') }}" id="name"
                                           autocomplete="off">
                                    <span class="text-danger">@error('name') {{ $message }} @enderror</span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label">Ration Date</label>
                                <div class="col-sm-6">
                                    <select name="ration_date_id" id="ration_date_id" class="form-control">
                                        @foreach($rationDate as $item)
                                            <option value="{{ $item->id }}">
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
                                        @foreach($rationType as $item)
                                            <option value="{{ $item->id }}">
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
                                        @foreach($rationTime as $item)
                                            <option value="{{ $item->id }}">
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
                                        is-invalid @enderror" name="year" value="{{ old('year') }}" id="year"
                                           autocomplete="off">
                                    <span class="text-danger">@error('year') {{ $message }} @enderror</span>
                                </div>
                            </div>

                        </div>

                        <div class="card-footer">
                            <a href="{{ route('menus.index') }}" class="btn btn-sm bg-info"><i
                                        class="fa fa-arrow-circle-left"></i> Back</a>
                            <button type="reset" class="btn btn-sm btn-secondary">Cancel</button>
                            @can('master-menu-create')
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
