@extends('layouts.dashboard')
@section('title')
{{ config('app.name') }} | Allergies
@endsection
@section('allergies')
    active
@endsection

@push('page-js')
    <script src="{{ asset('dashboard_assets/app-assets/js/scripts/pages/custom-datatable.js') }}"></script>
@endpush

@section('content')
<section>
    <div class="alert alert-success hide" id="allergyDiv" role="alert">
        <div id="notifyMsg" class="alert-body"></div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex">
                        <h3 class="card-title">All Allergies</h3>
                        <div class="dropdown mx-1">
                            <a href="" class="btn btn-primary" data-toggle="modal" data-target="#addAllergyModal">Add Allergy</a>
                            <button class="btn btn-primary dropdown-toggle bulk_allergy hide" type="button" data-toggle="dropdown" aria-expanded="false">
                              Bulk Action
                            </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" href="#" id="AllergiesDelete"><i data-feather='database'></i> Bulk Delete</a>
                            </div>
                        </div>
                        
                        {{-- Modal --}}
                                    <div class="modal fade" id="addAllergyModal" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Add Allergy</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('add.allergy') }}" method="POST" class="form form-vertical" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <label for="heading">Name</label>
                                                                    <span class="text-danger">*</span>
                                                                    <input type="text" name="name"  class="form-control" value="{{ old('name') }}"  placeholder="Enter name">
                                                                    @error('name')
                                                                        <small class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <button type="submit" class="btn btn-primary waves-effect waves-float waves-light w-100 w-sm-auto">Submit</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                {{-- end Modal --}}
                </div>
                <div class="card-body">
                    <div class="table-responsive text-center">
                        <table class="table table-bordered datatable ">
                            <thead>
                                <tr>
                                    <th class="nowrap">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="allAllergies">
                                            <label class="custom-control-label" for="allAllergies"></label>
                                        </div>
                                    </th>
                                    <th class="nowrap">Action</th>
                                    <th class="nowrap">Allergy</th>   
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($allergies as $allergy)
                                    <tr id="tr{{  $allergy->id }}">
                                        <td>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input checked_allergy"  name="ids[{{ $allergy->id }}]" data-id="{{ $allergy->id }}" value="{{ $allergy->id }}" id="{{ $allergy->id }}">
                                                <label class="custom-control-label" for="{{ $allergy->id }}"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-icon btn-outline-secondary waves-effect dropdown-toggle hide-arrow" data-toggle="dropdown" data-boundary="viewport">
                                                    <i data-feather="more-vertical"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <button type="button" class="dropdown-item"   data-toggle="modal" data-target="#editAllergyModal-{{ $allergy->id }}">
                                                        <i data-feather="edit" class="mr-50"></i>
                                                        <span>Edit</span>
                                                    </button>
                                                    {{-- <a href="{{ route('pickup_address.delete', $address->id) }}" class="dropdown-item">
                                                        <i data-feather="trash" class="mr-50"></i>
                                                        <span>Delete</span>
                                                    </a> --}}
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $allergy->name }}</td> 
                                    </tr>
                                @push('all-modals')
                                <div class="modal fade" id="editAllergyModal-{{ $allergy->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Allergy</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('update.allergy', $allergy->id) }}" method="POST" class="form form-vertical" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-12">
                                                            
                                                            <div class="form-group">
                                                                <label for="heading">Name</label>
                                                                <span class="text-danger">*</span>
                                                                <input type="text" name="name"  class="form-control" value="{{ $allergy->name }}"  placeholder="Enter name">
                                                                @error('name')
                                                                    <small class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <button type="submit" class="btn btn-primary waves-effect waves-float waves-light w-100 w-sm-auto">Submit</button>
                                                        </div>
                                                    </div>
                                                </form>
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
</section>
@endsection
@push('js')

<script>
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
    $(document).ready(function(){
   
        $('#allAllergies').on('click', function(){
            if(this.checked){
                $('.bulk_allergy').removeClass('hide')
                $('.checked_allergy').each(function(){
                    this.checked = true;
                })
            }else{
                $('.bulk_allergy').addClass('hide')
                $('.checked_allergy').each(function(){
                    this.checked = false;
                })
            }
        })

        $('.checked_allergy').on('click', function(){

            if($('.checked_allergy:checked').length == 0){
                $('.bulk_allergy').addClass('hide')
            }

            if($('.checked_allergy:checked').length == $('.checked_allergy').length){
                $('#allAllergies').prop('checked', true);
            }else{
                $('#allAllergies').prop('checked', false);
            } 
        })

        $('.checked_allergy').on('click', function(){  
            if(this.checked){
            $('.bulk_allergy').removeClass('hide')
           }
    })  

    $('#AllergiesDelete').on('click', function(e){
        e.preventDefault();
        var ids =[];
        $('.checked_allergy:checked').each(function(){
            ids.push($(this).attr('data-id'));

        });
        var ids = ids.join(',')
        
        $.ajax({
            url:"{{ route('checkedAllergies.delete') }}",
            method:'get',
            data:{
                ids:ids
            },success:function(res){
                if(res.status == 'success'){
                    location.href = "{{ route('allergies.index') }}"
                    // $('#allAllergies').prop('checked', false)
                    // $('.checked_allergy:checked').each(function(){
                    //     $(this).parents('tr').remove();
                    //   })
                      $('#allergyDiv').removeClass('hide')
                      $('#allergyDiv').fadeIn();
                      $('#notifyMsg').text(res.message);
                      setTimeout(() => {
                        $('#allergyDiv').fadeOut();
                      }, 3000);
                      
                 }
                 else{
                    $('#allAllergies').prop('checked', false)
                    $('#allergyDiv').removeClass('hide')
                      $('#allergyDiv').fadeIn();
                      $('#notifyMsg').text(res.message);
                      setTimeout(() => {
                        $('#allergyDiv').fadeOut();
                      }, 3000);
                }
            }
        })
    })
})
</script>
@endpush