window.jQuery.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': window.jQuery('meta[name="csrf-token"]').attr('content')
    }
});
window.jQuery(document).ajaxError(function (e, jqxhr, settings, exception) {
    toastr.error(jQuery.parseJSON(jqxhr.responseText).error.message);
});

function number_format(number) {
    let nf = Intl.NumberFormat();
    return nf.format(number);
}
