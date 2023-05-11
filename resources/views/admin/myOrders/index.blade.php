@extends('layouts.dashboard')
@section('title')
{{ config('app.name') }} | My Oreders
@endsection
@section('myOrders')
    active
@endsection

@push('page-js')
    <script src="{{ asset('dashboard_assets/app-assets/js/scripts/pages/custom-datatable.js') }}"></script>
@endpush

@section('content')
<section>
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
                <div class="card-header d-flex">
                        <h3 class="card-title">My Orders</h3>
                        <div class="dropdown mx-1">
                            <button class="btn btn-primary dropdown-toggle bulk_order hide" type="button" data-toggle="dropdown" aria-expanded="false">
                              Bulk Action
                            </button>
                            <div class="dropdown-menu">
                              <button type="submit" form="bulk_order_delete" class="dropdown-item" id="allOrdersDelete"><i data-feather='database' class="mr-50"></i>Bulk Delete</button>
                            </div>
                        </div>
                        
                        {{-- Modal --}}
                                    {{-- <div class="modal fade" id="addAllergyModal" tabindex="-1" aria-hidden="true">
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
                                end Modal --}}
                </div>
                <div class="card-body">
                    <form action="{{ route('bulkOrder.delete') }}" method="post" id="bulk_order_delete">
                    @csrf
                    <div class="table-responsive text-center">
                        <table class="table table-bordered datatable ">
                            <thead>
                                <tr>
                                    <th class="nowrap">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="allOrders">
                                            <label class="custom-control-label" for="allOrders"></label>
                                        </div>
                                    </th>
                                    <th class="nowrap">Action</th>
                                    <th class="nowrap">Food Name</th>
                                    <th class="nowrap">Customer Name</th>
                                    <th class="nowrap">Email</th>
                                    <th class="nowrap">Boutique Name</th>
                                    <th class="nowrap">Pickup Time</th>
                                    <th class="nowrap">Order date</th>
                                    <th class="nowrap">Transaction Id</th>
                                    <th class="nowrap">Payment Status</th>   
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr id="tr{{ $order->id }}">
                                        <td>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input checked_order"  name="ids[{{ $order->id }}]" data-id="{{ $order->id }}" value="{{ $order->id }}" id="{{ $order->id }}">
                                                <label class="custom-control-label" for="{{ $order->id }}"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-icon btn-outline-secondary waves-effect dropdown-toggle hide-arrow" data-toggle="dropdown" data-boundary="viewport">
                                                    <i data-feather="more-vertical"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    {{-- <button type="button" class="dropdown-item"   data-toggle="modal" data-target="#editAllergyModal-">
                                                        <i data-feather="edit" class="mr-50"></i>
                                                        <span>Edit</span>
                                                    </button> --}}
                                                    
                                                    @if($order->payment_status == 1)
                                                    <a href="{{ route('order.mark.unpaid', $order->id) }}" class="dropdown-item">
                                                        <i data-feather='bookmark' class="mr-50"></i>
                                                        <span>Mark as unpaid</span>
                                                    </a>
                                                    <a href="{{ route('order.mark.book', $order->id) }}" class="dropdown-item">
                                                        <i data-feather='award' class="mr-50"></i>
                                                        <span>Mark as book</span>
                                                    </a>
                                                    <a href="{{ route('order.mark.coupon', $order->id) }}" class="dropdown-item">
                                                        <i data-feather='book' class="mr-50"></i>
                                                        <span>Mark as coupon</span>
                                                    </a>
                                                    <a href="{{ route('order.mark.species', $order->id) }}" class="dropdown-item">
                                                        <i data-feather='bookmark' class="mr-50"></i>
                                                        <span>Mark as species</span>
                                                    </a>
                                                    @elseif($order->payment_status == 2)
                                                    <a href="{{ route('order.mark.paid', $order->id) }}" class="dropdown-item">
                                                        <i data-feather='bookmark' class="mr-50"></i>
                                                        <span>Mark as paid</span>
                                                    </a>
                                                    <a href="{{ route('order.mark.unpaid', $order->id) }}" class="dropdown-item">
                                                        <i data-feather='bookmark' class="mr-50"></i>
                                                        <span>Mark as unpaid</span>
                                                    </a>
                                                    <a href="{{ route('order.mark.coupon', $order->id) }}" class="dropdown-item">
                                                        <i data-feather='book' class="mr-50"></i>
                                                        <span>Mark as coupon</span>
                                                    </a>
                                                    <a href="{{ route('order.mark.species', $order->id) }}" class="dropdown-item">
                                                        <i data-feather='bookmark' class="mr-50"></i>
                                                        <span>Mark as species</span>
                                                    </a>
                                                    @elseif($order->payment_status == 3)
                                                    <a href="{{ route('order.mark.coupon', $order->id) }}" class="dropdown-item">
                                                        <i data-feather='book' class="mr-50"></i>
                                                        <span>Mark as coupon</span>
                                                    </a>
                                                    <a href="{{ route('order.mark.species', $order->id) }}" class="dropdown-item">
                                                        <i data-feather='bookmark' class="mr-50"></i>
                                                        <span>Mark as species</span>
                                                    </a>
                                                    <a href="{{ route('order.mark.unpaid', $order->id) }}" class="dropdown-item">
                                                        <i data-feather='bookmark' class="mr-50"></i>
                                                        <span>Mark as unpaid</span>
                                                    </a>
                                                    <a href="{{ route('order.mark.book', $order->id) }}" class="dropdown-item">
                                                        <i data-feather='award' class="mr-50"></i>
                                                        <span>Mark as book</span>
                                                    </a>
                                                    @elseif($order->payment_status == 4)
                                                    <a href="{{ route('order.mark.paid', $order->id) }}" class="dropdown-item">
                                                        <i data-feather='bookmark' class="mr-50"></i>
                                                        <span>Mark as paid</span>
                                                    </a>
                                                    <a href="{{ route('order.mark.unpaid', $order->id) }}" class="dropdown-item">
                                                        <i data-feather='bookmark' class="mr-50"></i>
                                                        <span>Mark as unpaid</span>
                                                    </a>
                                                    <a href="{{ route('order.mark.coupon', $order->id) }}" class="dropdown-item">
                                                        <i data-feather='book' class="mr-50"></i>
                                                        <span>Mark as coupon</span>
                                                    </a>
                                                    <a href="{{ route('order.mark.book', $order->id) }}" class="dropdown-item">
                                                        <i data-feather='award' class="mr-50"></i>
                                                        <span>Mark as book</span>
                                                    </a>
                                                    @else
                                                    <a href="{{ route('order.mark.paid', $order->id) }}" class="dropdown-item">
                                                        <i data-feather='bookmark' class="mr-50"></i>
                                                        <span>Mark as paid</span>
                                                    </a>
                                                    <a href="{{ route('order.mark.book', $order->id) }}" class="dropdown-item">
                                                        <i data-feather='award' class="mr-50"></i>
                                                        <span>Mark as booked</span>
                                                    </a>
                                                    <a href="{{ route('order.mark.coupon', $order->id) }}" class="dropdown-item">
                                                        <i data-feather='book' class="mr-50"></i>
                                                        <span>Mark as coupon</span>
                                                    </a>
                                                    <a href="{{ route('order.mark.species', $order->id) }}" class="dropdown-item">
                                                        <i data-feather='bookmark' class="mr-50"></i>
                                                        <span>Mark as species</span>
                                                    </a>
                                                    @endif
                                                    <a href="{{ route('myOrder.delete', $order->id) }}" class="dropdown-item">
                                                        <i data-feather="trash" class="mr-50"></i>
                                                        <span>Delete</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $order->food_name }}</td> 
                                        <td>{{ $order->name }}</td> 
                                        <td>{{ $order->email }}</td> 
                                        <td>{{ $order->boutique_name }}</td> 
                                        <td>{{ $order->pickup_time}}</td> 
                                        <td>{{ $order->order_date }}</td> 
                                        <td>{{ $order->transaction_id ?? 'not available' }}</td> 
                                        <td>
                                            @if($order->payment_status == 0)
                                            <span class="badge badge-pill badge-success">Unpaid</span>
                                            @elseif($order->payment_status == 1)
                                            <span class="badge badge-pill badge-success">Paid</span>
                                            @elseif($order->payment_status == 2)
                                            <span class="badge badge-pill badge-success">Booked</span>
                                            @elseif($order->payment_status == 3)
                                            <span class="badge badge-pill badge-success">Coupon</span>
                                            @elseif($order->payment_status == 4)
                                            <span class="badge badge-pill badge-success">Species</span>
                                            @endif
                                        </td> 
                                    </tr>
                                {{-- @push('all-modals')
                                <div class="modal fade" id="editAllergyModal-" tabindex="-1" aria-hidden="true">
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
                            @endpush --}}
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@push('js')
    <script>
        $(document).ready(  function(){
            $('#allOrders').on('click', function(){
            if(this.checked){
                $('.bulk_order').removeClass('hide')
                $('.checked_order').each(function(){
                    this.checked = true;
                })
            }else{
                $('.bulk_order').addClass('hide')
                $('.checked_order').each(function(){
                    this.checked = false;
                })
            }
        })

        $('.checked_order').on('click', function(){

        if($('.checked_order:checked').length == 0){
            $('.bulk_order').addClass('hide')
        }

        if($('.checked_order:checked').length == $('.checked_order').length){
            $('#allOrders').prop('checked', true);
        }else{
            $('#allOrders').prop('checked', false);
        } 
        })

        $('.checked_order').on('click', function(){  
        if(this.checked){
        $('.bulk_order').removeClass('hide')
        }
        })
        })
    </script>
@endpush
