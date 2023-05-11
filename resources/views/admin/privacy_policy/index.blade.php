@extends('layouts.dashboard')
@section('title')
{{ config('app.name') }} | Privacy
@endsection
@section('privacy.policy')
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
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Privacy Policy</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('privacy.update')}}" method="post">
                    @csrf
                    <div class="form-group mt-2">
                        <label class="form-label">Your Policies</label>
                        <div class="custom-editor-wrapper">
                            <div class="custom-editor">{!! $policy->privacy_policy ?? old('privacy_policy') !!}</div>
                                <input type="hidden" name="privacy_policy" class="custom-editor-input" value="{{ $policy->privacy_policy ?? old('privacy_policy')}}">
                            @error('food_description')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                   
                        <button type="submit" class="btn btn-primary waves-effect waves-float waves-light w-100 w-sm-auto">Update Policy</button>
                   
                </form>
            </div>
        </div>
    </div>
</div>
@endsection