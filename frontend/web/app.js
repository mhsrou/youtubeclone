
$(function () {
    'use strict';
    $('#avatar').change(ev => {
        $(ev.target).closest('form').trigger('submit');
    })
});