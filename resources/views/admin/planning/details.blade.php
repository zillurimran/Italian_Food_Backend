@extends('layouts.dashboard')

{{-- Title --}}
@section('title')
    {{ config('app.name') }}
@endsection

{{-- Css --}}
@push('vendor-css')
<link rel="stylesheet" href="{{ asset('todo_assets/plugins/simplebar/css/simplebar.min.css') }}">
<link rel="stylesheet" href="{{ asset('todo_assets/css/style.css') }}">
@endpush
@push('css')

@endpush

@push('page-js')
<script src="{{ asset('todo_assets/plugins/sortableJS/js/sortable.min.js') }}"></script>
<script src="{{ asset('todo_assets/plugins/sortableJS/js/jquery-sortable.js') }}"></script>
<script src="{{ asset('todo_assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
<script src="{{ asset('todo_assets/js/script.js') }}"></script>
@endpush

{{-- Menu Active --}}
@section('planning')
    active
@endsection

{{-- Breadcrumb --}}
@section('breadcrumb')
    <h2 class="content-header-title float-left mb-0">Orders</h2>
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
                Orders
            </li>
        </ol>
    </div>
@endsection


    {{-- Content --}}
    @section('content')
     <!-- Start Todo Contents Section -->
    <main class="main-container simple-bar">
        <div class="text-right pb-2">
            <button class="btn btn-primary" data-toggle="modal" data-target="#customNotificationModal">
                Notification
            </button>
        </div>
        <Section class="cards-container" id="trelloMainSection"> 
            @include('admin.planning.trello_main')
        </section>
        <input type="hidden" id="planning_id" value="{{ $id }}">
    </main>
    <!-- End Todo Contents Section -->

    <!-- Card Block Details Modal -->
    <div class="modal modal--card-details fade" id="card-block-details-modal" tabindex="-1" aria-labelledby="card-block-details-modal-title" aria-hidden="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                {{-- <form action="#!" id="itemCoverChange">
                    <div class="modal-header" id="item_modal_header" style="background-image: url('https://studio.uxpincdn.com/studio/wp-content/uploads/2022/02/19-Best-Practices-for-Faster-UI-Mockups.png')">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <input type="file" class="attachments-block__uploader-input" name="cover_image" id="cover-image-uploader-input">
                        <input type="hidden" name="item_id" id="itemInputId">
                    </div>
                </form> --}}
                {{-- <form action="#!" id="itemAttechmentChange">
                        <input type="file" multiple class="attachments-block__uploader-input" name="attachments_list[]" id="attachments-uploader-input">
                        <input type="hidden" name="item_id" id="itemInputId2">
                </form> --}}
                <div class="modal-header">
                    <h5 class="modal-title">Order Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body p-0" id="itemModalBody">
                    {{-- @include('admin.todo.modal_body') --}}
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="customNotificationModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Custom Notification</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('custom.notification') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="form-group">
                                <label for="NotificationType">Notification Type</label>
                                <select name="type" id="NotificationType" class="select2 form-control bg-transparent">
                                    <option value="all">All Customer</option>
                                    <option value="spacific">Spacific Customer</option>
                                </select>
                            </div> 
                            <div class="form-group NotificationCustomerWrap" style="display: none">
                                <label for="NotificationCustomer">Customers</label>
                                <select name="user_id[]" id="NotificationCustomer" class="select2 form-control bg-transparent" multiple> 
                                    @foreach ($notifiable_users as $notifiable_user)
                                        <option value="{{ $notifiable_user->id }}">{{ $notifiable_user->name }}</option>
                                    @endforeach
                                </select>
                            </div> 
                            <div class="form-group">
                                <label for="title">Notification Title</label>
                                <input type="text" name="title" id="title" class="form-control" required>
                            </div> 
                            <div class="form-group">
                                <label for="body">Notification Body</label>
                                <textarea name="body" id="body" class="form-control" required></textarea>
                            </div> 
                        </div> 
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endsection

@push('js')
<script>
    function reusableDatePickerFunction(){
        document.querySelectorAll('input[type=date]').forEach(e => {
			flatpickr(e, {
				altInput: true,
				inline: true,
				minDate: e.getAttribute('min'),
				maxDate: e.getAttribute('max'),
				defaultDate: e.getAttribute('value'),
				altFormat: "F j, Y",
				dateFormat: 'Y-m-d',
                autoclose: true,
			});
		});
    }

    function reusableSimplebarFunction(){
        let simpleBar = $('.simple-bar');
        if(simpleBar.length){
            simpleBar.each((index, element) => new SimpleBar(element, { autoHide: false }));
        }
    }

    function reusableRangeDatePickerFunction(){
        let rangeDatePicker = $('.custom_range_datepicker');
        if(rangeDatePicker.length){
            rangeDatePicker.each(function(){
                let $rangeDatePickerElement = $(this);
                $rangeDatePickerElement.flatpickr({
                    altInput: true,
                    inline: true,
                    mode: "range",
                    enableTime: true,
                    altFormat: "F j, Y H:i",
                    time_24hr: true,
                });
            });
        }
    }

    function reusableSortableJSFunction(){
        let cardBlockBody = $('.card-element__body');
        let cardElementBody = $('.cards-container');
        let order = [];
        let order2 = [];
        if(cardBlockBody.length){
            cardBlockBody.each(function(){
                let $cardBlockBodyElement = $(this);
                $cardBlockBodyElement.sortable({
                    group: 'inner_list',
                    draggable: ".card-block",
                    animation: 200,
                    ghostClass: 'card-block__drag-shadow',
                    dragClass: 'card-block__dragging',
                    onEnd: function(e){
                        let item_id = $(e.item).closest(".card-element").attr("data-id");
                        $(e.item).closest(".card-element").find('.card-block').each(function(index, element){
                            order.push({
                                id          : $(this).attr('data-id'),
                                position    : index+1,
                            });
                        });
                        $.ajax({
                            type:"post",
                            url: "{{ route('trello.item.drag') }}",
                            data : {
                                order:order,
                                item : item_id,
                                // work : $('#planning_id').val(),
                            },
                            success: function(res){
                                $('#trelloMainSection').html(res);
                                reusableSortableJSFunction();
                                reusableMembersAssignSelectFunction();
                                $('[data-toggle="tooltip"]').tooltip();
                            }

                        });
                    },
                });
            });
        }
        if(cardElementBody.length){
            cardElementBody.each(function(){
                let $cardElementBodyElement = $(this);
                $cardElementBodyElement.sortable({
                    group: 'outer_list',
                    draggable: ".card-element",
                    animation: 200,
                    ghostClass: 'card-block__drag-shadow',
                    dragClass: 'card-block__dragging',
                    onEnd: function(e){
                        $(".cards-container .card-element").each(function(index, element){
                            order2.push({
                                id          : $(this).attr('data-id'),
                                position    : index+1,
                            });
                        });

                        $.ajax({
                            type:"post",
                            url: "{{ route('trello.element.drag') }}",
                            data : {
                                order:order2,
                            },
                            success: function(res){
                                reusableSortableJSFunction();
                                $('[data-toggle="tooltip"]').tooltip();
                            }

                        });
                    },
                });
            });
        }
    }

    function orderRender(){
        $.ajax({
            type:"post",
            url: "{{ route('order.event') }}",
            success: function(res){
                $('#trelloMainSection').html(res);
                reusableSortableJSFunction();
                reusableMembersAssignSelectFunction();
                $('[data-toggle="tooltip"]').tooltip();
            }
        });
    }

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

    function imagesPreviewFunction (input, placeToInsertImagePreview) {
        if (input.files) {
            let filesAmount = input.files.length;
            for (i = 0; i < filesAmount; i++) {
                let reader = new FileReader();
                reader.onload = function(event) {
                    let createPostedImageElement;
                    if(event.target.fileType.includes("image/")){
                        createPostedImageElement = `
                        <article class="attachments-block__card d-flex rounded">
                            <div class="attachments-block__card__head d-flex align-items-center justify-content-center overflow-hidden flex-shrink-0">
                                <img src="${event.target.result}" alt="attachment image" class="attachments-block__card__head__image w-100 h-100">
                            </div>
                            <div class="attachments-block__card__body flex-grow-1">
                                <h4 class="attachments-block__card__body__title">
                                    <a href="#!" target="_blank" class="attachments-block__card__body__title__text">${event.target.fileName}</a>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-up-right"><line x1="7" y1="17" x2="17" y2="7"></line><polyline points="7 7 17 7 17 17"></polyline></svg>
                                </h4>
                                <a href="${event.target.result}" download="download-attachment-file" target="_blank" class="attachments-block__card__btn attachments-block__card__btn--download btn btn-sm rounded-sm btn-flat-secondary waves-effect">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-download"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                                    Download
                                </a>
                                <button type="button" class="attachments-block__card__btn attachments-block__card__btn--remove btn btn-sm rounded-sm btn-flat-secondary waves-effect">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                    Delete
                                </button>
                            </div>
                        </article>
                        `;
                    }else{
                        createPostedImageElement = `
                        <article class="attachments-block__card d-flex rounded">
                            <div class="attachments-block__card__head d-flex align-items-center justify-content-center overflow-hidden flex-shrink-0">
                                <span class="attachments-block__card__head__text font-weight-bold">${event.target.fileName.split(".").pop()}</span>
                            </div>
                            <div class="attachments-block__card__body flex-grow-1">
                                <h4 class="attachments-block__card__body__title">
                                    <span class="attachments-block__card__body__title__text">${event.target.fileName}</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-up-right"><line x1="7" y1="17" x2="17" y2="7"></line><polyline points="7 7 17 7 17 17"></polyline></svg>
                                </h4>
                                <a href="${event.target.result}" download="download-attachment-file" target="_blank" class="attachments-block__card__btn attachments-block__card__btn--download btn btn-sm rounded-sm btn-flat-secondary waves-effect">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-download"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                                    Download
                                </a>
                                <button type="button" class="attachments-block__card__btn attachments-block__card__btn--remove btn btn-sm rounded-sm btn-flat-secondary waves-effect">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                    Delete
                                </button>
                            </div>
                        </article>
                        `;
                    }
                    $($.parseHTML(createPostedImageElement)).appendTo(placeToInsertImagePreview);
                }
                reader.fileType = input.files[i].type;
                reader.fileName = input.files[i].name;
                reader.readAsDataURL(input.files[i]);
            }
        }
    };

    function coverPreviewFunction (input, item) {
        if (input.files) {
            let readerData = new FileReader();
            readerData.onload = function(e){
                $("#item_modal_header").css("background-image", `url(${e.target.result})`);
                $("#itemCoverPhoto"+item).removeClass("d-none");
                $("#itemCoverPhoto"+item).css("background-image", `url(${e.target.result})`);
            }
            readerData.readAsDataURL(input.files[0]);
        }
    };

    $(document).ready(function (){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        setInterval(() => {
            orderRender()
        }, 1500);

        var currentOpenModalToggler;

        reusableSortableJSFunction();
        reusableDatePickerFunction();
        reusableRangeDatePickerFunction();
        reusableSimplebarFunction();

        /* Call Select2 Members Assign Select function */
        reusableMembersAssignSelectFunction();

        /* Custom Dropdown functions */
		$(document).on("change", "#NotificationType", function() {
            console.log($(this).val());
            if($(this).val() == 'spacific'){
                $('.NotificationCustomerWrap').slideDown();
            }else{
                $('.NotificationCustomerWrap').slideUp();
            }
        });
		$(document).on("click", ".dropdown--keepopen .dropdown-menu", function (e) {
            e.stopPropagation();
        });

		$(document).on("click", ".dropdown-menu__close", function () {
            $(this).closest(".dropdown--keepopen").find(".dropdown-toggle").dropdown('hide');
        });

        /* Card Elements Title Edit functions */
        // $(document).on("click", ".card-element__header__title", function(){
        //     $(".card-element__header__title").attr('readonly', 'readonly');
        //     $(this).prop('readonly', false);
        // });
        // $(document).on("blur", ".card-element__header__title", function(){
        //     var data = $(this).val();
        //     var id = $(this).attr('data-id');
        //     if(data){
        //         $.ajax({
        //         type: "post",
        //             url: "{{ route('trello.title.update') }}",
        //             data: {
        //                 id: id,
        //                 title: data,
        //             },
        //             success: function (response) {
        //                 console.log(response);
        //                 $('[data-toggle="tooltip"]').tooltip();
        //             },
        //             error: function (response) {

        //             }
        //         });
        //     }
        // });
        // $(document).on("click", function(e){
        //     if(e.target.classList.contains("card-element__header__title")){
        //         e.preventDefault();
        //     }else{
        //         $(".card-element__header__title").attr('readonly', 'readonly');
        //     }
        // });

        /* Add Card Block function */
        $(document).on("click", ".add--card-block", function(){
            $(this).closest(".card-element").find(".card-element__footer__bottom").addClass("d-none");
            $(this).closest(".card-element").find(".card-element__footer__top").removeClass("d-none");
        });

        /* Create Form Remove function */
        $(document).on("click", ".create-form__btn--remove", function(){
            $(this).closest(".card-element__create-form").trigger("reset");
            $(this).closest(".card-element__create-form").find(".select2").trigger("change");
            $(this).closest(".card-element__footer__top").addClass("d-none");
            $(this).closest(".card-element__footer").find(".card-element__footer__bottom").removeClass("d-none");
        });

        /* Remove Card Element function */
        $(document).on("click", ".remove--card-element", function(){
            var id = $(this).attr('data-id');
            var thisClick = $(this);
            $.ajax({
                type: "post",
                url: "{{ route('trello.remove') }}",
                data: {
                    id: id,
                },
                success: function (response) {
                    thisClick.closest(".card-element").remove();
                    $('[data-toggle="tooltip"]').tooltip();
                },
                error: function (response) {

                }
            });
        });

        /* Add Card Element function */
        $("body").on("click", '.add--card-element', function(){
            var title = 'Task List Title';
            $.ajax({
                type: "post",
                url: "{{ route('trello.add.new') }}",
                data: {
                    title: title,
                    planning_id: $('#planning_id').val(),
                },
                success: function (response) {
                    console.log(response);
                    let newCardElement = `
                    <article class="card-element" data-id="`+response.id+`">
                        <header class="card-element__header">
                            <textarea class="card-element__header__title" rows="1" readonly="readonly" data-id="`+response.id+`">`+ title +`</textarea>
                            <div class="dropdown">
                                <button class="btn btn-icon btn-flat-secondary waves-effect dropdown-toggle  hide-arrow dropdown-toggle--no-icon" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <button type="button" class="dropdown-item add--card-block">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus dropdown-item__icon"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                        Add Card
                                    </button>
                                    <button type="button" class="dropdown-item remove--card-element" data-id="`+response.id+`">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 dropdown-item__icon"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                        Remove Card
                                    </button>
                                </div>
                            </div>
                        </header>
                        <main class="card-element__body"  id="trelloItemBlock`+response.id+`">
                        </main>
                        <footer class="card-element__footer">
                            <div class="card-element__footer__top d-none">
                                <form action="#!" class="card-element__create-form">
                                    <div class="card-element__create-form__header">
                                        <div class="form-group">
                                            <textarea name="create_card_title" class="form-control" rows="2" placeholder="Enter a title for this card…" id="trello_item_title`+response.id+`"></textarea>
                                        </div>
                                        <div class="form-group mb-0">
                                            <select name="assignee[]" class="select2 form-control bg-transparent members-assign-select" data-placeholder="Add Members" multiple="multiple" tabindex="-1" aria-hidden="true"  id="trello_item_member`+response.id+`">
                                                @foreach ($users as $user)
                                                    @if ($user->profile_photo_url)
                                                    <option data-img="{{ $user->profile_photo_url }}" value="{{ $user->id }}">{{ $user->name }}</option>
                                                    @else
                                                    <option data-img="{{ asset('uploads/default.png') }}" value="{{ $user->id }}">{{ $user->name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="card-element__create-form__footer d-flex flex-wrap">
                                        <button type="button" class="btn btn-success waves-effect waves-float waves-light add_item_card_btn"  data-id="`+response.id+`">Add Card</button>
                                        <button type="button" class="create-form__btn create-form__btn--remove btn btn-icon btn-flat-danger waves-effect" id="itemFromCloseBtn`+response.id+`">
                                            <svg class="create-form__btn__icon" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="card-element__footer__bottom">
                                <button type="button" class="btn btn-block btn-flat-secondary waves-effect add--card-block">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus btn__icon"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                    Add a card
                                </button>
                            </div>
                        </footer>
                    </article>
                    `;
                    $(".add--card-element").before(newCardElement);
                    reusableMembersAssignSelectFunction();
                    reusableSortableJSFunction();
                    $('[data-toggle="tooltip"]').tooltip();
                },
                error: function (response) {

                }
            });
        });

        /* Click Card Block function */
        $(document).on("click", ".card-block", function(){
            var id = $(this).attr('data-id');
            // var cover_path = $('#itemCoverPhoto'+id).attr('style');
            // if(cover_path){
            //     $('#item_modal_header').addClass('modal-header--has-cover');
            // }else{
            //     $('#item_modal_header').removeClass('modal-header--has-cover');
            // }
            // $('#item_modal_header').attr('style', cover_path);
            // $('#itemInputId').val(id);
            // $('#itemInputId2').val(id);

            // $($(this).attr("data-target") + " .card-details__heading__title").text($(this).find(".card-block__title").text());
            $.ajax({
                    type: "post",
                    url: "{{ route('item.modal.show') }}",
                    data: {
                        id: id,
                    },
                    success: function (response) {
                        $('#itemModalBody').html(response.data);
                        $('#card-block-details-modal').modal('show');
                        // reusableRangeDatePickerFunction();
                        // reusableDatePickerFunction();
                        // reusableSimplebarFunction();
                        // $('[data-toggle="tooltip"]').tooltip();
                },
                error: function (response) {
                }
            });
        });

        /* Card Details Heading function */
        $(document).on("click", ".card-details__heading__title", function(){
            $(this).addClass("d-none");
            $(this).siblings(".card-details__heading__edit-title").val($(this).text());
            $(this).siblings(".card-details__heading__edit-title").removeClass("d-none");
            $(this).siblings(".card-details__heading__edit-title").focus();
        });

        /* Card Details Heading Edit function */
        $(document).on("blur", ".card-details__heading__edit-title", function(e){
            var id = $(this).attr('data-id');
            var data = $(this).val();
            if($.trim(data) !== ""){
                $.ajax({
                    type: "post",
                    url: "{{ route('item.title.update') }}",
                    data: {
                        id: id,
                        title: data,
                    },
                    success: function (response) {
                        console.log(response);
                        $('.block_item_title'+id).text(data);
                        $('[data-toggle="tooltip"]').tooltip();
                    },
                    error: function (response) {
                    }
                });
                $(this).addClass("d-none");
                $(this).siblings(".card-details__heading__title").text($(this).val());
                $(this).siblings(".card-details__heading__title").removeClass("d-none");
            }else{
                e.preventDefault();
            }
        });

        /* Card Description Toggler function */
        $(document).on("click", ".description-block__edit-toggler", function(){
            $(this).addClass("d-none");
            $(this).siblings(".description-block__edit").removeClass("d-none");
            $(this).siblings(".description-block__edit").find(".description-block__edit__input").focus();
        });

        /* Card Description Edit function */
        $(document).on("blur", ".description-block__edit__input", function(){

            var id = $(this).attr('data-id');
            var data = $(this).val();
            if($.trim(data) !== ""){
                $.ajax({
                    type: "post",
                    url: "{{ route('item.description.update') }}",
                    data: {
                        id: id,
                        description: data,
                    },
                    success: function (response) {
                        console.log(response);
                        $('#itemIconBlock'+id).html(response);
                        $('[data-toggle="tooltip"]').tooltip();
                    },
                    error: function (response) {
                    }
                });
                $(this).parent(".description-block__edit").addClass("d-none");
                $(this).parent(".description-block__edit").siblings(".description-block__details-text").text($(this).val());
                $(this).parent(".description-block__edit").siblings(".description-block__details-text").removeClass("d-none");
                $(this).closest(".description-block__right").find(".description-block__update-toggler").removeClass("d-none");
            }else{
                $(this).parent(".description-block__edit").addClass("d-none");
                $(this).parent(".description-block__edit").siblings(".description-block__edit-toggler").removeClass("d-none");
            }
        });

        /* Card Description Text Edit function */
        $(document).on("click", ".description-block__details-text", function(){
            $(this).addClass("d-none");
            $(this).siblings(".description-block__edit").removeClass("d-none");
            $(this).siblings(".description-block__edit").find(".description-block__edit__input").val($(this).text());
            $(this).siblings(".description-block__edit").find(".description-block__edit__input").focus();
            if(!$(this).siblings(".description-block__edit").hasClass("d-none")){
                $(this).closest(".description-block__right").find(".description-block__update-toggler").addClass("d-none");
            }
        });

        /* Card Description Text Update function */
        $(document).on("click", ".description-block__update-toggler", function(){
            $(this).addClass("d-none");
            $(this).closest(".description-block__right").find(".description-block__details-text").addClass("d-none");
            $(this).closest(".description-block__right").find(".description-block__edit").removeClass("d-none");
            $(this).closest(".description-block__right").find(".description-block__edit .description-block__edit__input").focus();
        });

        /* Attachments Uploader Input function */
        $(document).on("change", "#attachments-uploader-input", function() {

            let item = $('#itemInputId').val();
            let form_eletemnt = new FormData(document.getElementById("itemAttechmentChange"));

            $.ajax({
                type : "post",
                url  : "{{ route('item.attechment.update') }}",
                data : form_eletemnt,
                contentType: false,
                processData: false,
                success: function(response){
                    $('#itemActivityBlock'+item).html(response.activity);
                    $('#itemAttachment'+item).html(response.attachment);
                    $('#itemIconBlock'+item).html(response.item_icon);
                    $(".attachments-block").removeClass("d-none");
                    $('[data-toggle="tooltip"]').tooltip();
                },

            });

            // imagesPreviewFunction(this, ".attachments-block__list");
            // if($(".attachments-block__list").children().length > -1){
            //     $(".attachments-block").removeClass("d-none")
            // }
        });

        /* Attachments File Preview Delete function */
        $(document).on("click", ".attachments-block__card__btn--remove", function(){
            let id = $(this).attr('data-id');
            let item = $('#itemInputId').val();
            let thisAction = this;
            $.ajax({
                type: 'post',
                url : "{{ route('item.attachment.remove') }}",
                data: {
                    id : id,
                    item : item,
                },
                success : function (response) {
                    $('#itemActivityBlock'+item).html(response.data);
                    $('#itemIconBlock'+item).html(response.item_icon);
                    $(thisAction).closest(".attachments-block__card").remove();
                    if($(".attachments-block__list").children().length <= 0){
                        $(".attachments-block").addClass("d-none");
                        $('[data-toggle="tooltip"]').tooltip();
                    }
                 },
            });

        });

        /* Checklist Block Title Edit function */
        $(document).on("click", ".checklist-block__edit__title", function(){
            $(this).closest(".checklist-block__edit__header").addClass("d-none");
            $(this).closest(".checklist-block__edit__header").siblings(".checklist-block__edit__input").removeClass("d-none");
            $(this).closest(".checklist-block__edit__header").siblings(".checklist-block__edit__input").val($(this).text());
            $(this).closest(".checklist-block__edit__header").siblings(".checklist-block__edit__input").focus();
        });

        /* Checklist Block Title Input Edit function */
        $(document).on("blur", ".checklist-block__edit__input", function(e){
            let thisAction = this;
            let id = $(this).attr('data-id');
            let data = $(this).val();
            console.log('asi');
            if($.trim(data) !== ""){
                $.ajax({
                    type: "post",
                    url : "{{ route('checklist.title.update') }}",
                    data: {
                        id   : id,
                        data : data,
                    },
                    success: function (response) {
                        $(thisAction).addClass("d-none");
                        $(thisAction).siblings(".checklist-block__edit__header").find(".checklist-block__edit__title").text($(thisAction).val());
                        $(thisAction).siblings(".checklist-block__edit__header").removeClass("d-none");
                        $('[data-toggle="tooltip"]').tooltip();
                     },
                })
            }else{
                e.preventDefault();
            }
        });

        /* Delete Checklist Block function */
        $(document).on("click", ".checklist-block__remove-btn", function(){
            let id = $(this).attr('data-id');
            let item = $('#itemInputId').val();
            let thisAction = this;
            $.ajax({
                type : "post",
                url  : "{{ route('item.checklist.remove') }}",
                data : {
                    id : id,
                    item : item,
                },
                success: function (response) {
                    $(thisAction).closest(".checklist-block").remove();
                    $('#itemIconBlock'+item).html(response);
                    $('[data-toggle="tooltip"]').tooltip();
                 },
            })
        });

        /* Sub Category Checklist Title Edit function */
        $(document).on("click", ".checklist-block__sub-category__list__title", function(){
            $(this).addClass("d-none");
            $(this).closest(".checklist-block__sub-category__list").removeClass("align-items-center");
            $(this).closest(".checklist-block__sub-category__list").addClass("align-items-start");
            $(this).siblings(".checklist-block__sub-category__list__edit-title-input").removeClass("d-none");
            $(this).siblings(".checklist-block__sub-category__list__edit-title-input").val($(this).text());
            $(this).siblings(".checklist-block__sub-category__list__edit-title-input").focus();
        });

        /* Sub Category Checklist Title Input Edit function */
        $(document).on("blur", ".checklist-block__sub-category__list__edit-title-input", function(e){
            let thisAction = this;
            let id  = $(this).attr('data-id');
            let data = $(this).val();

            if($.trim(data) !== ""){
                $.ajax({
                    type : "post",
                    url  : "{{ route('checklist.item.title.update') }}",
                    data : {
                        id : id,
                        title : data,
                    },
                    success: function (response) {
                        console.log(response);
                        $(thisAction).addClass("d-none");
                        $(thisAction).closest(".checklist-block__sub-category__list").addClass("align-items-center");
                        $(thisAction).closest(".checklist-block__sub-category__list").removeClass("align-items-start");
                        $(thisAction).siblings(".checklist-block__sub-category__list__title").text($(thisAction).val());
                        $(thisAction).siblings(".checklist-block__sub-category__list__title").removeClass("d-none");
                        $('[data-toggle="tooltip"]').tooltip();
                     },
                });
            }else{
                e.preventDefault();
            }
        });

        /* Progressbar & Checklist function */
        $(document).on("change", ".checklist-block__sub-category__list__checkbox", function() {
            let status,
             id = $(this).attr('data-id'),
             checklist = $(this).attr('data-checklist');
             let item = $('#itemInputId').val();
            if($(this).is(":checked")){
                $(this).closest(".checklist-block__sub-category__list").addClass("checked");
                status = 1;
            }else{
                $(this).closest(".checklist-block__sub-category__list").removeClass("checked");
                status = 0;
            };
            $.ajax({
                type : 'post',
                url  : "{{ route('checklist.item.check') }}",
                data : {
                    id : id,
                    item : item,
                    checklist : checklist,
                    status : status,
                },
                success : function (response) {
                    $('#checklistProgressbar'+checklist).html(response.data);
                    $('#itemIconBlock'+item).html(response.item_icon);
                    $('[data-toggle="tooltip"]').tooltip();
                 },
            });
        });

        /* Delete Sub-Category Checklist List function */
        $(document).on("click", ".checklist-block__sub-category__list__remove-btn", function(){

            let id = $(this).attr('data-id');
            let item = $('#itemInputId').val();
            let checklist = $(this).attr('data-checklist');
            $.ajax({
                type : 'post',
                url  : "{{ route('checklist.item.remove') }}",
                data : {
                    id : id,
                    item : item,
                    checklist : checklist,
                },
                success : function (response) {
                    $('#checklistProgressbar'+checklist).html(response.data);
                    $('#itemIconBlock'+item).html(response.item_icon);
                    $('[data-toggle="tooltip"]').tooltip();
                 },
            });

            $(this).closest(".checklist-block__sub-category__list").remove();
        });

        /* Dropdown Menu Search function */
		$(document).on("input", ".dropdown-menu__body__search-input", function(){
			let searchValue = $(this).val().toLowerCase();
			$(this).closest(".dropdown-menu__body").find(".dropdown-menu__body__search-list li").filter(function(){
				$(this).toggle($(this).text().toLowerCase().indexOf(searchValue) > -1);
			});
		});

		/* New Label Create Toggler Button function */
		$(document).on("click", ".dropdown-menu__label-create-toggle-btn", function(){
			$(this).closest(".dropdown-menu__card").addClass("d-none");
			$(this).closest(".dropdown-menu__card").siblings(".dropdown-menu__card--create-labels").removeClass("d-none");
		});

		/* Dropdown Menu Card Back Button function */
		$(document).on("click", ".dropdown-menu__card__back-btn", function(){
			$(this).closest(".dropdown-menu__card").addClass("d-none");
			$(this).closest(".dropdown-menu__card").siblings(".dropdown-menu__card--labels").removeClass("d-none");
		});

		/* New Label Add Button function */
		$(document).on("click", ".dropdown-menu__label-create-add-btn", function(){
            let item = $(this).attr('data-id');
            let label_name =$(this).closest('.dropdown-menu__body').find('[name=labels_name]');
            let lavel_color =$(this).closest('.dropdown-menu__body').find('[name=labels_color]');
            let this_action = $(this);
            if(label_name.val()){
                $.ajax({
                    type: "post",
                    url: "{{ route('trello.label.create') }}",
                    data: {
                        id  : item,
                        name: label_name.val(),
                        bg_color: lavel_color.val(),
                    },
                    success: function (response) {
                        $('.itemLabelBlock').html(response);
                        // $('.itemLabelBlock2').html(response);
                        // $('#itemMemberBlock'+item).html(response.data1);
                        // $('#TrelloItemMemberBlock'+item).html(response.data2);
                        // $('#itemFromCloseBtn'+id).click();
                        console.log(response);
                        label_name.val('');
                        lavel_color.val('#75dab4');
                        this_action.closest(".dropdown-menu__card").addClass("d-none");
                        this_action.closest(".dropdown-menu__card").siblings(".dropdown-menu__card--labels").removeClass("d-none");
                        $('[data-toggle="tooltip"]').tooltip();
                    },
                    error: function (response) {

                    }
                });

            }

		});

		/* Remove Select Label List Item function */
		$(document).on("click", ".select-labels-list__item__remove-btn", function(){
            let item = $(this).attr('data-item');
            let id = $(this).attr('data-id');
            $.ajax({
                type: "post",
                url: "{{ route('trello.label.remove') }}",
                data: {
                    id: id,
                    item: item,
                },
                success: function (response) {
                    $('.itemLabelBlock').html(response);
                    $('.itemSelectedLabel').html(response.data2);
                    $('#TrelloItemLabel'+item).html(response.data3);
                    $('[data-toggle="tooltip"]').tooltip();
                },
                error: function (response) {

                }
            });

            $(this).closest(".select-labels-list__item").remove();
		});

        /* Close Dropdown Menu Create Label Card function */
        $(document).on("click", ".dropdown-menu__card--create-labels .dropdown-menu__close", function(){
            $(this).closest(".dropdown-menu__card").addClass("d-none");
            $(this).closest(".dropdown-menu__card").siblings(".dropdown-menu__card--labels").removeClass("d-none");
        });

        /* Close Dropdown Menu Date Select Card On Save function */
        $(document).on("click", ".dropdown-menu__card__save-date__btn", function () {
            let id = $(this).attr('data-id');
            let date = $(this).closest('.dropdown-menu__body').find('[name=dates]').val();
            let thisAction = this;
            $.ajax({
                type: 'post',
                url: "{{ route('item.date.update') }}",
                data: {
                    id    : id,
                    dates : date,
                },
                success: function (response) {
                    $(thisAction).closest(".dropdown--keepopen").find(".dropdown-toggle").dropdown('hide');
                    $('.custom_range__updated_date').val(date);
                    $('#itemDateShow'+id).html(response.data);
                    $('.dropdown-menu__card_date_block'+id).html(response.date);
                    $('#itemDateBlock'+id).removeClass('d-none');
                    reusableRangeDatePickerFunction();
                    reusableDatePickerFunction();
                    reusableSimplebarFunction();
                    $('[data-toggle="tooltip"]').tooltip();
                 },
            });
        });

        /* Cover Image Uploader Input function */
        $(document).on("change", "#cover-image-uploader-input", function() {
            let item = $('#itemInputId').val();
            let thisAction = this;
            let form_data = new FormData(document.getElementById("itemCoverChange"));

            $.ajax({
                type : "post",
                url  : "{{ route('item.cover.update') }}",
                data : form_data,
                contentType: false,
                processData: false,
                success: function(response){
                 coverPreviewFunction(thisAction, item);
                 $('#item_modal_header').addClass('modal-header--has-cover');
                 $('[data-toggle="tooltip"]').tooltip();
                },
                error: function (err) {
                    console.log(err);
                 },

            });
        });

        // add new item
        $(document).on('click', '.add_item_card_btn', function(){
            var id = $(this).attr('data-id');
            var title = $('#trello_item_title'+id).val();
            var members = $('#trello_item_member'+id).val();
            if(title){
                $.ajax({
                    type: "post",
                    url: "{{ route('trello.add.item') }}",
                    data: {
                        id: id,
                        title : title,
                        members : members,
                        planning_id : $('#planning_id').val(),
                    },
                    success: function (response) {
                        $('#trelloItemBlock'+id).html(response);
                        $('#itemFromCloseBtn'+id).click();
                        $('[data-toggle="tooltip"]').tooltip();
                },
                error: function (response) {

                }
            });
            }
        });

        // Update Member
        $(document).on('click', '.select-member-block__input_id', function(){
            let item = $(this).attr('data-id');
            let trello_id = $(this).attr('data-trello-id');
            let array_id = [];

            $('.select-member-block__input_id:checked').each(function(){
                array_id.push($(this).val());
            });

            $.ajax({
                    type: "post",
                    url: "{{ route('trello.member.update') }}",
                    data: {
                        id: item,
                        trello_id: trello_id,
                        members : array_id,
                        planning_id : $('#planning_id').val(),
                    },
                    success: function (response) {
                        $('#itemMemberBlock'+item).html(response.data1);
                        $('#TrelloItemMemberBlock'+item).html(response.data2);
                        $('.select-members-list_users'+item).html(response.users)
                        $('.select-members-list_users2'+item).html(response.users2)
                        $('[data-toggle="tooltip"]').tooltip();
                        // $('#itemFromCloseBtn'+id).click();
                },
                error: function (response) {

                }
            });

        });
        // Update Member 2
        $(document).on('click', '.select-member-block__input_id2', function(){
            let item = $(this).attr('data-id');
            let trello_id = $(this).attr('data-trello-id');
            let array_id = [];

            $('.select-member-block__input_id2:checked').each(function(){
                array_id.push($(this).val());
            });
            if(array_id.length > 0){
                $('#memberBlock'+item).removeClass('d-none');
            }else{
                $('#memberBlock'+item).addClass('d-none');
            }

            $.ajax({
                    type: "post",
                    url: "{{ route('trello.member.update') }}",
                    data: {
                        id: item,
                        trello_id: trello_id,
                        members : array_id,
                        planning_id : $('#planning_id').val(),
                    },
                    success: function (response) {
                        $('#itemMemberBlock'+item).html(response.data1);
                        $('#TrelloItemMemberBlock'+item).html(response.data2);
                        $('.select-members-list_users'+item).html(response.users)
                        $('.select-members-list_users2'+item).html(response.users2)
                        $('[data-toggle="tooltip"]').tooltip();
                        // $('#itemFromCloseBtn'+id).click();
                },
                error: function (response) {

                }
            });

        });

        // Update Member 2
        $(document).on('click', '.select-label-block__input', function(){
            let item = $(this).attr('data-id');
            let array_lavel_id = [];

            $(this).closest('.select-labels-list').find('.select-label-block__input:checked').each(function(){
                array_lavel_id.push($(this).val());
            });
            if(array_lavel_id.length > 0){
                $('#itemLabelBlock'+item).removeClass('d-none');
            }else{
                $('#itemLabelBlock'+item).addClass('d-none');
            }

            $.ajax({
                    type: "post",
                    url: "{{ route('trello.label.update') }}",
                    data: {
                        id: item,
                        labels : array_lavel_id,
                    },
                    success: function (response) {
                        $('.itemLabelBlock').html(response.data1);
                        // $('.itemLabelBlock2').html(response.data1);
                        $('.itemSelectedLabel').html(response.data2);
                        $('#TrelloItemLabel'+item).html(response.data3);
                        $('[data-toggle="tooltip"]').tooltip();
                },
                error: function (response) {

                }
            });

        });

        // add checklist
        $(document).on('click', '#checklist_title_btn', function(){
            let item = $('#itemInputId').val();
            let title = $('#checklist_title').val();
                if(title){
                    $.ajax({
                        type : "post",
                        url  : "{{ route('item.checklist.store') }}",
                        data : {
                            item_id  : item,
                            title    : title,
                        },
                        success: function(response){
                            $('#checklist_title').val('');
                            $('.dropdown-menu__close').click();
                            $('#itemChecklist'+item).html(response.data);
                            $('#itemIconBlock'+item).html(response.item_icon);
                            $('[data-toggle="tooltip"]').tooltip();

                        },
                        error: function(error){
                            console.log(error);
                        }
                    });
                }
        });

        // add checklist
        $(document).on('click', '.checklist__sub-category__add-btn', function(){
            let id = $(this).attr('data-id');
            let item = $('#itemInputId').val();
            $.ajax({
                type : 'post',
                url  : "{{ route('checklist.item.store') }}",
                data : {
                    checklist_id : id,
                    title : 'item title',
                    item : item,
                },
                success : function (response) {

                    $('#checklistItem'+id).html(response.data);
                    $('#checklistProgressbar'+id).html(response.view);
                    $('#itemIconBlock'+item).html(response.item_icon);
                    reusableDatePickerFunction();
                    reusableSimplebarFunction();
                    $('[data-toggle="tooltip"]').tooltip();
                 },
            });
        });

        // Update Checklist Member
        $(document).on('click', '.select-member-block__input_checklist', function(){
            let id = $(this).attr('data-id');
            let member = $(this).val();
            $.ajax({
                    type: "post",
                    url: "{{ route('checklist.item.member.update') }}",
                    data: {
                        id: id,
                        member : member,
                    },
                    success: function (response) {
                        $('#checklist_item_member_image'+id).html(response);
                        $('[data-toggle="tooltip"]').tooltip();
                },
                error: function (response) {

                }
            });

        });

        // Update Checklist due date
        $(document).on('change', '.change_checklist_due_date', function(){
            let id = $(this).attr('data-id');
            let date = $(this).val();
            $.ajax({
                    type: "post",
                    url: "{{ route('checklist.item.date.update') }}",
                    data: {
                        id: id,
                        date : date,
                    },
                    success: function (response) {
                        $('#checklistDateSelect'+id).removeClass('btn-secondary-light');
                        $('#checklistDateSelect'+id).addClass('btn-success');
                        $('#checklistDateSelect'+id).html(response);
                        console.log(response);
                        $('[data-toggle="tooltip"]').tooltip();
                },
                error: function (response) {

                }
            });

        });

        // Update item status
        $(document).on('click', '.item_status_change_btn', function(){
            let id = $(this).attr('data-id');
            let status = $(this).attr('data-status');
            if(status == '0'){
                $("#itemIncompleteBtn"+id).removeClass('d-none');
                $("#itemCompleteBtn"+id).addClass('d-none');
            }else{
                $("#itemIncompleteBtn"+id).addClass('d-none');
                $("#itemCompleteBtn"+id).removeClass('d-none');
            }
            $.ajax({
                    type: "post",
                    url: "{{ route('item.status.update') }}",
                    data: {
                        id: id,
                        status : status,
                        planning_id : $('#planning_id').val(),
                    },
                    success: function (response) {
                        $('#itemIconBlock'+id).html(response);
                        $('[data-toggle="tooltip"]').tooltip();
                },
                error: function (response) {

                }
            });

        });

        // Item Activity
        $(document).on('click', '.comment_save_btn', function(){
            let id = $(this).attr('data-id');
            let comment = $(this).closest('.activity-block__comment-wrapper').find('.item_comment');
            if(comment.val()){
                $.ajax({
                    type: "post",
                    url: "{{ route('item.activity.store') }}",
                    data: {
                        id: id,
                        comment : comment.val(),
                    },
                    success: function (response) {
                        $('#itemActivityBlock'+id).html(response.data);
                        $('#itemIconBlock'+id).html(response.item_icon);
                        $('[data-toggle="tooltip"]').tooltip();
                        comment.val('');
                        console.log(response);
                    },
                    error: function (response) {

                    }
                });
            }


        });


        // Item Activity delete
        $(document).on('click', '.item_activity_delete_btn', function(){
            let id = $(this).attr('data-id');
            let item = $('#itemInputId').val();
            $.ajax({
                type: "post",
                url: "{{ route('item.activity.delete') }}",
                data: {
                    id: id,
                    item : item,
                },
                success: function (response) {
                    $('#itemActivityBlock'+item).html(response.data);
                    $('#itemIconBlock'+item).html(response.item_icon);
                    $('[data-toggle="tooltip"]').tooltip();
                    console.log(response);
                },
                error: function (response) {

                }
            });

        });

    });
</script>
@endpush
