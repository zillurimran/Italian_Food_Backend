@extends('layouts.dashboard')

{{-- Title --}}
@section('title')
    {{ config('app.name') }} | Blogs Item
@endsection

{{-- Active Menu --}}
@section('blogList', 'active')

@push('page-js')
    <script src="{{ asset('dashboard_assets/app-assets/js/scripts/pages/custom-datatable.js') }}"></script>
@endpush

@section('content')
<section>
    <div class="row">
        <div class="col-12">
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
            <div class="card">
                <div class="card-header border-bottom">
                    <h4 class="card-title">Blogs List</h4>
                    <a href="{{ route('blog.create') }}" class="btn btn-success">Add Blog</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered datatable">
                        <thead>
                            <tr>
                                <th>Sl.</th>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Description</th>
                                <th>author</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>
                                    <img src="https://sticko.fr/uploads/ecommerce/blogs/3550.jpg" alt="blog image" draggable="false" loading="lazy" width="100">
                                </td>
                                <td>
                                    Title
                                </td>
                                <td>
                                    <span class="badge badge-primary">Category</span>
                                </td>
                                <td>
                                    <p>Description</p>
                                </td>
                                <td>
                                    <span class="badge badge-success">author</span>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-icon btn-outline-secondary waves-effect dropdown-toggle hide-arrow" data-toggle="dropdown" data-boundary="viewport">
                                            <i data-feather="more-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a href="#!" type="button" class="dropdown-item">
                                                <i data-feather="edit" class="mr-50"></i>
                                                <span>Edit</span>
                                            </a>
                                            {{-- <form action="{{ route('blog_tags.delete', $tag->id) }}" method="POST"> --}}
                                            <form action="" method="POST">
                                                @csrf
                                                <button type="submit" class="dropdown-item">
                                                    <i data-feather="trash" class="mr-50"></i>
                                                    <span>Delete</span>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
