@extends('layouts.app')


@section('content')
<div class="container-fluid">
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Quarter</h1>
            </div>
          </div>
    </section>
  </div>

  <div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-teal">
                <div class="card-header">
                    <h3 class="card-title">Update Quarter</h3>
                </div>

                <form role="form" action="{{ route('quarters.update',$quarter->id) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="card-body">

                        <div class="form-group row">
                            <label for="year" class="col-sm-2 col-form-label">Year</label>
                            <div class="col-sm-6">
                                <input type="number" class="form-control @error('year')
                                    is-invalid @enderror" name="year" value="{{ $quarter->year }}" id="year"
                                       autocomplete="off"
                                       min="{{ date('Y') }}" max="3000">
                                <span class="text-danger">@error('year') {{ $message }} @enderror</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control @error('name')
                                is-invalid @enderror" name="name" value="{{ $quarter->name }}" id="name" autocomplete="off">
                                <span class="text-danger">@error('name') {{ $message }} @enderror</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="from_date" class="col-sm-2 col-form-label">From Date</label>
                            <div class="col-sm-6">
                                <input type="date" class="form-control @error('from_date')
                                is-invalid @enderror" name="from_date" value="{{ $quarter->from_date }}" id="from_date" autocomplete="off"
                                       min="{{ date('YYY-mm-dd') }}" max="3000">
                                <span class="text-danger">@error('from_date') {{ $message }} @enderror</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="to_date" class="col-sm-2 col-form-label">To Date</label>
                            <div class="col-sm-6">
                                <input type="date" class="form-control @error('to_date')
                                is-invalid @enderror" name="to_date" value="{{ $quarter->to_date }}" id="to_date" autocomplete="off"
                                       min="{{ date('YYY-mm-dd') }}" max="3000">
                                <span class="text-danger">@error('to_date') {{ $message }} @enderror</span>
                            </div>
                        </div>

                    </div>

                        <div class="card-footer">
                            <a href="{{ route('quarters.index') }}" class="btn btn-sm bg-info"><i class="fa fa-arrow-circle-left"></i> Back</a>
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
