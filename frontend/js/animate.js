function animate(direction){
    const $start = $('#now');
    const $end = $('.'+direction);
    
    $start.attr('id', '');
    $end.attr('id', 'now');

    $start.fadeOut(500);
    $end.fadeIn(500); 
}