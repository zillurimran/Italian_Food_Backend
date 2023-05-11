<div class="row">
    <div class="col-lg-5">
        <div class="embed-responsive embed-responsive-16by9 h-100">
            <img src="{{ $item->food->food_image }}" alt="product preview" class="embed-responsive-item object-fit--cover">
        </div>
    </div>
    <div class="col-lg-7">
        <div class="px-2 px-lg-0 py-2">
            <span class="card-block__badge badge badge-light-success rounded-pill">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                {{ \Carbon\Carbon::parse($item->food->pickup_date_from)->format('d-m-Y') }}
            </span>
            <h2 class="card-block__title mt-1">{{ $item->food->food_name ?? 'Not Available' }}</h2>
            <span>Customer Name:</span>
            <h5 class="card-text mt-25 mb-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                {{ $item->customer_name }}
            </h5>
            @if($item->getCustomer->phone)
            <span>Customer Phone Number:</span>
            <h5 class="card-text mt-25 mb-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                {{ $item->getCustomer->phone }}
            </h5>
            @endif
            <span>Pickup Start Time:</span>
            <h5 class="d-flex align-items-center mt-25 mb-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clock text-success mr-50"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                <span>{{ $item->food->pickup_time_from }}</span>
            </h5>
            <span>Pickup End Time:</span>
            <h5 class="d-flex align-items-center mt-25 mb-0">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clock text-warning mr-50"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                <span>{{ $item->food->pickup_time_to }}</span>
            </h5>
        </div>
    </div>
    <div class="col-12">
        <div class="table-responsive rounded-bottom">
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th class="nowrap">Product Quantity</th>
                        <th class="nowrap">Product Price</th>
                        <th class="nowrap">Total Price</th>
                        <th class="nowrap">Payment Method</th>
                        <th class="nowrap">Order Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->net_price }}€</td>
                        <td>{{ $item->total_price }}€</td>
                        <td>
                            @switch($item->payment_status)
                                @case(0)
                                    Cash
                                    @break
                                @case(1)
                                    Paid
                                    @break
                                @case(2)
                                    Delivered
                                    @break
                                @case(3)
                                    Meal Voucher
                                    @break
                                @default
                            @endswitch
                        </td>
                        <td>
                            <span class="badge badge-warning">{{ $item->status->name }}</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
