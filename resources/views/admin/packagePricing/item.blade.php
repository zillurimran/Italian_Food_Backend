@extends('layouts.dashboard')
@section('title')
{{ config('app.name') }} | Packages
@endsection
@section('item')
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
                    <div class="card-title">
                        Package Items
                    </div>
                    <div class="card-title justify-content-end">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#addPackageItemModal">Add Items</button>
                        @push('all-modals')
                        <div class="modal fade" id="addPackageItemModal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Add Items</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('item.store') }}" method="POST">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="heading">Package Item</label>
                                                <span class="text-danger">*</span>
                                                <input type="text" name="package_items"  class="form-control" value="{{ old('package_items') }}"  placeholder="Enter package type">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endpush
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered datatable">
                            <thead>
                                <tr>
                                    <th class="nowrap">Sl.</th>
                                    <th class="nowrap">Pacakge Item</th>
                                    <th class="nowrap">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($packageItems as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->package_items }}</td> 
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-icon btn-outline-secondary waves-effect dropdown-toggle hide-arrow" data-toggle="dropdown" data-boundary="viewport">
                                                    <i data-feather="more-vertical"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <button type="button" class="dropdown-item"  data-toggle="modal" data-target="#editPackageItemModal-{{ $item->id }}">
                                                        <i data-feather="edit" class="mr-50"></i>
                                                        <span>Edit</span>
                                                    </button>
                                                     <a href="{{ route('item.delete', $item->id) }}" class="dropdown-item">
                                                        <i data-feather="trash" class="mr-50"></i>
                                                        <span>Delete</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </td> 
                                    </tr>

                                    @push('all-modals')
                                        <div class="modal fade" id="editPackageItemModal-{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Groups</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{ route('item.update', $item->id) }}" method="POST">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="heading">Package Item</label>
                                                                <input type="text" name="package_items"  class="form-control" value="{{ $item->package_items ?? old('package_items') }}"  placeholder="Enter package type">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Submit</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endpush
                            
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection