@extends('layouts.dashboard')

{{-- Title --}}
@section('title')
    {{ config('app.name') }}
@endsection

{{-- Css --}}
@push('vendor-css')
<link rel="stylesheet" href="{{ asset('todo_assets/css/style.css') }}">
@endpush
@push('css') 

@endpush

@push('page-js') 
@endpush

{{-- Menu Active --}}
@section('planning')
    active
@endsection

{{-- Breadcrumb --}}
@section('breadcrumb')
    <h2 class="content-header-title float-left mb-0">Planning</h2>
    <div class="breadcrumb-wrapper">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">
            <span>
            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
            </span>
            </a>
            </li>
            <li class="breadcrumb-item">
                 Planning
            </li>
        </ol>
    </div>
@endsection


    {{-- Content --}}
    @section('content')
    <main class="workspace">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-3 col-lg-4 col-sm-6 mb-2">
                    <button type="button" class="create-workspace-btn btn btn-block h-100 btn-outline-primary waves-effect active" data-toggle="modal" data-target="#planning-modal">
                        <h4 class="create-workspace-btn__text">{{ __('Create new planning') }}</h4>
                        <h5 class="create-workspace-btn__text"><small>{{ $plannings->count() }} {{ __('remaining') }}</small></h5>
                    </button>
                </div>
                @foreach ($plannings as $planning)
                    <div class="col-xl-3 col-lg-4 col-sm-6 mb-2">
                        <div class="workspace-card w-100 h-100 position-relative" style="background: {{ $planning->color }} url({{ asset('uploads/planning') }}/{{ $planning->image }})">
                            <a href="{{ route('planning.item', $planning->id) }}" class="stretched-link"></a>
                            <div class="d-flex align-items-center justify-content-between">
                                <p class="workspace-card__title mb-0">{{ $planning->name }}</p>
                                <div class="dropdown workspace-card__dropdown">
                                    <button class="btn btn-icon btn-flat-secondary waves-effect dropdown-toggle hide-arrow dropdown-toggle--no-icon" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        {{-- <button type="button" class="dropdown-item" data-toggle="modal" data-target="#assign-workspace-modal{{ $planning->id }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-plus"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="20" y1="8" x2="20" y2="14"></line><line x1="23" y1="11" x2="17" y2="11"></line></svg>
                                            <span class="dropdown-item__text">Assign</span>
                                        </button> --}}
                                        <button type="button" class="dropdown-item" data-toggle="modal" data-target="#update-planning-modal{{ $planning->id }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                            <span class="dropdown-item__text">{{ __('Edit') }}</span>
                                        </button>
                                        <form action="{{ route('planning.delete') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $planning->id }}">
                                            <button type="submit" class="dropdown-item workspace-card__remove-btn">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                                <span class="dropdown-item__text">{{ __('Delete') }}</span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <ul class="card-block__user-list list-unstyled d-flex flex-wrap align-items-center justify-content-end mb-0 mt-auto">
                                @foreach ($planning->getAssignee->take(5) as $assignee)
                                    @php
                                        $explode = explode(' ', $assignee->name);
                                    @endphp 
                                    <li class="card-block__user-list__item d-inline-flex">
                                        <a href="#!" class="card-block__user-list__item__link d-inline-flex align-items-center justify-content-center rounded-circle overflow-hidden" data-toggle="tooltip" data-placement="top" data-original-title="{{ $assignee->name }}"> 
                                            @if ($assignee->profile_photo_url)
                                                <img src="{{ $assignee->profile_photo_url }}" alt="{{ $assignee->name }}" class="card-block__user-list__item__image w-100 h-100">
                                            @else
                                                <span class="card-block__user-list__item__link__text">{{ $explode[0][0] }}{{ $explode[1][0] ?? '' }}</span>
                                            @endif
                                        </a>
                                    </li> 
                                @endforeach
                                @if ($planning->getAssignee->count() > 5)
                                    <li class="card-block__user-list__item-end">
                                        <span class="card-block__user-list__item-end__text">{{ $planning->getAssignee->count() - 5 }}</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-plus card-block__user-list__item-end__icon"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="20" y1="8" x2="20" y2="14"></line><line x1="23" y1="11" x2="17" y2="11"></line></svg>
                                    </li>
                                @endif 
                            </ul>
                        </div>
                    </div>
                    @push('all-modals')
                        <div class="modal modal--workspace fade" id="update-planning-modal{{ $planning->id }}" tabindex="-1" aria-hidden="true" role="dialog">
                            <div class="modal-dialog modal-dialog-centered modal-sm">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Update Planning</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('planning.update') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label class="form-control-label w-100 mb-0">
                                                            <span class="form-control-label__text">Planning Name <span class="text-danger">*</span></span>
                                                            <input type="text" class="form-control" name="name" value="{{ $planning->name }}" required>
                                                            <input type="hidden" name="id" value="{{ $planning->id }}">
                                                        </label>
                                                    </div> 
                                                    @if ($planning->image)
                                                    <div class="form-group">
                                                        <div class="workspace-background-preview">
                                                            <img src="{{ asset('uploads/planning') }}/{{ $planning->image }}" alt="Preview Image" class="workspace-background-preview__image w-100 h-100">
                                                        </div>
                                                    </div>
                                                    @endif
                                                    <div class="form-group">
                                                        <label class="form-control-label w-100 mb-0">
                                                            <span class="form-control-label__text">{{ $planning->image ? "Change" : "Planning" }} Background Image</span>
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input" name="image">
                                                                <label class="custom-file-label"></label>
                                                            </div>
                                                        </label>
                                                    </div>
                                                    <div class="divider">
                                                        <div class="divider-text">Or</div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="form-control-label w-100 mb-0">
                                                            <span class="form-control-label__text">{{ $planning->image ? "Planning" : "Change" }} Background Color</span>
                                                            <input type="color" class="form-control" value="{{ $planning->color }}" name="color">
                                                        </label>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="form-control-label w-100 mb-0">
                                                            <span class="form-control-label__text">Assign Members</span>
                                                            <select name="user_id[]" class="select2 form-control bg-transparent members-assign-select" data-placeholder="Assign Members" multiple="multiple" tabindex="-1" aria-hidden="true" id="workspace-assign-member{{ $planning->id }}">
                                                                @foreach ($users as $user)
                                                                    <option {{ $user->plannings()->where('planning_id', $planning->id)->exists() ? 'selected':'' }} 
                                                                        @if ($user->profile_photo_url)
                                                                            data-img="{{ $user->profile_photo_url }}"
                                                                        @else
                                                                            data-img="{{ asset('uploads/default.png') }}"
                                                                        @endif
                                                                        value="{{ $user->id }}">{{ $user->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </label>
                                                    </div>
                                                    <button type="submit" class="btn btn-block btn-success waves-effect waves-float waves-light">Update</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endpush
                @endforeach
            </div>
        </div>
    </main>

<!-- End Todo Contents Section -->

    <!-- Create Workspace Modal -->
    <div class="modal modal--workspace fade" id="planning-modal" tabindex="-1" aria-labelledby="planning-modal-title" aria-hidden="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create planning</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('planning.create') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-control-label w-100 mb-0">
                                        <span class="form-control-label__text">Planning Name <span class="text-danger">*</span></span>
                                        <input type="text" class="form-control" name="name" required>
                                    </label>
                                </div> 
                                <div class="form-group">
                                    <label class="form-control-label w-100 mb-0">
                                        <span class="form-control-label__text">Planning Background Image</span>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="image">
                                            <label class="custom-file-label"></label>
                                        </div>
                                    </label>
                                </div>
                                <div class="divider">
                                    <div class="divider-text">Or</div>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label w-100 mb-0">
                                        <span class="form-control-label__text">Planning Background Color</span>
                                        <input type="color" class="form-control" value="#75dab4" name="color">
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label w-100 mb-0">
                                        <span class="form-control-label__text">Assign Members</span>
                                        <select name="user_id[]" class="select2 form-control bg-transparent members-assign-select" data-placeholder="Assign Members" multiple="multiple" tabindex="-1" aria-hidden="true" id="planning-assign-member">
                                            @foreach ($users as $user)
                                                @if ($user->profile_photo_url) 
                                                <option data-img="{{ $user->profile_photo_url }}" value="{{ $user->id }}">{{ $user->name }}</option>
                                                @else
                                                <option data-img="{{ asset('uploads/default.png') }}" value="{{ $user->id }}">{{ $user->name }}</option>  
                                                @endif
                                            @endforeach
                                        </select>
                                    </label>
                                </div>
                                <button type="submit" class="btn btn-block btn-success waves-effect waves-float waves-light">Create</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
<script>
    function reusableMembersAssignSelectFunction(){
        let membersAssignSelect = $('.members-assign-select');

        function assignMembers(option) {
            if (!option.id) {
            return option.text;
            }
            var $person =
            '<div class="media align-items-center">' +
            '<img class="media__image d-block rounded-circle mr-50" src="' +
            $(option.element).data('img') +
            '" height="26" width="26" alt="' +
            option.text +
            '">' +
            '<div class="media-body"><p class="media-body__text mb-0">' +
            option.text +
            '</p></div></div>';
    
            return $person;
        };

        if (membersAssignSelect.length){
            membersAssignSelect.each(function(){
                let $membersAssignSelectElement = $(this);
                $membersAssignSelectElement.wrap('<div class="position-relative"></div>');
                $membersAssignSelectElement.after('<div class="invalid-feedback">This field is required</div>');
                $membersAssignSelectElement.select2({
                    placeholder: "Add Members",
                    multiple: true,
                    allowClear: true,
                    dropdownParent: $membersAssignSelectElement.parent(),
                    templateResult: assignMembers,
                    templateSelection: assignMembers,
                    escapeMarkup: function (es) {
                        return es;
                    }
                });
            });
        }
    }
    $(document).ready(function () {

        reusableMembersAssignSelectFunction();

        // $(".workspace-card__remove-btn").on("click", function(){
        //     $(this).closest(".workspace-card").parent().remove();
        // });
    });
</script>
@endpush
