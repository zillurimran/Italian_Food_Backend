@extends('layouts.dashboard')
@section('title')
{{ config('app.name') }} | Food Offer Create
@endsection
@section('foodOfferCreate')
    active
@endsection
@push('theme-css')
    <link rel="stylesheet" href="{{ asset('dashboard_assets/assets/plugins/quill/css/quill.snow.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard_assets/app-assets/css/plugins/forms/form-quill-editor.css') }}">
@endpush

@push('vendor-js')
    <script src="{{ asset('dashboard_assets/assets/plugins/quill/js/quill.min.js') }}"></script>
    <script src="{{ asset('dashboard_assets/assets/plugins/quill/js/quill-image-resize.min.js') }}"></script>
@endpush
@section('content')
@push('page-js')
    <script src="{{ asset('dashboard_assets/app-assets/js/scripts/pages/custom-datatable.js') }}"></script>
@endpush
<section >
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Create Offer</h4>
                    @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if (session('warning'))
                        <div class="alert alert-warning">{{ session('warning') }}</div>
                    @endif
                </div>
                <div class="card-body">
                    <form action="{{ route('foodOffers.store') }}" method="POST" class="form form-vertical" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="category" class="form-label">Food Type</label>
                                    <span class="text-danger">*</span>
                                    <select id="food_type" name="food_type" class="form-control select2">
                                        <option value="" selected  disabled>Select</option>
                                        @foreach ($foodTypes as $foodType)
                                            <option value="{{ $foodType->id }}">{{ $foodType->food_type }}</option>
                                        @endforeach
                                        @error('food_type')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </select>
                                </div>
                                <div class="form-group hide" id="mystery_box">
                                    <label for="category" class="form-label">Mystery Type</label>
                                    <span class="text-danger">*</span>
                                    <select id="mystery" name="mystery_type_id" class="form-control">
                                        <option value="" selected  disabled>Select</option>
                                        @foreach ($mystery_types as $mystery_type)
                                            <option value="{{ $mystery_type->id }}">{{ $mystery_type->mystery_name }}</option>
                                        @endforeach
                                        @error('mystery_type_id')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="heading">Food Name</label>
                                    <span class="text-danger">*</span>
                                    <input type="text" name="food_name"  class="form-control" value="{{ old('food_name') }}"  placeholder="Enter food name">
                                    @error('food_name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Food Description</label>
                                    <div class="custom-editor-wrapper">
                                        <div class="custom-editor">{!! old('food_description') !!}</div>
                                            <input type="hidden" name="food_description" class="custom-editor-input" value="{{old('food_description')}}">
                                        @error('food_description')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <h4 >Upload detailed image<small class="text-danger"> *</small></h4>
                                    <label class="custom__file">
                                        <input type="file" name="food_image" class="custom__file__input">
                                        <span class="custom__file__label">
                                            <span class="custom__file__label__btn">Add file</span>
                                            <span class="custom__file__label__text">Accepts jpg,jpeg and png</span>
                                        </span>
                                    </label>
                                    @error('food_image')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <h4>Upload thumbnail image<small> (optional)</small></h4>
                                    <label class="custom__file">
                                        <input type="file" name="thumbnail_image" class="custom__file__input">
                                        <span class="custom__file__label">
                                            <span class="custom__file__label__btn">Add file</span>
                                            <span class="custom__file__label__text">Accepts jpg,jpeg and png</span>
                                        </span>
                                    </label>
                                    @error('thumbnail_image')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <h4>Upload list image<small> (optional)</small></h4>
                                    <label class="custom__file">
                                        <input type="file" name="list_image" class="custom__file__input">
                                        <span class="custom__file__label">
                                            <span class="custom__file__label__btn">Add file</span>
                                            <span class="custom__file__label__text">Accepts jpg,jpeg and png</span>
                                        </span>
                                    </label>
                                    @error('list_image')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="heading">Stock</label>
                                    <span class="text-danger">*</span>
                                    <input type="text" name="food_stock"  class="form-control" value="{{ old('food_stock') }}"  placeholder="Enter food stock">
                                    @error('food_stock')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="heading">Price</label>
                                    <span class="text-danger">*</span>
                                    <input type="text" name="price"  class="form-control" value="{{ old('price') }}"  placeholder="Enter price">
                                    @error('price')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="heading">Discount Price</label>
                                    {{-- <span class="text-danger">*</span> --}}
                                    <input type="text" name="discount_price"  class="form-control" value="0.00">
                                    @error('discount_price')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="heading">Price Prefix</label>
                                    <span class="text-danger">*</span>
                                    <input type="text" name="prefix"  class="form-control" value="{{ old('prefix') }}"  placeholder="Example: €, $ etc">
                                    @error('prefix')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="category" class="form-label">Boutique Name</label>
                                    <span class="text-danger">*</span>
                                    <select  name="boutique_id" class="form-control">
                                        <option value="" selected disabled>Select</option>
                                        @foreach ($boutiques as $boutique)
                                            <option  value="{{ $boutique->id }}" data-address="{{ $boutique->address }}">{{ $boutique->boutique_name.' - '.$boutique->address }}</option>
                                        @endforeach
                                        @error('boutique_name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </select>
                                </div>
                                {{-- <div class="form-group">
                                    <label for="heading">Pickup Location</label>
                                    <span class="text-danger">*</span>
                                    <input type="text" name="pickup_location"  class="form-control" value=""  placeholder="Enter location" >
                                </div> --}}
                                <div class="form-group my-2">
                                    <label for="heading">Pickup date</label>
                                    <div class="row">
                                        <div class="col-6">
                                            <p>From<span class="text-danger"> *</span></p>
                                            <input type="date" name="pickup_date_from"  class="form-control" value="" >
                                        </div>
                                        <div class="col-6">
                                            <p>To<span class="text-danger"> *</span></p>
                                            <input type="date" name="pickup_date_to"  class="form-control" value="" >
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group my-2">
                                    <label for="heading">Pickup Time</label>
                                    <div class="row">
                                        <div class="col-6">
                                            <p>From<span class="text-danger"> *</span></p>
                                            <input type="time" name="pickup_time_from"  class="form-control" value="" >
                                        </div>
                                        <div class="col-6">
                                            <p>To<span class="text-danger"> *</span></p>
                                            <input type="time" name="pickup_time_to"  class="form-control" value="" >
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="category" class="form-label">Allergies</label>
                                    {{-- <span class="text-danger">*</span> --}}
                                    <select id="allergy_ids[]" name="allergy_ids[]" class="form-control select2" multiple>
                                        <option value="" disabled>Select</option>
                                        @foreach ($allergies as $allergy)
                                            <option value="{{ $allergy->id }}">{{ $allergy->name }}</option>
                                        @endforeach
                                        @error('allergy_ids')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </select>
                                </div>
                                {{-- <div class="form-group">
                                    <label for="heading">Food Validity</label>
                                    <span class="text-danger">*</span>
                                    <input type="text" name="pickup_time"  class="form-control" value=""  placeholder="Example: 6:00pm - 7:00pm">
                                </div> --}}
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary waves-effect waves-float waves-light w-100 w-sm-auto">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@push('js')
<script>
    $(document).ready(function(){
        $('.location').on('select', function () { 
            var conceptName = this.find(":selected").val();
            console.log(conceptName)
         })
    })
    
</script>
<script>
    $(document).ready(function(){
        $('#food_type').change(function(){
            var value = $('#food_type').val();
            if(value == 2){
                $('#mystery_box').removeClass('hide')
                $('#mystery_box').show()
            }else{
                $('#mystery_box').hide()
                $('#mystery_box').addClass('hide')
            }
        })
    })
</script>
@endpush