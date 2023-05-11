@extends('layouts.dashboard')

{{-- Title --}}
@section('title')
    {{ config('app.name') }} | Blog Create
@endsection

{{-- Active Menu --}}
@section('blogCreate', 'active')

@push('theme-css')
    <link rel="stylesheet" href="{{ asset('dashboard_assets/assets/plugins/quill/css/quill.snow.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard_assets/app-assets/css/plugins/forms/form-quill-editor.css') }}">
@endpush

@push('vendor-js')
    <script src="{{ asset('dashboard_assets/assets/plugins/quill/js/quill.min.js') }}"></script>
    <script src="{{ asset('dashboard_assets/assets/plugins/quill/js/quill-image-resize.min.js') }}"></script>
@endpush

@section('content')
<section>
    <div class="row justify-content-center">
        <div class="col-xxl-9">
            @if (session('success'))
                <div class="alert alert-success">
                    <div class="alert-body">{{ session('success') }}</div>
                </div>
            @endif
            @if (session('warning'))
                <div class="alert alert-warning">
                    <div class="alert-body">{{ session('warning') }}</div>
                </div>
            @endif
            <form action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12 pb-1">
                        <div class="d-sm-flex justify-content-between button-group-spacing">
                            <a href="{{ route('blog.list.index') }}" class="btn btn-icon btn-outline-secondary">
                                <i data-feather='chevron-left'></i>
                            </a>
                            <button type="submit" class="btn btn btn-success w-100 w-sm-auto">Submit <i data-feather='send'></i></button>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                                    <input type="text" id="title" name="title" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="short_desc" class="form-label">Short Description <span class="text-danger">*</span></label>
                                    <textarea type="text" id="short_desc" name="short_desc" class="form-control" required></textarea>
                                </div>
                                <div class="form-group mb-0">
                                    <label class="form-label">Long Description</label>
                                    <div class="custom-editor-wrapper">
                                        <div class="custom-editor">{!! old('long_desc') !!}</div>
                                        <input type="hidden" name="long_desc" class="custom-editor-input">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-body__title">Upload Photo</h3>
                                <label class="custom__file">
                                    <input type="file" name="thumbnail_img" class="custom__file__input">
                                    <span class="custom__file__label">
                                        <span class="custom__file__label__btn">Add file</span>
                                        <span class="custom__file__label__text">Accepts jpg,jpeg and png</span>
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="written_by" class="form-label">Author</label>
                                    <select id="written_by" name="written_by" class="form-control select2">
                                        <option value="" selected disabled>Select</option>
                                        <option value="1">Admin</option>
                                        <option value="2">User</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="category" class="form-label">Category</label>
                                    <select id="category" name="category_id" class="form-control select2">
                                        <option value="" selected disabled>Select</option>
                                        <option value="1">Category 1</option>
                                        <option value="2">Category 2</option>
                                        <option value="3">Category 3</option>
                                    </select>
                                </div>
                                <div class="form-group mb-0">
                                    <label for="tag" class="form-label">Tag</label>
                                    <select id="tag" name="tag" class="form-control select2" multiple>
                                        <option value="1">Tag 1</option>
                                        <option value="2">Tag 2</option>
                                        <option value="3">Tag 3</option>
                                    </select>
                                </div>
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
