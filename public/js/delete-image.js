$(document).ready(function () {

    $('.delete-image-form').click(function (){
        var id = (($(this).attr('id')).split('-'))[2]
        var title =  $('#image-title-' + id).text();

        if(confirm('Are you sure you want to delete ' + title + '?')) {
            deleteImage(id)
        }else{
            return false;
        }
    });

});

function deleteImage(id){
    $('.delete-image-form').on('submit', function (e){
        e.preventDefault();

        $.ajax({
            url : $(this).attr('action') || window.location.pathname,
            type: "POST",
            data: $(this).serialize(),
            success: function (data) {
                $('#image-card-' + id).remove();
            },
            error: function (jXHR, textStatus, errorThrown) {
                alert(errorThrown);
            }
        });

    });
}