{{-- @extends('layouts.dashboard')
@section('title')
{{ config('app.name') }} | Address
@endsection
@section('detailAddress')
    active
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        Address Contact & Email
                    </div>
                </div>
                <div class="card-body d-flex text-center">
                    <div class="col-md-4 shadow-sm bg-body rounded">
                        <div class="card">
                            <div class="card-title">
                                <a href="" class="btn btn-primary w-100" data-toggle="modal" data-target="#editAddressModal-{{ $address->id }}">Update Address</a>
                                @push('all-modals')
                                        <div class="modal fade" id="editAddressModal-{{ $address->id }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Update Address</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{ route('address.update', $address->id) }}" method="POST">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="heading">Address</label>
                                                                <span class="text-danger">*</span>
                                                                <input type="text" name="address" class="form-control" value="{{ $address->address ?? old('address') }}">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Update</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endpush
                            </div>
                            <div class="card-body">
                                <p>
                                    {{ $address -> address }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 shadow-sm bg-body rounded">
                        <div class="card">
                            <div class="card-title">
                                <a href="" class="btn btn-primary w-100" data-toggle="modal" data-target="#addPhoneModal">Add Phone Number</a>
                                @push('all-modals')
                                    <div class="modal fade" id="addPhoneModal" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Add Phone Number</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{ route('phone.store') }}" method="POST">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="heading">Phone</label>
                                                            <span class="text-danger">*</span>
                                                            <input type="text" name="phone"  class="form-control" value="{{ old('phone') }}"  placeholder="Enter Phone">
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
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        @foreach ($phones  as $phone)
                                        <tr>
                                            <td>{{ $phone->phone }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn btn-icon btn-outline-secondary waves-effect dropdown-toggle hide-arrow" data-toggle="dropdown" data-boundary="viewport">
                                                        <i data-feather="more-vertical"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <button type="button" class="dropdown-item" data-toggle="modal" data-target="#editPhoneModal-{{ $phone->id }}">
                                                            <i data-feather="edit" class="mr-50"></i>
                                                            <span>Edit</span>
                                                        </button>
                                                         <a href="{{ route('phone.delete', $phone->id) }}" class="dropdown-item">
                                                            <i data-feather="trash" class="mr-50"></i>
                                                            <span>Delete</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @push('all-modals')
                                            <div class="modal fade" id="editPhoneModal-{{ $phone->id }}" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Update Phone</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="{{ route('phone.update', $phone->id) }}" method="POST">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label for="heading">Phone Number</label>
                                                                    <span class="text-danger">*</span>
                                                                    <input type="text" name="phone" class="form-control" value="{{ $phone->phone ?? old('phone') }}">
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
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 shadow-sm bg-body rounded">
                        <div class="card ">
                            <div class="card-title">
                                <a href="" class="btn btn-primary w-100" data-toggle="modal" data-target="#addEmailModal">Add Email Address</a>
                                @push('all-modals')
                                <div class="modal fade" id="addEmailModal" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Add Email Address</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('email.store') }}" method="POST">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="heading">Email Address</label>
                                                        <span class="text-danger">*</span>
                                                        <input type="email" name="email"  class="form-control" value="{{ old('email') }}" placeholder="Enter Email" required>
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
                            <div class="card-body">
                                <div class="table-responsive hideScrollbar">
                                    <table class="table table-bordered table-hover">
                                        @foreach ($emails  as $email)
                                        <tr>
                                            <td>{{ $email->email }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn btn-icon btn-outline-secondary waves-effect dropdown-toggle hide-arrow" data-toggle="dropdown" data-boundary="viewport">
                                                        <i data-feather="more-vertical"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <button type="button" class="dropdown-item" data-toggle="modal" data-target="#editEmailModal-{{ $email->id }}">
                                                            <i data-feather="edit" class="mr-50"></i>
                                                            <span>Edit</span>
                                                        </button>
                                                         <a href="{{ route('email.delete', $email->id) }}" class="dropdown-item">
                                                            <i data-feather="trash" class="mr-50"></i>
                                                            <span>Delete</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @push('all-modals')
                                            <div class="modal fade" id="editEmailModal-{{ $email->id }}" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Update Email</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="{{ route('email.update', $email->id) }}" method="POST">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label for="heading">Email Address</label>
                                                                    <span class="text-danger">*</span>
                                                                    <input type="email" name="email" class="form-control" value="{{ $email->email ?? old('email') }}" required>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Update</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @endpush
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
