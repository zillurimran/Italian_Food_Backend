$(function () {
    'use strict';

    $('.datatable').DataTable({
        dom: `<"row"
                <"col-12 pl-1" f>
                <"col-12 d-flex flex-wrap align-items-center justify-content-between"
                i
                <"d-flex flex-wrap align-items-center" l p>
                >
                <"col-12 px-0"
                <"table-responsive" t>
                >
                <"col-12 pr-1" p>
            >`,
        language: {
          lengthMenu: '_MENU_',
          zeroRecords: 'No Record Found',
          info: '<h4 class="mb-0">Total (_TOTAL_)</h4>',
          infoEmpty: 'Showing 0 entries',
          infoFiltered: '(filtered from total _MAX_ entries)',
          searchPlaceholder: 'Search...',
          search: '',
        },
        stateSave: true,
    })
  });
