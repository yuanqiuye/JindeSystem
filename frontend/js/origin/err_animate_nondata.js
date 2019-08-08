function animate_nondata(direction, middle) {
    const $start = $('#now');
    const $end = $('.' + direction);
    const $animation = $('.animation');
    const $middle = $('.' + middle)
    if (middle !== null) {
        $animation.fadeOut(100, function() {
            $middle.fadeIn(100, function() {
                $("button[id='confirm2']").on("click", function() {
                $middle.fadeOut(100, function() {
                    $end.attr('id', 'now');
                    $end.fadeIn(100);
                });
                })
            });
        })
    } else {
        $start.attr('id', '');
        $end.attr('id', 'now');

        $start.fadeOut(400, function() {
            $end.fadeIn(500);
        });

    }

}
