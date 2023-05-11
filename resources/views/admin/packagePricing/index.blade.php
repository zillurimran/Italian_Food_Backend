@extends('layouts.dashboard')
@section('title')
{{ config('app.name') }} | Packages
@endsection
@section('pricing')
    active
@endsection
@push('page-js')
    <script src="{{ asset('dashboard_assets/app-assets/js/scripts/pages/custom-datatable.js') }}"></script>
@endpush
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">All Pacakges</h3>                   
        <div class="d-flex align-items-center">
            <button class="btn btn-primary" data-toggle="modal" data-target="#addPackageModal">Add Package</button>                  
            @push('all-modals')
            <div class="modal fade" id="addPackageModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Specification</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('package.store') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="heading">Package Type</label>
                                    <span class="text-danger">*</span>
                                    <input type="text" name="package_type"  class="form-control" value="{{ old('package_type') }}"  placeholder="Enter package type">
                                </div>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="heading">Package Price</label>
                                    <span class="text-danger">*</span>
                                    <input type="text" name="package_price"  class="form-control" value="{{ old('package_price') }}"  placeholder="Enter package price">
                                </div>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="heading">SMS Quantity</label>
                                    <span class="text-danger">*</span>
                                    <input type="text" name="sms_quantity"  class="form-control" value="{{ old('sms_quantity') }}" placeholder="Enter sms quantity">
                                </div>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="heading">Package Purpose</label>
                                    <span class="text-danger">*</span>
                                    <input type="text" name="package_purpose"  class="form-control" value="{{ old('package_purpose') }}" placeholder="Enter package purpose">
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
                <input type="checkbox" {{ (hideshow()->pricing_status == 1)? 'checked' : ''}} class="custom-control-input pricing-switcher" id="customSwitch1">
                <label class="custom-control-label" for="customSwitch1" title="Show/Hide Packages"></label>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered datatable">
            <thead>
                <tr>
                    <th class="nowrap">Sl.</th>
                    <th class="nowrap">Pacakge Type</th>
                    <th class="nowrap">Pacakge Price</th>
                    <th class="nowrap">Pacakge Purpose</th>
                    <th class="nowrap">SMS Quantity</th>
                    <th class="nowrap">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($packages as $package)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $package->package_type }}</td> 
                        <td>{{ $package->package_price }}</td>
                        <td>{{ $package->package_purpose }}</td>
                        <td>{{ $package->sms_quantity }}</td> 
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn btn-icon btn-outline-secondary waves-effect dropdown-toggle hide-arrow" data-toggle="dropdown" data-boundary="viewport">
                                    <i data-feather="more-vertical"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <button type="button" class="dropdown-item"  data-toggle="modal" data-target="#editPackageModal-{{ $package->id }}">
                                        <i data-feather="edit" class="mr-50"></i>
                                        <span>Edit</span>
                                    </button>
                                     <a href="{{ route('package.delete', $package->id) }}" class="dropdown-item">
                                        <i data-feather="trash" class="mr-50"></i>
                                        <span>Delete</span>
                                    </a>
                                </div>
                            </div>
                        </td> 
                    </tr>

                    @push('all-modals')
                        <div class="modal fade" id="editPackageModal-{{ $package->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Groups</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('package.update', $package->id) }}" method="POST">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="heading">Package Type</label>
                                                <input type="text" name="package_type"  class="form-control" value="{{ $package->package_type ?? old('package_type') }}"  placeholder="Enter package type">
                                            </div>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="heading">Package Price</label>
                                                <input type="text" name="package_price"  class="form-control" value="{{ $package->package_price ?? old('package_price') }}"  placeholder="Enter package price">
                                            </div>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="heading">SMS Quantity</label>
                                                <input type="text" name="sms_quantity"  class="form-control" value="{{ $package->sms_quantity ?? old('sms_quantity') }}" placeholder="Enter sms quantity">
                                            </div>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="heading">Package Purpose</label>
                                                <input type="text" name="package_purpose"  class="form-control"  value="{{ $package->package_purpose ?? old('package_purpose') }}"   placeholder="Enter package purpose">
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

@endsection

@push('js')

 <script>
    $(document).ready(function(){
        $('body').on("click", '.pricing-switcher', function(){
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
                url : "{{ route('pricing.status') }}", 
                data : {
                    status : status
                }
            })

        })
    });
 </script>

@endpush