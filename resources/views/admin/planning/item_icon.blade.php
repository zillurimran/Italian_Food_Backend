@php
    $count = 0;
    foreach ($order->getChecklists as  $checklist) {
        if(($checklist->getItems->count() > 0) && ($checklist->getItems->count() == $checklist->getItems->where('status', 1)->count())){
            $count ++;
        }
    }  
@endphp
<li class="card-block__actions-list__item align-items-center  {{ ($order->status == 1) ? 'd-inline-flex':'d-none' }}" data-toggle="tooltip" data-placement="top" data-original-title="This task has completed."> 
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg>
</li>
<li class="card-block__actions-list__item align-items-center {{ $order->description ? 'd-inline-flex':'d-none' }}" data-toggle="tooltip" data-placement="top" data-original-title="This card has a description.">
    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-book"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg>
</li>
<li class="card-block__actions-list__item align-items-center {{ ($order->getActivity->where('deleted_status', 0)->count() > 0) ? 'd-inline-flex':'d-none' }}" data-toggle="tooltip" data-placement="top" data-original-title="Comments">
    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-square"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
    <span class="card-block__actions-list__item__text">{{ $order->getActivity->where('deleted_status', 0)->count() }}</span>
</li>
<li class="card-block__actions-list__item align-items-center {{ ($order->getActivity->where('type', 'attachment')->count() > 0) ? 'd-inline-flex':'d-none' }}" data-toggle="tooltip" data-placement="top" data-original-title="Attachments">
    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
    <span class="card-block__actions-list__item__text">{{ $order->getActivity->where('type', 'attachment')->count() }}</span>
</li>

<li class="card-block__actions-list__item align-items-center {{ ($order->getChecklists->count() > 0) ? 'd-inline-flex':'d-none' }}" data-toggle="tooltip" data-placement="top" data-original-title="Checklist items">
    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
    <span class="card-block__actions-list__item__text">{{ $count }}/{{ $order->getChecklists->count() }}</span>
</li>