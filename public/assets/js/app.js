!function ($) {
    'use strict';

    $(function () {

        var cb_all_1 = $("#cb-all-1");
        cb_all_1.on('click', function () {
            $('input.cb-item-1:checkbox').not(this).prop('checked', this.checked);
        })
    });
}(jQuery);