@forelse ($item->getItemMemebers->take(5) as $member)
@php
    $explode = explode(' ', $member->getUser->name);
@endphp 
<li class="card-block__user-list__item d-inline-flex">
    <a href="#!" class="card-block__user-list__item__link d-inline-flex align-items-center justify-content-center rounded-circle overflow-hidden" data-toggle="tooltip" data-placement="top" data-original-title="{{ $member->getUser->name }}">
        @if ($member->getUser->profile_photo_url)
            <img src="{{ $member->getUser->profile_photo_url }}" alt="{{ $member->getUser->name }}" class="card-block__user-list__item__image w-100 h-100">
        @else
            <span class="card-block__user-list__item__link__text">{{ $explode[0][0] }}{{ $explode[1][0] ?? '' }}</span>
        @endif
    </a>
</li>
@empty 
@endforelse 
@if ($item->getItemMemebers->count() > 5)
<li class="card-block__user-list__item-end">
    <span class="card-block__user-list__item-end__text">{{ $item->getItemMemebers->count() -5 }}</span>
    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-plus card-block__user-list__item-end__icon"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="20" y1="8" x2="20" y2="14"></line><line x1="23" y1="11" x2="17" y2="11"></line></svg>
</li>
@endif