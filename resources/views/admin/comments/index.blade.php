@extends('layouts.dashboard')

@section('title')
    {{ config('app.name') }} | Comments
@endsection

@section('comments')
    active
@endsection

@push('page-js')
    <script src="{{ asset('dashboard_assets/app-assets/js/scripts/pages/custom-datatable.js') }}"></script>
@endpush

@section('content')
<div class="container">
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">All Comments</h3>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" {{ (hideshow()->contact_status == 1)? 'checked' : ''}} class="custom-control-input contact-switcher" id="customSwitch1" >
                        <label class="custom-control-label" for="customSwitch1" title="Show/Hide Contact Page"></label>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered datatable">
                        <thead>
                            <tr>
                                <th class="nowrap">Sl.</th>
                                <th class="nowrap">Name</th>
                                <th class="nowrap">Email</th>
                                <th class="nowrap">Phone Number</th>
                                <th class="nowrap">Company Name</th>
                                <th class="nowrap">Comment</th>
                                <th class="nowrap">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($comments as $comment)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $comment->name }}</td>
                                    <td>{{ $comment->email }}</td>
                                    <td>{{ $comment->phone_number }}</td>
                                    <td>{{ $comment->company_name }}</td>
                                    <td>{{ Str::limit($comment->comment, 50)}}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-icon btn-outline-secondary waves-effect dropdown-toggle hide-arrow" data-toggle="dropdown" data-boundary="viewport">
                                                <i data-feather="more-vertical"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <button type="button" class="dropdown-item"  data-toggle="modal" data-target="#viewCommentModal-{{ $comment->id }}">
                                                    <i data-feather='clipboard'></i>
                                                    <span>View Comment</span>
                                                </button>
                                                 <a href="{{ route('comment.delete', $comment->id) }}" class="dropdown-item">
                                                    <i data-feather="trash" class="mr-50"></i>
                                                    <span>Delete</span>
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @push('all-modals')
                                    <div class="modal fade" id="viewCommentModal-{{ $comment->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Comment</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <p> {{ $comment->comment }}</p>
                                                        </div>
                                                        <button class="btn btn-primary" data-dismiss="modal" aria-label="Close">Close</button>
                                                    </div>
                                                </div>
                                                <div class="">

                                                </div>
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
@endsection

@push('js')

 <script>
    $(document).ready(function(){
        $('body').on("click", '.contact-switcher', function(){
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
                url : "{{ route('contact.status') }}", 
                data : {
                    status : status
                }
            })

        })
    });
 </script>

@endpush
