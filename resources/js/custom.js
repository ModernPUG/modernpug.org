
window.jQuery.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': window.jQuery('meta[name="csrf-token"]').attr('content')
    }
});

$('#flash-overlay-modal').modal();
