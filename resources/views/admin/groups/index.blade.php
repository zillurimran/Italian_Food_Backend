@extends('layouts.dashboard')

{{-- Title --}}
@section('title')
    {{ config('app.name') }} |  Groups
@endsection

{{-- Active Menu --}}
@section('groups')
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
              Groups
            </li>
        </ol>
    </div>
@endsection

{{-- Page Content --}}
@section('content')
    <section >
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Groups</h4>
                       <!-- Button trigger modal -->
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#staticBackdrop">
                                Add Group
                            </button>
                            
                            <!-- Modal -->
                            <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Add Groups</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                       <div class="form-group">
                                           <form action="{{ route('groups.store') }}" method="POST">
                                            @csrf 
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" name="name" id="name" class="form-control" placeholder="Enter Name">
                                            </div>
                                       </div>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                                    </div>
                                </div>
                                </div>
                            </div>
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if (session('warning'))
                            <div class="alert alert-warning">{{ session('warning') }}</div>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 ">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>Sl.</th>
                                            <th>Name</th>
                                            <th>Action</th>
                                        </tr>
                                        @foreach ($groups as $group)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $group->name }}</td>
                                                <td>
                                                        <div class="dropdown">
                                                            <button type="button" class="btn btn-icon btn-outline-secondary waves-effect dropdown-toggle hide-arrow" data-toggle="dropdown" data-boundary="viewport">
                                                                <i data-feather="more-vertical"></i>
                                                            </button>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                               
                                                                    <button type="button" class="dropdown-item"  data-toggle="modal" data-target="#staticBackdrop{{ $group->id }}">
                                                                        <i data-feather="edit" class="mr-50"></i>
                                                                        <span>Edit</span>
                                                                    </button>

                                                                    <form action="{{ route('groups.destroy', $group->id) }}" method="POST">
                                                                        {{-- Initiate Delete method --}}
                                                                        {{ method_field('DELETE') }}
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
                                        @endforeach

                                        @foreach ($groups as $group)
                                              <!-- Modal -->
                                        <div class="modal fade" id="staticBackdrop{{ $group->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Edit Groups</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <div class="modal-body">
                                                <div class="form-group">
                                                    <form action="{{ route('groups.update', $group->id) }}" method="POST">
                                                        {{ method_field('PUT') }}
                                                        @csrf 
                                                        <div class="form-group">
                                                            <label for="name">Name</label>
                                                            <input type="text" name="name" id="name" value="{{ $group->name }}" class="form-control" placeholder="Enter Name">
                                                        </div>
                                                </div>
                                                </div>
                                                <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </form>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection