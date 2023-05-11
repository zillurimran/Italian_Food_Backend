<div class="dropdown-menu__head d-flex align-items-center justify-content-between">
    <button type="button" class="btn btn-sm btn-icon btn-flat-secondary waves-effect btn--hidden">
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-left"><polyline points="15 18 9 12 15 6"></polyline></svg>
    </button>
    <h4 class="dropdown-menu__head__title mb-0">Dates</h4>
    <button type="button" class="dropdown-menu__close btn btn-sm btn-icon btn-flat-danger waves-effect">
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
    </button>
</div>
<div class="dropdown-menu__body">
    <div class="form-group">
        <label class="form-control-label w-100 mb-0">
            <span class="form-control-label__text">Date Range</span>
            <input type="datetime" name="dates" class="form-control custom_range_datepicker custom_range__updated_date" value="{{ $item->dates }}" placeholder="Select Date Range">
        </label>
    </div>
    <button type="button" class="dropdown-menu__card__save-date__btn btn btn-block btn-success waves-effect waves-float waves-light"  data-id="{{ $item->id }}">Save</button>
</div>