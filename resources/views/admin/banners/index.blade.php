@extends('layouts.dashboard')

{{-- Title --}}
@section('title')
    {{ config('app.name') }} | Banner Settings
@endsection

{{-- Active Menu --}}
@section('banners', 'active')

@push('page-js')
    <script src="{{ asset('dashboard_assets/app-assets/js/scripts/pages/custom-datatable.js') }}"></script>
@endpush



@section('content')
<section >
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
                <div class="card-header">
                    <h4 class="card-title">All Banners</h4>
                    <div class="d-flex align-items-center">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addBannerModal">Add Banner</button>
                    @push('all-modals')
                        <div class="modal fade" id="addBannerModal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Add Banner</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('banners.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label for="heading">Heading</label>
                                                    <input type="text" name="heading" id="heading" class="form-control" value="{{ old('heading') }}" placeholder="Enter heading">
                                                </div>
                                                <div class="form-group">
                                                    <label for="sub_heading">Sub Heading</label>
                                                    <input type="text" name="sub_heading" id="sub_heading" class="form-control" placeholder="Enter sub heading">
                                                </div>
                                                <div class="form-group">
                                                    <label for="tag_line">Tag line</label>
                                                    <input type="text" name="tag_line" id="tag_line" class="form-control" placeholder="Enter tag line">
                                                </div>
                                                <div class="form-group">
                                                    <label for="btn_text">Button Text</label>
                                                    <input type="text" name="btn_txt" id="btn_text" class="form-control" placeholder="Enter button text">
                                                </div>
                                                <div class="form-group">
                                                    <label for="btn_url">Button Url</label>
                                                    <input type="text" name="btn_url" id="btn_url" class="form-control" placeholder="Enter button url">
                                                </div>
                                                <div class="form-group">
                                                    <label for="media">Media</label>
                                                    <input type="file" name="media" id="media" class="form-control">
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
                    @endpush
                    <div class="custom-control custom-switch ml-1">
                        <input type="checkbox" {{ (hideshow()->banner_status == 1)? 'checked' : ''}} class="custom-control-input banner-switcher" id="customSwitch1">
                        <label class="custom-control-label" for="customSwitch1" title="Show/Hide Banner"></label>
                    </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered datatable">
                        <thead>
                            <tr>
                                <th class="nowrap">Sl.</th>
                                <th class="nowrap">Heading</th>
                                <th class="nowrap">Sub Heading</th>
                                <th class="nowrap">Tag Line</th>
                                <th class="nowrap">Button Text</th>
                                <th class="nowrap">Button Url</th>
                                <th class="nowrap">Media</th>
                                <th class="nowrap">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($banners as $banner)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $banner->heading }}</td>
                                    <td>{{ $banner->sub_heading }}</td>
                                    <td>{{ $banner->tag_line }}</td>
                                    <td>{{ $banner->btn_txt }}</td>
                                    <td>{{ $banner->btn_url }}</td>
                                    <td>
                                        <img src="{{ asset('uploads/banners') }}/{{ $banner->media }}" alt="img not found" width="200">
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-icon btn-outline-secondary waves-effect dropdown-toggle hide-arrow" data-toggle="dropdown" data-boundary="viewport">
                                                <i data-feather="more-vertical"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <button type="button" class="dropdown-item"  data-toggle="modal" data-target="#editBannerModal-{{ $banner->id }}">
                                                    <i data-feather="edit" class="mr-50"></i>
                                                    <span>Edit</span>
                                                </button>
                                                <a href="{{ route('banners.delete', $banner->id) }}" class="dropdown-item">
                                                    <i data-feather="trash" class="mr-50"></i>
                                                    <span>Delete</span>
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @push('all-modals')
                                    <div class="modal fade" id="editBannerModal-{{ $banner->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Groups</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{ route('banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="heading">Heading</label>
                                                            <input type="text" name="heading" id="heading" class="form-control" value="{{ $banner->heading ?? old('heading') }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="sub_heading">Sub Heading</label>
                                                            <input type="text" name="sub_heading" id="sub_heading" class="form-control" value="{{ $banner->sub_heading ?? old('sub_heading') }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="tag_line">Tag line</label>
                                                            <input type="text" name="tag_line" id="tag_line" class="form-control" value="{{ $banner->tag_line ?? old('tag_line') }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="btn_text">Button Text</label>
                                                            <input type="text" name="btn_txt" id="btn_text" class="form-control" value="{{ $banner->btn_txt ?? old('btn_txt') }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="btn_url">Button Url</label>
                                                            <input type="text" name="btn_url" id="btn_url" class="form-control" value="{{ $banner->btn_url ?? old('btn_url') }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="media">Media</label>
                                                            <input type="file" name="media" id="media" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <p>Existing Image:</p>
                                                            <img src="{{ asset('uploads/banners') }}/{{ $banner->media }}" alt="img not found" width="200">
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
</section>
@endsection

@push('js')

 <script>
    $(document).ready(function(){
        $('body').on("click", '.banner-switcher', function(){
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
                url : "{{ route('banner.status') }}", 
                data : {
                    status : status
                }
            })

        })
    });
 </script>

@endpush