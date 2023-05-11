@extends('layouts.dashboard')
@section('title')
{{ config('app.name') }} | Features
@endsection
@section('features')
    active
@endsection
@section('content')
@push('page-js')
    <script src="{{ asset('dashboard_assets/app-assets/js/scripts/pages/custom-datatable.js') }}"></script>
@endpush
<div class="container">
    <div class="row ">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Add Features</h3>
                    <div class="d-flex align-items-center">
                        <a class="btn btn-primary text-center" data-toggle="modal" data-target="#addFeatureSpecsModal">Add Feature Specs</a>
                        @push('all-modals')
                        <div class="modal fade" id="addFeatureSpecsModal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Add Specification</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('specs.store') }}" method="POST">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="heading">Specification</label>
                                                <input type="text" name="feature"  class="form-control"  placeholder="Enter heading">
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
                        <div class="custom-control custom-switch ml-1">
                            <input type="checkbox" {{ (hideshow()->banner_bottom_status == 1)? 'checked' : ''}} class="custom-control-input banner-bottom-switcher" id="customSwitch1" >
                            <label class="custom-control-label" for="customSwitch1" title="Show/Hide Features"></label>
                        </div>
                    </div>
                </div>
                <div class="card-body mt-2">
                    <form action="{{ route('feature.store') }}" method="post" enctype="multipart/form-data" class="row">
                        @csrf
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputEmail4" class="form-label">Title</label>
                                <span class="text-danger">*</span>
                                <input type="text" name="title"  value='{{ $feature->title ?? old('title') }}' class="form-control" id="inputEmail4" placeholder="Enter Title">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="sub_title" class="form-label">Sub Title</label>
                                <span class="text-danger">*</span>
                                <input type="text" name="sub_title" value='{{ $feature->sub_title ?? old('sub_title') }}' class="form-control" placeholder="Enter Sub-title">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="inputAddress" class="form-label">Description</label>
                                <span class="text-danger">*</span>
                          <textarea name="description" class="form-control" placeholder="Write Description here...">{{ $feature->description ?? old('description') }}</textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="image" class="form-label">Image</label>
                                <span class="text-danger">*</span>
                                <div class="custom-file">
                                    <input type="file" name="image" class="custom-file-input" id="image">
                                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <p>Existing Image:</p>
                                <img src="{{ asset('uploads/features') }}/{{ $feature->image }}" alt="" width="200">
                            </div>
                        </div>
                        <div class="col-12 mt-2">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">All Specifications</h3>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered datatable">
                <thead>
                    <tr>
                        <th class="nowrap">Sl.</th>
                        <th class="nowrap">Secifictions</th>
                        <th class="nowrap">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($featureSpecs as $specs)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $specs->feature }}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn btn-icon btn-outline-secondary waves-effect dropdown-toggle hide-arrow" data-toggle="dropdown" data-boundary="viewport">
                                        <i data-feather="more-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <button type="button" class="dropdown-item"  data-toggle="modal" data-target="#editSpecsModal-{{ $specs->id }}">
                                            <i data-feather="edit" class="mr-50"></i>
                                            <span>Edit</span>
                                        </button>
                                         <a href="{{ route('specs.delete', $specs->id) }}" class="dropdown-item">
                                            <i data-feather="trash" class="mr-50"></i>
                                            <span>Delete</span>
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        @push('all-modals')
                            <div class="modal fade" id="editSpecsModal-{{ $specs->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Groups</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('specs.update', $specs->id) }}" method="POST">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="heading">Specification</label>
                                                    <span class="text-danger">*</span>
                                                    <input type="text" name="feature" class="form-control" value="{{ $specs->feature ?? old('feature') }}">
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

@endsection
@push('js')

 <script>
    $(document).ready(function(){
        $('body').on("click", '.banner-bottom-switcher', function(){
            if($(this).is(':checked') == true)
            {
               var status = 1;
            }
            else
            {
                var status =  0;
            }

            console.log(status);



            $.ajax({
                method : 'post',
                url : "{{ route('banner.bottom.status') }}",
                data : {
                    status : status
                }
            })

        })
    });
 </script>

@endpush
