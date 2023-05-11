@extends('layouts.dashboard')

{{-- Title --}}
@section('title')
    {{ config('app.name') }} | Color Settings
@endsection

{{-- Active Menu --}}
@section('colorSettings')
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
                Color Settings
            </li>
        </ol>
    </div>
@endsection

{{-- Page Content --}}
@section('content')
    <section id="basic-vertical-layouts">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Color Settings</h4>
                        @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if (session('warning'))
                            <div class="alert alert-warning">{{ session('warning') }}</div>
                        @endif
                    </div>
                    <div class="card-body">
                        <form action="{{ route('colorSettings.update', $colorSettings->id) }}" method="POST" class="form form-vertical">
                            @csrf
                            {{ method_field('PUT') }}
                            <div class="row">

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="button_color">Button Text Color</label>
                                        <input type="color" name="button_color" value="{{ colorSettings()->button_color }}" id="button_color" class="form-control"/>
                                        @error('button_color')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="primary_color">Button background color</label>
                                        <input type="color" name="primary_color" value="{{ colorSettings()->primary_color }}" id="primary_color" class="form-control"/>
                                        @error('primary_color')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="hover_color">Hover Color</label>
                                        <input type="color" name="hover_color" value="{{ colorSettings()->hover_color }}" id="hover_color" class="form-control"/>
                                        @error('hover_color')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="secondary_color">Title Color</label>
                                        <input type="color" name="secondary_color" value="{{ colorSettings()->secondary_color }}" id="secondary_color" class="form-control"/>
                                        @error('secondary_color')
                                            <small class="text-danger">{{ $message }} </small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="text_color">Description text Color</label>
                                        <input type="color" name="text_color" value="{{ colorSettings()->text_color }}" id="text_color" class="form-control"/>
                                        @error('text_color')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="bg_color">Background Color</label>
                                        <input type="color" name="bg_color" value="{{ colorSettings()->bg_color }}" id="bg_color" class="form-control"/>
                                        @error('bg_color')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
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
