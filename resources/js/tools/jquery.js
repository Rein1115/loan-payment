import $ from 'jquery';

$.ajaxSetup({
    headers: {
        'X-Requested-With': 'XMLHttpRequest',
    },
    beforeSend: function(xhr) {
        xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
    }
});

export const apiRequest = (options) => {
    return $.ajax({
        ...options,
        url: `${process.env.MIX_API_URL}${options.url}`,
    });
};