@foreach ($item->getActivity->where('type', 'attachment') as $activity) 
<article class="attachments-block__card d-flex rounded">
    <div class="attachments-block__card__head d-flex align-items-center justify-content-center overflow-hidden flex-shrink-0">
        @if ($activity->file_type == 'jpg' || $activity->file_type == 'png'|| $activity->file_type == 'jpeg' || $activity->file_type == 'svg')
        <img src="{{ asset('uploads/planning') }}/{{ $activity->file_name }}" alt="attachment image" class="attachments-block__card__head__image w-100 h-100">
        @else
        <span class="attachments-block__card__head__text font-weight-bold">{{ $activity->file_type }}</span>
        @endif
    </div>
    <div class="attachments-block__card__body flex-grow-1">
        <h4 class="attachments-block__card__body__title">
            <a href="{{ asset('uploads/planning') }}/{{ $activity->file_name }}" target="_blank" class="attachments-block__card__body__title__text">{{ $activity->file_name }}</a>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-up-right"><line x1="7" y1="17" x2="17" y2="7"></line><polyline points="7 7 17 7 17 17"></polyline></svg>
        </h4>
        <a href="{{ asset('uploads/planning') }}/{{ $activity->file_name }}" download="{{ $activity->file_name }}" target="_blank" class="attachments-block__card__btn attachments-block__card__btn--download btn btn-sm rounded-sm btn-flat-secondary waves-effect">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-download"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
            Download
        </a>
        <button type="button" class="attachments-block__card__btn attachments-block__card__btn--remove btn btn-sm rounded-sm btn-flat-secondary waves-effect" data-id="{{ $activity->id }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            Delete
        </button>
    </div>
</article>
@endforeach 