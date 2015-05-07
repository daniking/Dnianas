var Dnianas = Dnianas || {};


// The default AJAX config.
$.ajaxSetup({
    type: 'POST',
    dataType: 'JSON',
});

// Some global variables
$loading = $('#ajax-loader'),
token = $('input[name=_token]').val(),
$body = $('body')
