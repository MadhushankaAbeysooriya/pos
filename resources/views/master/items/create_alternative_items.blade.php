@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Alternative Items/ {{isset($item->name)?$item->name:''}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item ">Master Data</li>
                            <li class="breadcrumb-item ">Item Management</li>
                            <li class="breadcrumb-item active">Alternative Items</li>
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
                        <h3 class="card-title">Create New Item</h3>
                        {{-- <div class="card-tools">
                            <a class="btn btn-primary" href="{{ route('roles.index') }}"> Back</a>
                        </div> --}}
                    </div>

                    <form role="form" method="POST" action="{{route('items.save_alternative',$item->id)}}"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">


                            <div class="form-group row">
                                <input type="hidden" name="item_id" value="{{$item->id}}">
                                <label for="alternative_item_id" class="col-sm-2 col-form-label">Alternative
                                    Item</label>
                                <div class="col-sm-6">
                                    <select class="form-control select2" name="alternative_item_id" id="alternative_item_id"
                                            autocomplete="off">
                                        <option value="" selected>select one</option>
                                        @foreach($items as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger">@error('alternative_item_id') {{ $message }}
                                        @enderror</span>
                                </div>
                            </div>


                        </div>

                        <div class="card-footer">
                            <a href="{{ route('items.index') }}" class="btn btn-sm bg-info"><i
                                        class="fa fa-arrow-circle-left"></i> Back</a>
                            <button type="reset" class="btn btn-sm btn-secondary">Cancel</button>
                            <button type="submit" class="btn btn-sm btn-success">Add</button>
                        </div>
                </div>

                </form>

            </div>


            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-teal">
                            <div class="card-body">

                                <table class="table">

                                    <thead>
                                    <tr>
                                        <th scope="col" width="10%">#</th>
                                        <th scope="col" width="80%">Alternative Item</th>
                                        <th class="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php $i = 1 ?>
                                    @foreach($alternativeItems as $alternativeItem)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$alternativeItem->item->name}}</td>
                                            <td class="">

                                                <form action="{{ route('items.delete_alternative', $alternativeItem->id) }}"
                                                      method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="item_id" value="{{$item->id}}">
                                                    <button type="submit"
                                                            class="btn bg-danger btn-xs dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700"
                                                            onclick="return confirm('Do you need to delete this');">
                                                        <i class="fa fa-trash-alt"></i>
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

    </div>
    </div>
    </div>
@endsection

@push('page_scripts')

    <script>

        $(document).ready(function() {
            $('.select2').select2();
        });

    </script>

@endpush

