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
                  <li class="breadcrumb-item active">View</li>
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
                    <h3 class="card-title">View Menu</h3>
                    <div class="card-tools">
                        <a class="btn btn-primary" href="{{ route('menus.index') }}"> Back</a>
                    </div>
                </div>

                <div class="card-body">

                    <div class="form-group row">
                        <label class="col-sm-2">
                            <strong>Menu Name : </strong>
                        </label>
                        <div class="col-sm-10">
                            {{ $menu->name }}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2">
                            <strong>Ration Date : </strong>
                        </label>
                        <div class="col-sm-10">
                            {{ $rationDate->name }}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2">
                            <strong>Ration Type : </strong>
                        </label>
                        <div class="col-sm-10">
                            {{ $rationType->name }}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2">
                            <strong>Ration Time : </strong>
                        </label>
                        <div class="col-sm-10">
                            {{ $rationTime->name }}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2">
                            <strong>Year : </strong>
                        </label>
                        <div class="col-sm-10">
                            {{ $menu->year }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
