@foreach ($item->getChecklists as $checklist)
    <div class="checklist-block mb-2">
        <div class="d-flex flex-wrap align-items-start">
            <div class="checklist-block__left flex-shrink-0 mr-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square icon-lg"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
            </div>
            <div class="checklist-block__right flex-grow-1">
                <div class="checklist-block__edit-wrapper">
                    <div class="checklist-block__edit__header">
                        <div class="d-flex align-items-center justify-content-between mb-1">
                            <h3 class="checklist-block__edit__title common-heading-title mb-0 w-100">{{ $checklist->title }}</h3>
                            <button type="button" class="checklist-block__remove-btn btn btn-sm rounded-sm btn-secondary-light waves-effect waves-float flex-shrink-0"  data-id="{{ $checklist->id }}">Delete</button>
                        </div>
                    </div>
                    <textarea class="checklist-block__edit__input form-control mb-2 d-none" placeholder="Edit Checklist Name" rows="2" data-id="{{ $checklist->id }}"></textarea>
                </div>
            </div>
        </div>
        <div class="checklist-block__progress-wrapper d-flex flex-wrap align-items-center mb-1" id="checklistProgressbar{{ $checklist->id }}">
           @include('admin.planning.progress_bar')
        </div>
        <div class="checklist-block__sub-category">
            <div id="checklistItem{{ $checklist->id }}">
               @include('admin.planning.checklist_item')
            </div> 
            <button class="checklist__sub-category__add-btn btn btn-sm rounded-sm btn-secondary-light waves-effect waves-float text-left font-weight-normal" data-id="{{ $checklist->id }}">Add an item</button>
        </div>
    </div>
@endforeach