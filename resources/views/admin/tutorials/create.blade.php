@extends('layouts.dashboard')

{{-- Title --}}
@section('title')
    {{ config('app.name') }} | Tutorial Step Create
@endsection

{{-- Active Menu --}}
@section('tutorialStepsCreate')
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
                Tutorial Steps
            </li>
        </ol>
    </div>
@endsection

{{-- Page Content --}}
@section('content')
<section >
    <div class="row justify-content-center">
        <div class="col-xxl-9">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('warning'))
                <div class="alert alert-warning">{{ session('warning') }}</div>
            @endif
            <form action="{{ route('tutorialSteps.store') }}" method="POST" class="form form-vertical" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12 pb-1">
                        <div class="d-sm-flex justify-content-between button-group-spacing">
                            <a href="#!" class="btn btn-icon btn-outline-secondary">
                                <i data-feather='chevron-left'></i>
                            </a>
                            <button type="submit" class="btn btn-success w-100 w-sm-auto">Submit <i data-feather='send'></i></button>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="address">Tutorial Title <span class="text-danger">*</span></label>
                                            <input type="text" name="tutorial_title" value="{{ old('tutorial_title') }}" id="" class="form-control" placeholder="Enter tutorial title"/>
                                            @error('tutorial_title')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="email">Tutorial Sub_title <span class="text-danger">*</span></label>
                                            <input type="text" name="tutorial_sub_title" value="{{ old('tutorial_sub_title') }}" id="" class="form-control" placeholder="Enter tutorial sub title"/>
                                            @error('tutorial_sub_title')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-body__title">Upload Image <span class="text-danger">*</span></h3>
                                <label class="custom__file">
                                    <input type="file" name="image" class="custom__file__input">
                                    <span class="custom__file__label">
                                        <span class="custom__file__label__btn">Add file</span>
                                        <span class="custom__file__label__text">Accepts jpg,jpeg and png</span>
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 border-top py-1">
                        <button type="submit" class="btn btn-success w-100 w-sm-auto">Submit <i data-feather='send'></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
