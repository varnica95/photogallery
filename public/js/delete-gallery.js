$(document).ready(function () {

    $('.delete-gallery-form').on('submit', function (e){
        e.preventDefault();
        var id = (($(this).attr('id')).split('-'))[2]

        $.ajax({
            url : $(this).attr('action') || window.location.pathname,
            type: "POST",
            data: $(this).serialize(),
            success: function (data) {
                $('#gallery-card-' + id).remove();
            },
            error: function (jXHR, textStatus, errorThrown) {
                alert(errorThrown);
            }
        });

    });


});