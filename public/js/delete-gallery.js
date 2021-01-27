$(document).ready(function () {

    $('.delete-gallery-form').click(function (){

        if(confirm('Are you sure you want to delete this gallery? All of its content will be removed.')) {
            deleteGallery()
        }else{
            return false;
        }
    });

});

function deleteGallery(){
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
}