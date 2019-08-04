function animate_nondata(direction, middle) {
    const $start = $('#now');
    const $end = $('.' + direction);
    const $animation = $('.animation');
    const $middle = $('.' + middle)
    if (middle !== null) {
        $animation.fadeOut(100, function() {
            $middle.fadeIn(300, function() {
                $("button[id='confirm']").on("click", function() {
                    $middle.fadeOut(1000, function() {
                        $end.attr('id', 'now');
                        $end.fadeIn(400);
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