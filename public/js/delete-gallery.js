$(document).ready(function () {

    $('.delete-gallery-form').click(function (){
        var id = (($(this).attr('id')).split('-'))[2]
        var title =  $('#gallery-title-' + id).text();

        if(confirm('Are you sure you want to delete ' + title + '? All of its content will be removed.')) {
            deleteGallery(id)
        }else{
            return false;
        }
    });

});

function deleteGallery(id){
    $('.delete-gallery-form').on('submit', function (e){
        e.preventDefault();

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