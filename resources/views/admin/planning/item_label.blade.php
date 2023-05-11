@foreach ($labels as $label)
@php
    $existing = \App\Models\ItemLabel::where('item_id', $item->id)->where('label_id', $label->id)->exists();
@endphp
<li class="select-labels-list__item">
    <div class="d-flex align-items-center">
        <label class="select-label-block position-relative">
            <input type="checkbox" name="label_item" class="select-label-block__input" value="{{ $label->id }}" data-id="{{ $item->id }}" {{ $existing ? 'checked':'' }}>
            <span class="select-label-block__label"  style="background-color: {{ $label->bg_color }}">{{ $label->name }}</span>
        </label>
        <button type="button" class="select-labels-list__item__remove-btn btn btn-sm rounded-sm btn-icon btn-flat-secondary waves-effect flex-shrink-0" data-id="{{ $label->id }}" data-item="{{ $item->id }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
        </button>
    </div>
</li> 
@endforeach 