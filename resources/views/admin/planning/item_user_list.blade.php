@foreach ($users  as $user)
@php
    $explode = explode(' ', $user->name);
    $checked = \App\Models\TrelloItemMember::where('item_id', $item->id)->where('member_id', $user->id)->exists();
@endphp  
<li class="select-members-list__item">
    <label class="select-member-block position-relative">
        <input data-id="{{ $item->id }}" data-trello-id="{{ $item->trello_id }}" type="checkbox" name="member_item" class="select-member-block__input select-member-block__input_id" {{ $checked ? 'checked':'' }} value="{{ $user->id }}" >
        <span class="select-member-block__label d-flex align-items-center">
            <span class="select-member-block__label__avatar d-inline-flex align-items-center justify-content-center rounded-circle overflow-hidden flex-shrink-0">

                @if ($user->profile_photo_url)  
                    <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" class="select-member-block__label__avatar w-100 h-100">
                @else
                    <span class="select-member-block__label__avatar__text">{{ $explode[0][0] }}{{ $explode[1][0] ?? '' }}</span>
                @endif 
            </span>
            <span class="select-member-block__label__text flex-grow-1">
                {{ $user->name }} 
                {{-- <span class="select-member-block__label__sub-text">({{ $user->email }})</span> --}}
            </span>
        </span>
    </label>
</li> 
@endforeach