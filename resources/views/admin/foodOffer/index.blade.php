@extends('layouts.dashboard')

@section('title')
{{ config('app.name') }} | Food Offers
@endsection

@section('foodOffers')
    active
@endsection

@push('page-js')
    <script src="{{ asset('dashboard_assets/app-assets/js/scripts/pages/custom-datatable.js') }}"></script>
@endpush
@push('theme-css')
    <link rel="stylesheet" href="{{ asset('dashboard_assets/assets/plugins/quill/css/quill.snow.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard_assets/app-assets/css/plugins/forms/form-quill-editor.css') }}">
@endpush

@push('vendor-js')
    <script src="{{ asset('dashboard_assets/assets/plugins/quill/js/quill.min.js') }}"></script>
    <script src="{{ asset('dashboard_assets/assets/plugins/quill/js/quill-image-resize.min.js') }}"></script>
@endpush

@section('content')
<section>

    <div class="alert alert-success hide" id="notifyDiv" role="alert">
        <div id="bulkMsg" class="alert-body"></div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title d-flex">
                        <a href="{{ route('foodOffers.index') }}" class="btn btn-primary">All</a>
                        <a href="{{ route('flatfoods.all') }}" class="btn btn-primary mx-1">Flat Foods</a>
                        <a href="{{ route('mystery.all') }}" class="btn btn-primary">Mystery Foods</a>
                </div>
                <div class="d-flex">
                    <a href="{{ route('foodOffers.create') }}" class="btn btn-primary">Add new food</a> 
                    <div class="dropdown mx-1">
                        <button class="btn btn-primary dropdown-toggle bulk_btn hide" type="button" data-toggle="dropdown" aria-expanded="false">
                          Bulk Action
                        </button>
                        <div class="dropdown-menu">
                          <a class="dropdown-item" href="#" id="allFoodDelete"><i data-feather='database'></i> Bulk Delete</a>
                        </div>
                      </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered datatable">
                        <thead>
                            <tr>
                                <th class="nowrap">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="bulk_action">
                                        <label class="custom-control-label" for="bulk_action"></label>
                                    </div>
                                </th>
                                <th class="nowrap">Action</th>
                                <th class="nowrap">Food Type</th>
                                <th class="nowrap">Food Name</th>
                                <th class="nowrap">Food Description</th>
                                <th class="nowrap">Food Image</th>
                                <th class="nowrap">Stock</th>
                                <th class="nowrap">Price</th>
                                <th class="nowrap">Boutique Location</th>
                                <th class="nowrap">Pickup Date/Time</th>
                                {{-- <th class="nowrap">Allergies</th> --}}
                                <th class="nowrap">Hide/Show</th>   
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($foodOffers as $foodOffer)
                                <tr id="tr{{ $foodOffer->id }}">    
                                    <td class="nowrap">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input food_check" name="ids[{{ $foodOffer->id }}]" data-id="{{ $foodOffer->id }}" value="{{ $foodOffer->id }}" id="bulkCheck{{ $foodOffer->id }}">
                                            <label class="custom-control-label" for="bulkCheck{{ $foodOffer->id }}"></label>
                                        </div>
                                    </td>
                                    <td class="nowrap">
                                        <div class="dropdown">
                                                <button type="button" class="btn btn-icon btn-outline-secondary waves-effect dropdown-toggle hide-arrow" data-toggle="dropdown" data-boundary="viewport">
                                                    <i data-feather="more-vertical"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <button type="button" class="dropdown-item"  data-toggle="modal" data-target="#editFoodModal{{$foodOffer->id}}">
                                                        <i data-feather="edit" class="mr-50"></i>
                                                        <span>Edit</span>
                                                    </button>
                                                    <a href="{{ route('foodOffers.delete', $foodOffer->id) }}" class="dropdown-item">
                                                        <i data-feather="trash" class="mr-50"></i>
                                                        <span>Delete</span>
                                                    </a>
                                                    <a href="" class="dropdown-item" data-toggle="modal" data-target="#seeFoodModal{{$foodOffer->id}}">
                                                        <i data-feather='credit-card' class="mr-50"></i> 
                                                        <span>See Details</span>
                                                    </a>
                                                </div>
                                            </div>
                                    </td>
                                    <td class="nowrap">{{ $foodOffer->food_type }}</td>
                                    <td class="nowrap">{{ ucfirst($foodOffer->food_name) }}</td>
                                    <td class="nowrap">{!! Str::limit($foodOffer->food_description, $limit = 100) !!}</td>
                                    <td class="nowrap">
                                        <img src="{{ $foodOffer->food_image }}" alt="" height="100" width="100" >
                                    </td>
                                    <td class="nowrap">{{ $foodOffer->food_stock }}</td>
                                    <td class="nowrap">{{ $foodOffer->price }}</td>
                                    <td class="nowrap">{{ $foodOffer->boutique_name}}</td>
                                    <td class="nowrap">
                                        <div>
                                            <p>Date:&nbsp;{{ $foodOffer->pickup_date_from.' to '.$foodOffer->pickup_date_to }}</p>
                                            <p>Time:&nbsp;{{date("g:i:s A",strtotime($foodOffer->pickup_time_from)).' - '.date("g:i:s A",strtotime($foodOffer->pickup_time_to))}}</p>
                                            
                                        </div>
                                    </td>
                                    {{-- <td class="nowrap">{{ $foodOffer->pickup_date_from.' : '.$foodOffer->pickup_date_to }}</td>
                                    <td class="nowrap">{{ $foodOffer->pickup_time_from.' - '.$foodOffer->pickup_time_to }}</td> --}}
                                    <td class="nowrap">
                                        @if($foodOffer->hide_show == 1)
                                        <a href="{{ route('foodOffers.hideShow', $foodOffer->id) }}" class="btn btn-success">Hide</a>
                                        @else
                                        <a href="{{ route('foodOffers.hideShow', $foodOffer->id) }}" class="btn btn-success">Show</a>
                                        @endif
                                    </td>
                                 
                            </tr>

                            @push('all-modals')
                                <div class="modal fade" id="editFoodModal{{$foodOffer->id}}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Food Offer</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('foodOffers.update', $foodOffer->id) }}" method="POST" class="form form-vertical" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="category" class="form-label">Food Type</label>
                                                                <span class="text-danger">*</span>
                                                                <select id="food_type_modal" name="food_type" class="form-control">
                                                                    <option value="" disabled>Select</option>
                                                                    @foreach ($foodTypes as $foodType)
                                                                        <option value="{{ $foodType->id }}" {{ $foodOffer->food_type_id == $foodType->id ? 'selected' : '' }}>{{ $foodType->food_type }}</option>
                                                                    @endforeach
                                                                    @error('food_type')
                                                                        <small class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </select>
                                                            </div>
                                                            <div class="form-group hide" id="mystery_box_modal">
                                                                <label for="category" class="form-label">Mystery Type</label>
                                                                <span class="text-danger">*</span>
                                                                <select id="mystery_modal" name="mystery_type_id" class="form-control">
                                                                    <option value="" selected  disabled>Select</option>
                                                                    @foreach ($mystery_types as $mystery_type)
                                                                        <option value="{{ $mystery_type->id }}">{{ $mystery_type->mystery_name }}</option>
                                                                    @endforeach
                                                                    @error('mystery_type_id')
                                                                        <small class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="heading">Food Name</label>
                                                                <span class="text-danger">*</span>
                                                                <input type="text" name="food_name"  class="form-control" value="{{ $foodOffer->food_name }}"  placeholder="Enter food name">
                                                                @error('food_name')
                                                                    <small class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                            {{-- <div class="form-group">
                                                                <label for="inputAddress" class="form-label">Food Description</label>
                                                                <span class="text-danger">*</span>
                                                                <textarea name="food_description" class="form-control" placeholder="Write Description here...">{!! $foodOffer->food_description !!}</textarea>
                                                            </div> --}}
                                                            <div class="form-group">
                                                                <label class="form-label">Food Description</label>
                                                                <span class="text-danger">*</span>
                                                                <div class="custom-editor-wrapper">
                                                                    <div class="custom-editor">{!! $foodOffer->food_description !!}</div>
                                                                    <input type="hidden" name="food_description" class="custom-editor-input" value="{{ $foodOffer->food_description }}">
                                                                    @error('food_description')
                                                                    <small class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="image" class="form-label">Upload detailed image</label>
                                                                <span class="text-danger">*</span>
                                                                <div class="custom-file">
                                                                    <input type="file" name="food_image" class="custom-file-input" id="image">
                                                                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                                                </div>
                                                                @error('food_image')
                                                                    <small class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                                <p>Existing Image:</p>
                                                                <img src="{{ $foodOffer->food_image }}" alt="" height="100">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="image" class="form-label">Upload thumbnail image</label>
                                                                <span class="text-danger">*</span>
                                                                <div class="custom-file">
                                                                    <input type="file" name="thumbnail_image" class="custom-file-input" id="image">
                                                                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                                                </div>
                                                                @error('thumbnail_image')
                                                                    <small class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                                <p>Existing Image:</p>
                                                                <img src="{{ $foodOffer->thumbnail_image }}" alt="" height="100">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="image" class="form-label">Upload list image</label>
                                                                <span class="text-danger">*</span>
                                                                <div class="custom-file">
                                                                    <input type="file" name="list_image" class="custom-file-input" id="image">
                                                                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                                                </div>
                                                                @error('list_image')
                                                                    <small class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                                <p>Existing Image:</p>
                                                                <img src="{{  $foodOffer->list_image }}" alt="" height="100">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="heading">Stock</label>
                                                                <span class="text-danger">*</span>
                                                                <input type="text" name="food_stock"  class="form-control" value="{{ $foodOffer->food_stock }}"  placeholder="Enter food stock">
                                                                @error('food_stock')
                                                                    <small class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="heading">Price</label>
                                                                <span class="text-danger">*</span>
                                                                <input type="text" name="price"  class="form-control" value="{{ $foodOffer->price }}">
                                                                @error('price')
                                                                    <small class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="heading">Discount Price</label>
                                                                {{-- <span class="text-danger">*</span> --}}
                                                                <input type="text" name="discount_price"  class="form-control" value="{{ $foodOffer->discount_price }}">
                                                                @error('discount_price')
                                                                    <small class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="heading">Price Prefix</label>
                                                                <span class="text-danger">*</span>
                                                                <input type="text" name="prefix"  class="form-control" value="{{ $foodOffer->prefix }}">
                                                                @error('prefix')
                                                                    <small class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                            {{-- <div class="form-group">
                                                                <label for="category" class="form-label">Boutique Name</label>
                                                                <span class="text-danger">*</span>
                                                                <select id="category" name="boutique_name" class="form-control">
                                                                    <option value="" selected disabled>Select</option>
                                                                    @foreach ($boutiques as $boutique)
                                                                        <option value="{{ $boutique->id }}">{{ $boutique->boutique_name }}</option>
                                                                    @endforeach
                                                                    @error('boutique_name')
                                                                        <small class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </select>
                                                            </div> --}}
                                                            <div class="form-group">
                                                                <label for="category" class="form-label">Boutique Name</label>
                                                                <span class="text-danger">*</span>
                                                                <select id="category" name="boutique_id" class="form-control">
                                                                    <option value="" selected disabled>Select</option>
                                                                    @foreach ($boutiques as $boutique)
                                                                        <option  value="{{ $boutique->id }}" data-address="{{ $boutique->address }}" {{ $foodOffer->boutique_id == $boutique->id ? 'selected' : '' }}>{{ $boutique->boutique_name.' - '.$boutique->address }}</option>
                                                                    @endforeach
                                                                    @error('boutique_name')
                                                                        <small class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </select>
                                                            </div>
                                                            <div class="form-group my-2">
                                                                <label for="heading">Pickup date</label>
                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <p>From<span class="text-danger"> *</span></p>
                                                                        <input type="date" name="pickup_date_from"  class="form-control" value="{{ $foodOffer->pickup_date_from }}" >
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <p>To<span class="text-danger"> *</span></p>
                                                                        <input type="date" name="pickup_date_to"  class="form-control" value="{{ $foodOffer->pickup_date_to }}" >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group my-2">
                                                                <label for="heading">Pickup Time</label>
                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <p>From<span class="text-danger"> *</span></p>
                                                                        <input type="time" name="pickup_time_from"  class="form-control" value="{{ $foodOffer->pickup_time_from }}" >
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <p>To<span class="text-danger"> *</span></p>
                                                                        <input type="time" name="pickup_time_to"  class="form-control" value="{{ $foodOffer->pickup_time_to }}" >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="category" class="form-label">Allergies</label>
                                                                @if($foodOffer->allergy_ids)
                                                                @foreach(explode(',',$foodOffer->allergy_ids) as $id)
                                                                 <p class="badge badge-primary" style="margin-right: 2px">{{ \App\Models\Allergy::find($id)->name}}</p>
                                                                 @endforeach
                                                                 @else
                                                                 <p class="badge badge-primary">No allergy found!</p>
                                                                 @endif
                                                                <select id="allergy_ids{{$foodOffer->id}}" name="allergy_ids[]" class="form-control select2" multiple>
                                                                    @foreach ($allergies as $allergy)
                                                                        <option value="{{ $allergy->id }}">{{ $allergy->name }}</option>
                                                                    @endforeach
                                                                    {{-- @error('allergy_ids')
                                                                        <small class="text-danger">{{ $message }}</small>
                                                                    @enderror --}}
                                                                </select>
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
                            @push('all-modals')
                                <div class="modal fade" id="seeFoodModal{{ $foodOffer->id}}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Food Details</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">

                                                <div class="col-12 d-flex justify-content-between">
                                                    <h5 class="modal-title">Pickup Location:&nbsp; <p class="badge badge-primary">{{ Str::ucfirst($foodOffer->boutique_name)}}</p></h5>
                                                    <h5 class="modal-title">Pickup Date:&nbsp; <p class="badge badge-primary">{{ $foodOffer->pickup_date_from.' to '.$foodOffer->pickup_date_to }}</p></h5>
                                                    <h5 class="modal-title">Pickup Time:&nbsp; <p class="badge badge-primary">{{  $foodOffer->pickup_time_from.' - '.$foodOffer->pickup_time_to }}</p></h5>
                                                </div>

                                                <div class="col-12 d-flex justify-content-between">
                                                    <h5 class="modal-title">Food Name:&nbsp; <p class="badge badge-primary">{{ Str::ucfirst($foodOffer->food_name) }}</p></h5>
                                                    <h5 class="modal-title">Price:&nbsp; <p class="badge badge-primary">{{ $foodOffer->price.'$'}}</p></h5> 
                                                    <h5 class="modal-title">Stock:&nbsp;  <p class="badge badge-primary">{{ $foodOffer->food_stock }}</p></h5>
                                                </div>
                                                
                                                <div class="col-12 d-flex my-2">
                                                    <h5 class="modal-title">Allergies:&nbsp; </h5>
                                                    @if($foodOffer->allergy_ids)
                                                    @foreach(explode(',',$foodOffer->allergy_ids) as $id)
                                                     <p class="badge badge-primary" style="margin-right: 2px">{{ \App\Models\Allergy::find($id)->name}}</p>
                                                     @endforeach
                                                     @else
                                                     <p class="badge badge-primary">No allergy found!</p>
                                                     @endif
                                                </div>
                                                
                                                <div class="col-12 text-center d-flex justify-content-between my-2">
                                                    <div>
                                                        <p>Food Image</p>
                                                        <img src="{{ $foodOffer->food_image }}" alt="Food_Image" height="200">
                                                    </div>
                                                    @if($foodOffer->thumbnail_image)
                                                   <div>
                                                        <p>Thumbnail Image</p>
                                                        <img src="{{ $foodOffer->thumbnail_image }}" alt="Thumbnail_Iamge" height="200">
                                                   </div>
                                                   @endif
                                                   @if($foodOffer->list_image)
                                                    <div>
                                                        <p>List Image</p>
                                                        <img src="{{ $foodOffer->list_image }}" alt="List_Image" height="200">
                                                    </div>
                                                    @endif
                                                    
                                                </div>
                                                <div class="col-12">
                                                    <h5 class="modal-title">Description:&nbsp; </h5><p >{!! Str::ucfirst($foodOffer->food_description) !!}</p>
                                                </div>
                                                
                                            </div>
                                            
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
</section>

@push('js')

<script>
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
    $(document).ready(function(){
   
        $('#bulk_action').on('click', function(){
            if(this.checked){
                $('.bulk_btn').removeClass('hide')
                $('.food_check').each(function(){
                    this.checked = true;
                })
            }else{
                $('.bulk_btn').addClass('hide')
                $('.food_check').each(function(){
                    this.checked = false;
                })
            }
        })

        $('.food_check').on('click', function(){

            if($('.food_check:checked').length == 0){
                $('.bulk_btn').addClass('hide')
            }

            if($('.food_check:checked').length == $('.food_check').length){
                $('#bulk_action').prop('checked', true);
            }else{
                $('#bulk_action').prop('checked', false);
            } 
        })

        $('.food_check').on('click', function(){  
            if(this.checked){
            $('.bulk_btn').removeClass('hide')
           }
    })  

    $('#allFoodDelete').on('click', function(e){
        e.preventDefault();
        var ids =[];
        $('.food_check:checked').each(function(){
            ids.push($(this).attr('data-id'));

        });
        
        var ids = ids.join(',')
        
        $.ajax({
            url:"{{ route('checkedFood.delete') }}",
            method:'get',
            data:{
                ids:ids
            },success:function(res){
                if(res.status == 'success'){
                    location.href = "{{ route('foodOffers.index') }}"
                    // $('#bulk_action').prop('checked', false)
                    // $('.food_check:checked').each(function(){
                    //     $(this).parents('tr').remove();
                    //   })
                      $('#notifyDiv').removeClass('hide');
                      $('#notifyDiv').fadeIn();
                      $('#bulkMsg').text(res.message);
                      $('.bulk_btn').addClass('hide')
                      setTimeout(() => {
                        $('#notifyDiv').fadeOut();
                      }, 3000);
                      
                }else{
                    $('#bulk_action').prop('checked', false)
                    $('#notifyDiv').removeClass('hide');
                      $('#notifyDiv').fadeIn();
                      $('#bulkMsg').text(res.message);
                      $('.bulk_btn').addClass('hide')
                      setTimeout(() => {
                        $('#notifyDiv').fadeOut();
                      }, 3000);
                }
            }
        })
    })
})
</script>
<script>
    $(document).ready(function(){
        $('#food_type_modal').change(function(){
            var value = $('#food_type_modal').val();
            if(value == 2){
                $('#mystery_box_modal').removeClass('hide')
                $('#mystery_box_modal').show()
            }else{
                $('#mystery_box_modal').hide()
                $('#mystery_box_modal').addClass('hide')
            }
        })
    })
</script>
@endpush
@endsection

