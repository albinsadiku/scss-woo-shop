jQuery(document).ready(function($) {
    $('form').on('submit', function(event) {
        event.preventDefault();

        var data = {
            action: 'my_ajax_action',
            // add any data that you want to pass to the server as key-value pairs here
        };

        $.ajax({
            type: 'POST',
            url: ajaxurl,
            data: data,
            success: function(response) {
                // handle the server's response here
            },
            error: function(xhr, textStatus, errorThrown) {
                console.log(xhr.responseText);
            }
        });
    });
});