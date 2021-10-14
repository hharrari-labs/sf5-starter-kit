$(document).on('click','.fa-caret-down', function(e){
    $(this).siblings('ul').toggle();
    e.stopPropagation();
})