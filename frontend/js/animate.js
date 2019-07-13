function animate(direction, url, data){
    const $start = $('#now');
    const $end = $('.'+direction);
    const $animation = $('#animation');
    
    $start.attr('id', '');
    $end.attr('id', 'now');

    $start.fadeOut(500, function(){
        $animation.fadeIn(500, function(){
            $animation.fadeOut(500, function(){
                $end.fadeIn(500); 
            })
        })
    });
    
}