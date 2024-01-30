@extends('layouts.app')


@section('content')
<div class="container-fluid">
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Supplier</h1>
            </div>
          </div>
    </section>
  </div>

  <div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-teal">
                <div class="card-header">
                    <h3 class="card-title">Update Supplier</h3>
                    {{-- <div class="card-tools">
                        <a class="btn btn-primary" href="{{ URL::previous() }}"> Back</a>
                    </div> --}}
                </div>

                <form role="form" action="{{ route('suppliers.update',$supplier->id) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="card-body">

                        <div class="form-group row">
                            <label for="name" class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control @error('name')
                                is-invalid @enderror" name="name" value="{{ $supplier->name }}" id="name" autocomplete="off">
                                <span class="text-danger">@error('name') {{ $message }} @enderror</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="primary_contact" class="col-sm-3 col-form-label">Primary Contact Number</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control @error('primary_contact')
                                is-invalid @enderror" name="primary_contact" value="{{  $supplier->primary_contact }}" id="primary_contact" autocomplete="off">
                                <span class="text-danger">@error('primary_contact') {{ $message }} @enderror</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="secondary_contact" class="col-sm-3 col-form-label">Secondary Contact Number</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control @error('secondary_contact')
                                is-invalid @enderror" name="secondary_contact" value="{{ $supplier->secondary_contact }}" id="secondary_contact" autocomplete="off">
                                <span class="text-danger">@error('secondary_contact') {{ $message }} @enderror</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address" class="col-sm-3 col-form-label">Address</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control @error('address')
                                is-invalid @enderror" name="address" value="{{ $supplier->address }}" id="address" autocomplete="off">
                                <span class="text-danger">@error('address') {{ $message }} @enderror</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="reg_no" class="col-sm-3 col-form-label">Registered Number</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control @error('reg_no')
                                is-invalid @enderror" name="reg_no" value="{{ $supplier->reg_no }}" id="reg_no" autocomplete="off">
                                <span class="text-danger">@error('reg_no') {{ $message }} @enderror</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="vat_no" class="col-sm-3 col-form-label">VAT Number</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control @error('vat_no')
                                is-invalid @enderror" name="vat_no" value="{{ $supplier->vat_no }}" id="vat_no" autocomplete="off">
                                <span class="text-danger">@error('vat_no') {{ $message }} @enderror</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="account_no" class="col-sm-3 col-form-label">Account Number</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control @error('account_no')
                                    is-invalid @enderror" name="account_no" value="{{ $supplier->account_no }}" id="account_no"
                                        autocomplete="off">
                                <span class="text-danger">@error('account_no') {{ $message }} @enderror</span>
                            </div>
                        </div>
                    </div>

                        <div class="card-footer">
                            <a href="{{ route('suppliers.index') }}" class="btn btn-sm bg-info"><i class="fa fa-arrow-circle-left"></i> Back</a>
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
