@extends('layouts.dashboard')

{{-- Title --}}
@section('title')
    {{ config('app.name') }} | Ratings
@endsection

{{-- Active Menu --}}
@section('tutorials')
    active
@endsection

@push('page-js')
    <script src="{{ asset('dashboard_assets/app-assets/js/scripts/pages/custom-datatable.js') }}"></script>
    <script src="{{ asset('dashboard_assets/app-assets/vendors/js/charts/apexcharts.min.js') }}"></script>
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
                Ratings
            </li>
        </ol>
    </div>
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">All Google Ratings</h3>    
        {{-- <div>
            <button class="btn btn-primary" data-toggle="modal" data-target="#addNewTutorialModal">Add New Tutorial Step</button>               
             <button type="submit" form="bulk-delete-form" id="deleteSelected" class="btn btn-primary bulk_delete hide">Delete Selected</button>
         </div>  --}}
        {{-- @push('all-modals')
        <div class="modal fade" id="addNewTutorialModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Tutorial Step</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('tutorialSteps.store') }}" method="POST" class="form form-vertical" enctype="multipart/form-data">
                        @csrf
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="address">Tutorial Title</label>
                                    <input type="text" name="tutorial_title" value="{{old('tutorial_title') ?? '' }}" id="" class="form-control" placeholder="Enter tutorial title"/>
                                    @error('tutorial_title')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>   
                            <div class="modal-body">  
                                <div class="form-group">
                                    <label for="email">Tutorial Sub_title</label>
                                    <input type="text" name="tutorial_sub_title" value="{{ old('tutorial_sub_title') ?? '' }}" id="" class="form-control" placeholder="Enter tutorial sub title"/>
                                    @error('tutorial_sub_title')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="image" class="form-label">Image</label>
                                    <span class="text-danger">*</span>
                                    <div class="custom-file">
                                        <input type="file" name="image" class="custom-file-input" id="image">
                                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>                
                    </form>
                </div>
            </div>
        </div>
         @endpush --}}
    </div>
    <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered datatable">
                    <thead>
                        <tr>
                            <th class="nowrap">
                                <input type="checkbox">
                            </th>
                            <th class="nowrap">Action</th>
                            <th class="nowrap">Sl.</th>
                            <th class="nowrap">UID</th>
                            <th class="nowrap">Name</th>
                            <th class="nowrap">Description</th>
                            <th class="nowrap">Image</th>
                            <th class="nowrap">Rating</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ratings as $rating)
                            <tr>
                                <td>
                                    <input type="checkbox" class="" name="" value="">
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-icon btn-outline-secondary waves-effect dropdown-toggle hide-arrow" data-toggle="dropdown" data-boundary="viewport">
                                            <i data-feather="more-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <button type="button" class="dropdown-item"   data-toggle="modal" data-target="#editTutorialModal">
                                                <i data-feather="edit" class="mr-50"></i>
                                                <span>Edit</span>
                                            </button>
                                            <a href="{{ route('rating.delete', $rating->id) }}" class="dropdown-item">
                                                <i data-feather="trash" class="mr-50"></i>
                                                <span>Delete</span>
                                            </a>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $rating->uid }}</td> 
                                <td>{{ $rating->name }}</td>
                                <td>{{ $rating->description }}</td>
                                <td>
                                    <img src="{{ asset('uploads/ratings') }}/{{ $rating->image }}" alt="" height="100px" width="100px" style="border-radius: 50%">
                                </td>
                                <td>{{ $rating->ratings }}</td>
                            </tr>
                            {{-- @push('all-modals')
                                <div class="modal fade" id="editTutorialModal-{{ $tutorialStep->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Tutorial</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('tutorialSteps.update', $tutorialStep->id) }}" method="POST">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="heading">Tutorial Title</label>
                                                        <input type="text" name="tutorial_title"  class="form-control" value="{{ $tutorialStep->tutorial_title ?? old('tutorial_title') }}"  placeholder="Enter tutorial title">
                                                        @error('tutorial_title')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="heading">Tutorial Sub_title</label>
                                                        <input type="text" name="tutorial_sub_title"  class="form-control" value="{{ $tutorialStep->tutorial_sub_title ?? old('tutorial_sub_title') }}"  placeholder="Enter tutorial sub title">
                                                        @error('tutorial_sub_title')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="image" class="form-label">Image</label>
                                                        <span class="text-danger">*</span>
                                                        <div class="custom-file">
                                                            <input type="file" name="image" class="custom-file-input" id="image">
                                                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                                        </div>
                                                    </div>
                                                    <div class="modal-body">                                                     
                                                        <div class="form-group">                              
                                                            <p>Existing Image:</p>
                                                            <img src="{{asset('uploads/tutorials') }}/{{ $tutorialStep->image }}" alt="" width="100px">
                                                        </div>
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
                            @endpush --}}
                        @endforeach
                    </tbody>
                </table>
            </div>
    </div>
</div>
@endsection