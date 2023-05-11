@extends('layouts.dashboard')

{{-- Title --}}
@section('title')
    {{ config('app.name') }} | Social Urls
@endsection

{{-- Active Menu --}}
@section('socialurls')
    active
@endsection

@push('vendor-css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
@endpush


{{-- Breadcrumb --}}
@section('breadcrumb')
    <h2 class="content-header-title float-left mb-0">Admin Dashboard</h2>
    <div class="breadcrumb-wrapper">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
            <li class="breadcrumb-item active">
                Social Urls
            </li>
        </ol>
    </div>
@endsection

{{-- Page Content --}}
@section('content')
    <section>
        <div class="row">
            <div class="col-12">
                @if (session('success'))
                <div class="alert alert-success">
                    <div class="card-body">{{ session('success') }}</div>
                </div>
                @endif
                @if (session('warning'))
                <div class="alert alert-warning">
                    <div class="card-body">{{ session('warning') }}</div>
                </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Social Urls</h4>
                        <button type="button" class="btn btn-success" data-target="#addSocialLinks" data-toggle="modal">Add new</button>
                        @push('all-modals')
                        <div class="modal fade" id="addSocialLinks" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Add Social Links</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('socialurls.store') }}" method="POST" class="form form-vertical">
                                            @csrf
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="icon">Icon * <span class="text-info">From <a href="https://icons.getbootstrap.com/" target="_blank">Bootstrap icon ↗</a></span></label>
                                                        <textarea class="form-control" required name="icon" id="icon" placeholder="Example : <i class='bi bi-facebook'></i>"></textarea>
                                                        @error('icon')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="link">Link *</label>
                                                        <input class="form-control" required name="link" id="link" placeholder="Example: https://google.com">
                                                        @error('link')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <button type="submit" class="btn btn-success">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endpush
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Action</th>
                                    <th>Icon</th>
                                    <th>Link</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ( $socialurls as $item )
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-icon btn-outline-secondary waves-effect dropdown-toggle hide-arrow" data-toggle="dropdown" data-boundary="viewport" aria-expanded="false">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <button type="button" class="dropdown-item" data-target="#editSocialLinks{{ $item->id }}" data-toggle="modal">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit mr-50"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                                        <span>Edit</span>
                                                    </button>
                                                    <form action="{{ route('socialurls.destroy', $item->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash mr-50"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                                            Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-primary" style="font-size: 20px">{!! $item->icon !!}</td>
                                        <td>
                                            <a href="{{ $item->link }}" target="_blank">
                                                {{ $item->link }}
                                            </a>
                                        </td>
                                    </tr>
                                    @push('all-modals')
                                    <div class="modal fade" id="editSocialLinks{{ $item->id }}" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Social Links</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('socialurls.update', $item->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <label for="edit-icon">Icon * <span class="text-info">From <a href="https://icons.getbootstrap.com/" target="_blank">Bootstrap icon ↗</a></span></label>
                                                                    <textarea class="form-control" required name="icon" id="edit-icon" placeholder="Example: <i class='bi bi-facebook'></i>">{{ old('icon') ?? $item->icon }}</textarea>
                                                                    @error('icon')
                                                                        <small class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <label for="edit-link">Link *</label>
                                                                    <input class="form-control" required name="link" id="edit-link" value="{{ old('link') ?? $item->link }}">
                                                                    @error('link')
                                                                        <small class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <button type="submit" class="btn btn-primary waves-effect waves-float waves-light w-100 w-sm-auto">Update</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endpush
                                @empty
                                    <div class="alert alert-danger">
                                        <div class="card-body">No Links Added</div>
                                    </div>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

