@foreach ($item->getActivity->where('deleted_status', 0) as $activity)
    <div class="d-flex align-items-start mb-2">
        <a href="#!" class="activity-block__avatar flex-shrink-0 d-inline-flex align-items-center justify-content-center rounded-circle overflow-hidden text-uppercase">
            @if ($activity->getUser->profile_photo_url)
            <img src="{{ $activity->getUser->profile_photo_url }}" alt="avatar" class="activity-block__avatar__image rounded-circle w-100 h-100">
            @else
            <img src="{{ asset('uploads/default.png') }}" alt="avatar" class="activity-block__avatar__image rounded-circle w-100 h-100"> 
            @endif
            {{-- <img src="{{ asset('uploads/testimonial-2CtC-13.jpg') }}" alt="avatar image" class="activity-block__avatar__image rounded-circle w-100 h-100"> --}}
        </a>
        <div class="activity-block__details flex-grow-1">
            <p class="activity-block__details__text mb-0">
                @if ($activity->type == 'comment')
                <a href="#!" class="activity-block__details__link activity-block__details__link--bold">{{ $activity->getUser->name }}</a> commented 
                {{ $activity->comment }}
                @else
                <a href="#!" class="activity-block__details__link activity-block__details__link--bold">{{ $activity->getUser->name }}</a> attached 
                <a target="_blank" href="{{ asset('uploads/planning') }}/{{ $activity->file_name }}" class="activity-block__details__link activity-block__details__link--underline">{{ $activity->file_name }}</a> to this card   
                @endif
            </p>
            <div class="d-flex align-items-center">
                <small class="text-muted">{{ \Carbon\Carbon::parse($activity->created_at)->format('M d ') .'at '. \Carbon\Carbon::parse($activity->created_at)->format('h:i A') }}</small>
                <button type="button" class="link-btn item_activity_delete_btn" data-id="{{ $activity->id }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    <span>Delete</span>
                </button>
            </div>
        </div>
    </div>
@endforeach 