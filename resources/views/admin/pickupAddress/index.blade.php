@extends('layouts.dashboard')
@section('title')
{{ config('app.name') }} | All Boutiques
@endsection
@section('pickupAddress')
    active
@endsection
@push('page-js')
    <script src="{{ asset('dashboard_assets/app-assets/js/scripts/pages/custom-datatable.js') }}"></script>
@endpush
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">All Boutiques</h3>    
        <div class="d-flex">
            <button class="btn btn-primary" data-toggle="modal" data-target="#addNewPickupAddressModal">Add new Boutique</button>
            <div class="dropdown mx-1">
                <button class="btn btn-primary dropdown-toggle bulk_boutique hide" type="button" data-toggle="dropdown" aria-expanded="false">
                  Bulk Action
                </button>
                <div class="dropdown-menu">
                  <button type="submit" form="bulk-delete-form" class="dropdown-item"  id="bulk_boutique_delete"><i data-feather='trash' class="mr-50"></i>Bulk Delete</button>
                </div>
              </div>               
            {{-- <button type="submit" form="bulk-delete-form" id="deleteSelected" class="btn btn-primary bulk_delete hide">Delete Selected</button> --}}
        </div>
        @push('all-modals')
        <div class="modal fade" id="addNewPickupAddressModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Boutique</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('pickup_address.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="heading">Boutique Name</label>
                                <input type="text" name="boutique_name"  class="form-control" value="{{ old('boutique_name') }}"  placeholder="Enter boutique name">
                                @error('boutique_name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="heading">Boutique Address</label>
                                <input type="text" name="address"  class="form-control" value="{{ old('address') }}"  placeholder="Enter boutique address">
                                @error('address')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-6">
                                        <label for="heading">Opened At<span class="text-danger"> *</span></label>
                                        <input type="time" name="opened_at"  class="form-control" value="{{ old('opened_at') }}" >
                                    </div>
                                    <div class="col-6">
                                        <label for="heading">Closed At<span class="text-danger"> *</span></label>
                                        <input type="time" name="closed_at"  class="form-control" value="{{ old('closed_at') }}" >
                                    </div>
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
    </div>
    <div class="card-body">
        <form action="{{ route('boutiques.delete') }}" method="post" id="bulk-delete-form">
            @csrf
            <div class="table-responsive text-center">
                <table class="table table-bordered datatable">
                    <thead>
                        <tr>
                            <th class="nowrap">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input all_checked" name="all_checked" id="allCheckedBotiques">
                                    <label class="custom-control-label" for="allCheckedBotiques"></label>
                                </div>
                                {{-- <input type="checkbox" name="all_checked" id="select_all"> --}}
                            </th>
                            <th class="nowrap">Action</th>
                            <th class="nowrap">Boutique Name</th>
                            <th class="nowrap">Address</th>
                            <th class="nowrap">Opened_at</th>
                            <th class="nowrap">Closed_at</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pickupAddresses as $address)
                            <tr>
                                <td>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input boutique_check"  name="ids[{{ $address->id }}]" value="{{ $address->id }}" id="{{ $address->id }}">
                                        <label class="custom-control-label" for="{{ $address->id }}"></label>
                                    </div>
                                    {{-- <input type="checkbox" class="checked_id" name="ids[{{ $address->id }}]" value="{{ $address->id }}"> --}}
                                </td>
                                
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-icon btn-outline-secondary waves-effect dropdown-toggle hide-arrow" data-toggle="dropdown" data-boundary="viewport">
                                            <i data-feather="more-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <button type="button" class="dropdown-item"   data-toggle="modal" data-target="#editPickupAddressModal-{{ $address->id }}">
                                                <i data-feather="edit" class="mr-50"></i>
                                                <span>Edit</span>
                                            </button>
                                            <a href="{{ route('pickup_address.delete', $address->id) }}" class="dropdown-item">
                                                <i data-feather="trash" class="mr-50"></i>
                                                <span>Delete</span>
                                            </a>
                                        </div>
                                    </div>
                                </td>
                                
                                <td>{{ $address->boutique_name }}</td> 
                                <td>{{ $address->address }}</td>
                                <td>{{ $address->opened_at }}</td>
                                <td>{{ $address->closed_at }}</td>
                                 
                            </tr>
                            @push('all-modals')
                                <div class="modal fade" id="editPickupAddressModal-{{ $address->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Boutique</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('pickup_address.update', $address->id) }}" method="POST">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="heading">Boutique Name</label>
                                                        <input type="text" name="boutique_name"  class="form-control" value="{{ $address->boutique_name ?? old('boutique_name') }}"  placeholder="Enter boutique name">
                                                        @error('boutique_name')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="heading">Boutique Address</label>
                                                        <input type="text" name="address"  class="form-control" value="{{ $address->address ?? old('address') }}"  placeholder="Enter boutique address">
                                                        @error('address')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <label for="heading">Opened At<span class="text-danger"> *</span></label>
                                                                <input type="time" name="opened_at"  class="form-control" value="{{ $address->opened_at }}" >
                                                            </div>
                                                            <div class="col-6">
                                                                <label for="heading">Closed At<span class="text-danger"> *</span></label>
                                                                <input type="time" name="closed_at"  class="form-control" value="{{ $address->opened_at }}" >
                                                            </div>
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
                        @endforeach
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</div>
@endsection
@push('js')
   {{-- <script>
     $(document).ready(function(){ 
            
        $('.all_checked').on('change', function(){        
            if(this.checked){
                $('.bulk_delete').removeClass('hide');
                $('.checked_id').each(function(){ 
                    this.checked = true;
                 })
            }else{
                $('.bulk_delete').addClass('hide');
                $('.checked_id').each(function(){ 
                    this.checked = false;
                 })
            }
          })
          
          $('.checked_id').on('click', function(){  
            if(this.checked){
            $('.bulk_delete').removeClass('hide')
           }else{
            $('.bulk_delete').addClass('hide')
           }      
    })    
});
   </script> --}}
   <script>
    $(document).ready(  function(){
        $('#allCheckedBotiques').on('click', function(){
        if(this.checked){
            $('.bulk_boutique').removeClass('hide')
            $('.boutique_check').each(function(){
                this.checked = true;
            })
        }else{
            $('.bulk_boutique').addClass('hide')
            $('.boutique_check').each(function(){
                this.checked = false;
            })
        }
    })

    $('.boutique_check').on('click', function(){

    if($('.boutique_check:checked').length == 0){
        $('.bulk_boutique').addClass('hide')
    }

    if($('.boutique_check:checked').length == $('.boutique_check').length){
        $('#allCheckedBotiques').prop('checked', true);
    }else{
        $('#allCheckedBotiques').prop('checked', false);
    } 
    })

    $('.boutique_check').on('click', function(){  
    if(this.checked){
    $('.bulk_boutique').removeClass('hide')
    }
    })
    })
</script>
@endpush

