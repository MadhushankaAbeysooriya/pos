@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Receipt for - {{ $demand_from_location->demand_ref }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item ">Reciept from Locations</li>
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
                        <h3 class="card-title">Create New Reciept</h3>
                    </div>

                    <form role="form" method="POST"
                          action="{{route('receipt_from_locations.store',$demand_from_location->id)}}"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">

                            <div class="form-group row">
                                <label for="year" class="col-sm-1 col-form-label">Year</label>
                                <label for="year"
                                       class="col-sm-3 col-form-label">{{ $demand_from_location->year }}</label>

                                <label for="year" class="col-sm-1 col-form-label">Date</label>
                                <label for="year"
                                       class="col-sm-3 col-form-label">{{ \Carbon\Carbon::parse($demand_from_location->request_date)->format('Y-m-d') }}</label>

                                <label for="year" class="col-sm-1 col-form-label">Supplier</label>
                                <label for="year"
                                              class="col-sm-3 col-form-label">{{ $demand_from_location->supplier->name }}</label>

                            </div>

                            <div class="form-group row mt-4">
                                <label for="receipt_date" class="col-sm-1 col-form-label">Date</label>
                                <div class="col-sm-3">
                                    <input type="date" class="form-control @error('receipt_date')
                                    is-invalid @enderror" name="receipt_date" value="{{ old('receipt_date') }}" id="receipt_date" autocomplete="off"
                                           min="{{ date('YYY-mm-dd') }}" max="3000">
                                    <span class="text-danger">@error('receipt_date') {{ $message }} @enderror</span>
                                </div>
                            </div>

                            @foreach ($demand_from_location->demandfromlocationitems as $index => $demandfromlocationitem)
                            <div class="form-group row mt-4">
                                <label class="col-sm-1 col-form-label" for="item_id[]">Item</label>
                                <div class="col-sm-3">
                                    <select name="item_id[]" id="item_id.{{ $index }}" class="form-control select2 item-selector">
                                        <option value="">Please Select</option>
                                        @foreach($items as $item)
                                            <option value="{{ $item->id }}" {{ $demandfromlocationitem->item_id == $item->id ? 'selected' : '' }}>
                                                {{ $item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('item_id.*')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <label for="qty" class="col-sm-1 col-form-label">Qty</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control qty-selector @error('qty.*') is-invalid @enderror" name="qty[]" value="{{ $demandfromlocationitem->qty }}" id="qty.{{ $index }}" autocomplete="off" min="{{ date('Y') }}" max="3000">
                                    <span class="text-danger">@error('qty.*') {{ $message }} @enderror</span>
                                </div>

                                <label class="col-sm-1 col-form-label" for="brand_id">Brand</label>
                                <div class="col-sm-3">
                                    <select name="brand_id[]" id="brand_id.{{ $index }}" class="form-control select2 brand-selector">
                                        <option value="">Please Select</option>
                                        @foreach($brands as $item)
                                            <option value="{{ $item->id }}" {{ $demandfromlocationitem->brand_id == $item->id ? 'selected' : '' }}>
                                                {{ $item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('brand_id.*')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="receipt_type_id">Receipt Type</label>
                                    <div class="col-sm-6">
                                        <select name="receipt_type_id[]" id="receipt_type_id.{{ $index }}" class="form-control select2 receipt-type-selector common-init">
                                            <option value="">Please Select</option>
                                            @foreach($receiptTypes as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('receipt_type_id.*')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                        @endforeach

                        </div>

                        <div class="card-footer">
                            <a href="{{ route('demand_from_locations.index') }}" class="btn btn-sm bg-info"><i
                                        class="fa fa-arrow-circle-left"></i> Back</a>
                            <button type="reset" class="btn btn-sm btn-secondary">Cancel</button>
                                <button type="submit" class="btn btn-sm btn-success">Create</button>
                        </div>
                </div>

                </form>

            </div>
        </div>
    </div>
    </div>
@endsection

@push('page_scripts')

{{-- <script>
    $(document).ready(function () {
        $('.select2').select2();

        // Common initialization for all receipt-type-selectors
        $('.common-init').each(function () {
            var index = $(this).data('index');
            $(this).val(2).trigger('change');
        });

        // Store initial values for each set
        var initialItemValues = [];
        var initialQtyValues = [];
        var initialBrandValues = [];

        $('.item-selector').each(function () {
            initialItemValues.push($(this).val());
        });

        $('.qty-selector').each(function () {
            initialQtyValues.push($(this).val());
        });

        $('.brand-selector').each(function () {
            initialBrandValues.push($(this).val());
        });

        // Add an event listener to the item-selector, qty-selector, and brand-selector
        $('.item-selector, .qty-selector, .brand-selector').on('change', function () {
            // Get the current values
            var currentItemId = $(this).closest('.form-group').find('.item-selector').val();
            var currentQty = $(this).closest('.form-group').find('.qty-selector').val();
            var currentBrandId = $(this).closest('.form-group').find('.brand-selector').val();

            // Get the index of the current set
            var index = $('.item-selector').index(this);

            // Check if values have changed
            if (
                currentItemId !== initialItemValues[index] ||
                currentQty !== initialQtyValues[index] ||
                currentBrandId !== initialBrandValues[index]
            ) {
                // Handle the update demand logic here
                $(this).closest('.form-group').find('.receipt-type-selector').val(1).trigger('change');
            } else {
                $(this).closest('.form-group').find('.receipt-type-selector').val(2).trigger('change');
            }
        });
    });
</script> --}}

<script>
    $(document).ready(function () {
        $('.select2').select2();

        // Common initialization for all receipt-type-selectors
        $('[id^=receipt_type_id]').each(function () {
            var index = $(this).data('index');
            $(this).val(2).trigger('change');
        });

        // Store initial values for each set
        var initialItemValues = [];
        var initialQtyValues = [];
        var initialBrandValues = [];

        $('[id^=item_id]').each(function () {
            initialItemValues.push($(this).val());
        });

        $('[id^=qty]').each(function () {
            initialQtyValues.push($(this).val());
        });

        $('[id^=brand_id]').each(function () {
            initialBrandValues.push($(this).val());
        });

        // Add an event listener to the item-selector, qty-selector, and brand-selector
        $('[id^=item_id], [id^=qty], [id^=brand_id]').on('change', function () {
            // Extract the index from the ID
            var index = $(this).attr('id').split('.').pop();

            // Get the current values
            var currentItemId = $('#item_id\\.' + index).val();
            var currentQty = $('#qty\\.' + index).val();
            var currentBrandId = $('#brand_id\\.' + index).val();
            console.log(currentItemId);

            // Check if values have changed
            if (
                currentItemId !== initialItemValues[index] ||
                currentQty !== initialQtyValues[index] ||
                currentBrandId !== initialBrandValues[index]
            ) {
                console.log('in if');
                // Handle the update demand logic here
                $('#receipt_type_id\\.' + index).val(1).trigger('change');
            } else {
                console.log('in else');
                $('#receipt_type_id\\.' + index).val(2).trigger('change');
            }
        });
    });
</script>


@endpush
