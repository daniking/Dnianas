var Dnianas = Dnianas || {};


// The default AJAX config.
$.ajaxSetup({
    type: 'POST',
    dataType: 'JSON',
});

// Some global variables
var $loading = $('#ajax-loader'),
var token = $('input[name=_token]').val(),
var $body = $('body')
