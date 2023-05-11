@extends('layouts.dashboard')

{{-- Title --}}
@section('title')
    {{ config('app.name') }} | Nexmo Settings
@endsection

{{-- Active Menu --}}
@section('nexmo')
    active
@endsection


{{-- Breadcrumb --}}
@section('breadcrumb')
     <h2 class="content-header-title float-left mb-0">Admin Dashboard</h2>
    <div class="breadcrumb-wrapper">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="breadcrumb-item active">
                Nexmo Settings
            </li>
        </ol>
    </div>
@endsection

{{-- Page Content --}}
@section('content')
    <section >
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Nexmo Settings</h4>
                        @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if (session('warning'))
                            <div class="alert alert-warning">{{ session('warning') }}</div>
                        @endif
                    </div>
                    <div class="card-body">
                        <form action="{{ route('nexmo.update', nexmosetting()->id) }}" method="POST" class="form form-vertical" enctype="multipart/form-data">
                            {{ method_field('PUT') }}
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                     <div class="form-group">
                                        <label for="nexmo_api_key">Nexmo API Key</label>
                                        <input type="text" name="api_key" id="api_key" class="form-control" value="{{ nexmosetting()->api_key }}">
                                     </div>
                                     <div class="form-group">
                                        <label for="nexmo_api_key">Nexmo API Secret</label>
                                        <input type="text" name="api_secret" id="api_secret" class="form-control" value="{{ nexmosetting()->api_secret }}">
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