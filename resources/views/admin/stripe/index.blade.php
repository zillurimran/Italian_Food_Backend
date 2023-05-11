@extends('layouts.dashboard')
@section('title')
{{ config('app.name') }} | Stripe Setting
@endsection
@section('stripeSettings')
    active
@endsection
@section('content')
@push('page-js')
    <script src="{{ asset('dashboard_assets/app-assets/js/scripts/pages/custom-datatable.js') }}"></script>
@endpush
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Stripe Keys</h3>
                </div>
                <form action="{{ route('key.update',$key->id) }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="heading">Stripe Key</label>
                            <span class="text-danger">*</span>
                            <input type="text" name="stripe_key" class="form-control" value="{{ $key->stripe_key ?? old('stripe_key') }}">
                        </div>
                        <div class="form-group">
                            <label for="heading">Secret Key</label>
                            <span class="text-danger">*</span>
                            <input type="text" name="secret_key" class="form-control" value="{{ $key->secret_key ?? old('secret_key') }}">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success w-100 w-sm-auto">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
