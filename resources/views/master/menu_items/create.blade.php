@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{ $menu->name }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item ">Master Data</li>
                  <li class="breadcrumb-item ">Menu for Items Management</li>
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
                            <h3 class="card-title">Create {{ $menu->name }} Menu for Items</h3>
                            {{-- <div class="card-tools">
                                <a class="btn btn-primary" href="{{ route('roles.index') }}"> Back</a>
                            </div> --}}
                        </div>

                        <form role="form" method="POST" action="{{route('menu_items.store',$menu->id)}}"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">

 

                                <div class="form-group row">
                                    <label for="name" class="col-sm-3 col-form-label">Item Name</label>
                                    <div class="col-sm-5">
                                        <select name="item_id" id="item_id" class="form-control">
                                            @foreach($itemList as $itemName)
                                                <option value="{{ $itemName->id }}">
                                                    {{ $itemName->name}}
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
                                    <label for="per_qty" class="col-sm-3 col-form-label">Quantity for Person (g/ml)</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control @error('per_qty')
                                        is-invalid @enderror" name="per_qty" value="{{ old('per_qty') }}" id="per_qty" autocomplete="off">
                                        <span class="text-danger">@error('per_qty') {{ $message }} @enderror</span>
                                    </div>
                                </div>

                            </div>

                            <div class="card-footer">
                                <a href="{{ url()->previous() }}" class="btn btn-sm bg-info"><i class="fa fa-arrow-circle-left"></i> Back</a>
                                    <button type="reset" class="btn btn-sm btn-secondary">Cancel</button>
                                    <button type="submit" class="btn btn-sm btn-success" >Create</button>
                            </div>
                        </div>

                        </form>
                        
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">All Selected Items for {{ $menu->name }} Menu</h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Item Name</th>
                                            <th class="text-center">Quantity</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($menu->menuitem as $item)
                                        <tr>
                                            <td>{{ $item->selectitem->name }}</td>
                                            <td class="text-center">{{ $item->per_qty }}</td>
                                            <td class="text-center">
                                                <form method="POST" action="{{ route('menu_items.destroy', ['menu' => $menu->id, 'menu_item' => $item->id]) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                
                                                    <button type="submit" class="btn btn-xs btn-danger" data-toggle="tooltip" title="Delete">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>

                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                    </div>


                    

                </div>
            </div>
        </div>
@endsection
