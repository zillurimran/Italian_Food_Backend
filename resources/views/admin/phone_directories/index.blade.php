@extends('layouts.dashboard')

{{-- Title --}}
@section('title')
    {{ config('app.name') }} |  Groups
@endsection

{{-- Active Menu --}}
@section('numbers')
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
                        <h4 class="card-title">Numbers</h4>
                       <!-- Button trigger modal -->
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#staticBackdrop">
                                Add Numbers
                            </button>
                            
                            <!-- Modal -->
                            <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Add Numbers</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                       <div class="form-group">
                                           <form action="{{ route('phone-directories.store') }}" method="POST">
                                            @csrf 
                                            <div class="form-group">
                                               <label for="groups">Select Group</label>
                                                  <select class="form-control" name="group_id" id="groups" required>
                                                    <option value="">Select Group</option>
                                                    @foreach ($groups as $group)
                                                         <option value="{{ $group->id }}">{{ $group->name }}</option>
                                                    @endforeach
                                                  </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="numbers">Insert Number (For Multiple numbers please use space, For Example : 33123456789 33123456789 33123456789)</label>
                                                <textarea class="form-control" required type="text" name="numbers" id="numbers" placeholder="Example : 33123456789 33123456789 33123456789">{{ old('numbers') }}</textarea>
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
                                            <th>Numbers</th>
                                            <th>Group</th>
                                            <th>Action</th>
                                        </tr>
                                         @foreach ($phone_directories as $number)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $number->numbers }}</td>
                                                <td>
                                                    {{ \App\Models\Group::find($number->group_id)->name }}
                                                </td>
                                                <td>
                                                        <div class="dropdown">
                                                            <button type="button" class="btn btn-icon btn-outline-secondary waves-effect dropdown-toggle hide-arrow" data-toggle="dropdown" data-boundary="viewport">
                                                                <i data-feather="more-vertical"></i>
                                                            </button>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                               
                                                                    <button type="button" class="dropdown-item"  data-toggle="modal" data-target="#staticBackdrop{{ $number->id }}">
                                                                        <i data-feather="edit" class="mr-50"></i>
                                                                        <span>Edit</span>
                                                                    </button>

                                                                    <form action="{{ route('groups.destroy', $group->id) }}" method="POST">
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

                                         @foreach ($phone_directories as $number)
                                              <!-- Modal -->
                                        <div class="modal fade" id="staticBackdrop{{ $number->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Edit Numbers</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <form action="{{ route('phone-directories.update', $number->id) }}" method="POST">
                                                            {{ method_field('PUT') }}
                                                         @csrf 
                                                         <div class="form-group">
                                                            <label for="groups">Select Group</label>
                                                               <select class="form-control" name="group_id" id="groups" required>
                                                                    <option value="">Select Group</option>
                                                                    @foreach ($groups as $group)
                                                                        <option value="{{ $group->id }}" {{ $number->group_id == $group->id ? 'selected' : '' }}>{{ $group->name }}</option>
                                                                    @endforeach
                                                               </select>
                                                         </div>
                                                         <div class="form-group">
                                                             <label for="numbers">Insert Number (For Multiple numbers please use space, For Example : 33123456789 33123456789 33123456789)</label>
                                                             <textarea class="form-control" required type="text" name="numbers" id="numbers" placeholder="Example : 33123456789 33123456789 33123456789">{{ $number->numbers ?? old('numbers') }}</textarea>
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