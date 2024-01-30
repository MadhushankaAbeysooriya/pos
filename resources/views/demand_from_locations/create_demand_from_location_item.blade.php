@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add Items for - {{ $demandfromlocation->demand_ref }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item ">Demand from Locations Add Items</li>
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
                        <h3 class="card-title">Add Items</h3>
                    </div>

                    <form role="form" method="POST"
                          action="{{route('demand_from_locations.add_items_store',$demandfromlocation->id)}}"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">

                            <div class="form-group row">
                                <label for="year" class="col-sm-1 col-form-label">Year</label>
                                <label for="year"
                                       class="col-sm-3 col-form-label">{{ $demandfromlocation->year }}</label>

                                <label for="year" class="col-sm-1 col-form-label">Date</label>
                                <label for="year"
                                       class="col-sm-3 col-form-label">{{ \Carbon\Carbon::parse($demandfromlocation->request_date)->format('Y-m-d') }}</label>

                                <label for="year" class="col-sm-1 col-form-label">Supplier</label>
                                <label for="year"
                                       class="col-sm-3 col-form-label">{{ $demandfromlocation->supplier->name }}</label>

                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="item_id">Item</label>
                                <div class="col-sm-6">
                                    <select name="item_id" id="item_id" class="form-control select2">
                                        <option value="">Please Select</option>
                                        @foreach($items as $item)
                                            <option value="{{ $item->id }}">
                                                {{ $item->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('item_id')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>



                            <div class="form-group row">
                                <label for="qty" class="col-sm-2 col-form-label">Qty</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control @error('qty')
                                    is-invalid @enderror" name="qty" value="{{ old('qty') }}" id="qty" autocomplete="off"
                                           min="0">
                                    <span class="text-danger">@error('qty') {{ $message }} @enderror</span>
                                </div>
                                {{-- <div id="measurementName" class="col-sm-2 col-form-label"></div> --}}
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="brand_id">Brand</label>
                                <div class="col-sm-6">
                                    <select name="brand_id" id="brand_id" class="form-control select2">
                                        <option value="">Please Select</option>
                                        @foreach($brands as $item)
                                            <option value="{{ $item->id }}">
                                                {{ $item->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('brand_id')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <div class="card-footer">
                            <a href="{{ route('demand_from_locations.index') }}" class="btn btn-sm bg-info"><i
                                        class="fa fa-arrow-circle-left"></i> Back</a>
                            <button type="reset" class="btn btn-sm btn-secondary">Cancel</button>
                                <button type="submit" class="btn btn-sm btn-success">Add</button>
                        </div>
                </div>

                </form>

                <table class="table table-striped table-hover">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Item</th>
                        <th scope="col">Qty</th>
                        <th scope="col">Brand</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($demandfromlocation->demandfromlocationitems as $index => $item)

                            <tr>
                                <th scope="row">{{ $index + 1 }}</th>
                                <td>{{ $item->item->name }}</td>
                                <td>{{ $item->qty  }}</td>
                                <td>{{ $item->brand->name  }}</td>
                                <td>
                                    <form action="{{ route('demand_from_locations.add_items_delete', ['id' => $item->id, 'demand_from_location'=>$demandfromlocation->id]) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn bg-danger">Delete</button>
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
@endsection

@push('page_scripts')

    <script>

        // $(document).ready(function() {
        //     $('.select2').select2();
        // });

        $(document).ready(function () {
            $('.select2').select2();


            // // Event listener for item selection change
            // $('#item_id').on('change', function () {
            //     var selectedItem = $('#item_id').val();
            //     console.log(selectedItem);

            //     // Check if the selected item has details
            //     if (selectedItem) {
            //         // Update the measurement name
            //
            //     } else {
            //         // Clear the measurement name if no details found
            //         document.getElementById('measurementName').textContent = '';
            //     }
            // });

        });


    </script>

@endpush
