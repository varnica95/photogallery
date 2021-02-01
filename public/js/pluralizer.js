$(document).ready(function (){

    let pluralize = function (count, noun, prefix = 's'){
        if (noun == 'gallery' && count != 1){
            noun = noun.replace('y', 'i')
        }

        return `${count} ${noun}${(count != 1) ? prefix : ''}`;
    }

    let info = "You have " + pluralize(g, 'gallery', 'es') + " and " + pluralize(i, 'image') + " (in total)."
    let infoDiv = $('#profile-uploads-info i').append(info)
})