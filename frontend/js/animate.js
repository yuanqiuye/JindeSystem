function animate(direction){
    const $start = document.getElementById('now');
    const $end = document.getElementsByClassName(direction);
    
    $start.attr('id', '');
    $end.attr('id', 'now');

    $start.fadeOut(500);
    $end.fadeIn(500);
}