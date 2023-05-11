@extends('layouts.dashboard')
@section('title')
{{ config('app.name') }} | Create Pickup Address
@endsection
@section('pickupAddressCreate')
    active
@endsection
@push('page-js')
    <script src="{{ asset('dashboard_assets/app-assets/js/scripts/pages/custom-datatable.js') }}"></script>
@endpush

@section('content')
<section >
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Add Pickup address</h4>
                    @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if (session('warning'))
                        <div class="alert alert-warning">{{ session('warning') }}</div>
                    @endif
                </div>
                <div class="card-body">
                    <form action="{{  route('pickup_address.store') }}" method="POST" class="form form-vertical" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                     <label for="heading">Boutique Name</label>
                                     <span class="text-danger">*</span>
                                    <input type="text" name="boutique_name"  class="form-control" value="{{ old('boutique_name') }}"  placeholder="Enter boutique name">
                                    @error('boutique_name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="heading">Boutique Address</label>
                                    <span class="text-danger">*</span>
                                    <input type="text" name="address"  class="form-control" value="{{ old('address') }}"  placeholder="Enter boutique address">
                                    @error('address')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group my-2">
                                    {{-- <label for="heading">Opening and Closing</label> --}}
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="heading">Opened At<span class="text-danger"> *</span></label>
                                            {{-- <p>Opened at<span class="text-danger"> *</span></p> --}}
                                            <input type="time" name="opened_at"  class="form-control" value="" >
                                        </div>
                                        <div class="col-6">
                                            <label for="heading">Closed At<span class="text-danger"> *</span></label>
                                            {{-- <p>Closed at<span class="text-danger"> *</span></p> --}}
                                            <input type="time" name="closed_at"  class="form-control" value="" >
                                        </div>
                                    </div>
                                </div>
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


