@foreach ($checklist->getItems as $item_value)
    <div class="checklist-block__sub-category__list d-flex align-items-center {{ ($item_value->status == 1)? 'checked':'' }}">
        <div class="checklist-block__sub-category__list__left flex-shrink-0">
            <label class="modified-control modified-checkbox">
                <input type="checkbox" class="checklist-block__sub-category__list__checkbox modified-control-input"  data-id="{{ $item_value->id }}" data-checklist="{{ $item_value->checklist_id }}" {{ ($item_value->status == 1)? 'checked':'' }}>
                <span class="modified-control-label"></span>
            </label>
        </div>
        <div class="checklist-block__sub-category__list__right flex-grow-1">
            <div class="d-flex flex-wrap align-items-center">
                <span class="checklist-block__sub-category__list__title position-relative">{{ $item_value->title }}</span>
                <textarea class="checklist-block__sub-category__list__edit-title-input form-control w-100 d-none" rows="2" placeholder="Edit Title" data-id="{{ $item_value->id }}"></textarea>
                <div class="checklist-block__sub-category__list__actions d-flex align-items-center flex-shrink-0 ml-auto">
                    <div class="dropdown dropdown--keepopen">
                        <button type="button" class="btn btn-sm rounded-sm {{ $item_value->due_date ? 'btn-success':'btn-secondary-light' }} waves-effect waves-float waves-light dropdown-toggle dropdown-toggle--no-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="checklistDateSelect{{ $item_value->id }}">
                            @include('admin.planning.checklist_date')
                        </button> 
                        <div class="dropdown-menu">
                            <div class="dropdown-menu__container">
                                <div class="dropdown-menu__card">
                                    <div class="dropdown-menu__head d-flex align-items-center justify-content-between">
                                        <button type="button" class="btn btn-sm btn-icon btn-flat-secondary waves-effect btn--hidden">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-left"><polyline points="15 18 9 12 15 6"></polyline></svg>
                                        </button>
                                        <h4 class="dropdown-menu__head__title mb-0">Change due date</h4>
                                        <button type="button" class="dropdown-menu__close btn btn-sm btn-icon btn-flat-danger waves-effect">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                        </button>
                                    </div>
                                    <div class="dropdown-menu__body">
                                        <input type="date" name="change_due_date" value="{{ \Carbon\Carbon::parse($item_value->due_date)->format('Y-m-d') }}" class="form-control change_checklist_due_date" data-id="{{ $item_value->id }}" placeholder="Select Date" data-input>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown dropdown--keepopen">
                        <button type="button" class="checklist-block__sub-category__list__actions__btn--member btn btn-sm rounded-sm btn-secondary-light btn-icon rounded-circle waves-effect waves-float dropdown-toggle dropdown-toggle--no-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="checklist_item_member_image{{ $item_value->id }}">
                            @include('admin.planning.checklist_member')
                        </button>
                        <div class="dropdown-menu">
                            <div class="dropdown-menu__container">
                                <div class="dropdown-menu__card">
                                    <div class="dropdown-menu__head d-flex align-items-center justify-content-between">
                                        <button type="button" class="btn btn-sm btn-icon btn-flat-secondary waves-effect btn--hidden">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-left"><polyline points="15 18 9 12 15 6"></polyline></svg>
                                        </button>
                                        <h4 class="dropdown-menu__head__title mb-0">Members</h4>
                                        <button type="button" class="dropdown-menu__close btn btn-sm btn-icon btn-flat-danger waves-effect">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                        </button>
                                    </div>
                                    <div class="dropdown-menu__body">
                                        <div class="form-group">
                                            <input type="search" class="dropdown-menu__body__search-input form-control" placeholder="Search members..." autocomplete="off">
                                        </div>
                                        <div class="select-members-list-wrapper simple-bar">
                                            <ul class="select-members-list list-unstyled dropdown-menu__body__search-list mb-0">
                                                @foreach ($users  as $user)
                                                    @php
                                                        $explodes = explode(' ', $user->name);
                                                        $checkeds = \App\Models\ChecklistItem::where('id', $item_value->id)->where('member', $user->id)->exists();
                                                    @endphp 
                                                <li class="select-members-list__item">
                                                    <label class="select-member-block position-relative">
                                                        <input type="radio" name="member_item{{ $item_value->id }}" class="select-member-block__input select-member-block__input_checklist" data-id="{{ $item_value->id }}"
                                                        value="{{ $user->id }}"  {{ $checkeds ? 'checked': '' }}>
                                                        <span class="select-member-block__label d-flex align-items-center">
                                                            <span class="select-member-block__label__avatar d-inline-flex align-items-center justify-content-center rounded-circle overflow-hidden flex-shrink-0">
                                                                @if ($user->profile_photo_url)  
                                                                    <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" class="select-member-block__label__avatar w-100 h-100">
                                                                @else
                                                                    <span class="select-member-block__label__avatar__text">{{ $explodes[0][0] }}{{ $explodes[1][0] ?? '' }}</span>
                                                                @endif  
                                                            </span>
                                                            <span class="select-member-block__label__text flex-grow-1">
                                                                {{ $user->name }}  
                                                            </span>
                                                        </span>
                                                    </label>
                                                </li> 
                                                @endforeach 
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown">
                        <button type="button" class="btn btn-sm rounded-sm btn-secondary-light btn-icon waves-effect waves-float" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                        </button>
                        <div class="dropdown-menu">
                            <button class="dropdown-item checklist-block__sub-category__list__remove-btn" data-id="{{ $item_value->id }}" data-checklist="{{ $item_value->checklist_id }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash btn__icon"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                Delete
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
@endforeach