@foreach ($status->orders as $order)
@if (\App\Models\TrelloItemMember::where('item_id', $order->id)->where('member_id', Auth::id())->exists() || Auth::user()->role == 'admin')
<button type="button" class="card-block" data-id="{{ $order->id }}">
    @if ($order->food->food_image)
    <div class="card-block__header" id="itemCoverPhoto{{ $order->id }}" style="background-image: url('{{ $order->food->food_image }}')"></div>
    @else
    <div class="card-block__header d-none" id="itemCoverPhoto{{ $order->id }}"></div>
    @endif
    <span class="card-block__badge badge badge-light-success rounded-pill">
        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
        {{ \Carbon\Carbon::parse($order->food->pickup_date_from)->format('d-m-Y') }}
    </span>
    <h4 class="card-block__title">{{ $order->food->food_name ?? 'Not Available' }}</h4>
    {{-- <ul class="labels-list list-unstyled" id="TrelloItemLabel{{ $order->id }}">
        @include('admin.planning.item_labels')
    </ul> --}}
    <p class="card-text">
        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
        {{ $order->customer_name }}
    </p>
    @if($order->getCustomer->phone)
        <p class="card-text">
            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
            {{ $order->getCustomer->phone }}
        </p>
    @endif
    <div class="d-flex align-items-center">
        <div class="d-flex align-items-center mr-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clock mr-50 text-success"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
            <span>{{ $order->food->pickup_time_from }}</span>
        </div>
        <div class="d-flex align-items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clock mr-50 text-warning"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
            <span>{{ $order->food->pickup_time_to }}</span>
        </div>
    </div>
    {{-- <ul class="card-block__actions-list list-unstyled d-flex flex-wrap align-items-center" id="itemIconBlock{{ $order->id }}">
        @include('admin.planning.item_icon')
    </ul>
    <ul class="card-block__user-list list-unstyled d-flex flex-wrap align-items-center justify-content-end mb-0" id="TrelloItemMemberBlock{{ $order->id }}">
        @include('admin.planning.item_member_block')
    </ul> --}}
</button>
@endif
@endforeach
