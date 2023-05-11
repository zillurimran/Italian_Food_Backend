@php
    $color_code_array = [
        '#75dab4',
        '#f49025',
        '#43bf57',
        '#619ffc'
    ]
@endphp
@foreach ($order_status as $status)
    <article class="card-element" data-id="{{ $status->id }}">
        <header class="card-element__header" style="background-color: {{ $color_code_array[($status->id - 1)] }}">
            {{-- <textarea class="card-element__header__title"rows="1" readonly="readonly" data-id="{{ $status->id }}">{{ $status->name }}</textarea> --}}
            <span class="card-element__header__title" style="border: 0">{{ $status->name }}</span>
            {{-- <div class="dropdown">
                <button class="btn btn-icon btn-flat-secondary waves-effect dropdown-toggle  hide-arrow  dropdown-toggle--no-icon" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <button type="button" class="dropdown-item add--card-block">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus dropdown-item__icon"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                        Add Card
                    </button>
                    <button type="button" class="dropdown-item remove--card-element" data-id="{{ $status->id }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 dropdown-item__icon"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                        Remove Card
                    </button>
                </div>
            </div> --}}
        </header>
        <main class="card-element__body" id="trelloItemBlock{{ $status->id }}">
            <!-- Each Card Block -->
            @include('admin.planning.trello_item')
        </main>
    </article>
@endforeach
    {{-- <button class="btn btn-primary waves-effect waves-float waves-light add--card-element">
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus btn__icon"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
        Add Another List
    </button> --}}
