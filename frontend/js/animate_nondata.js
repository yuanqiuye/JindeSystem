function animate_nondata(direction, middle) {
    const $start = $('#now');
    const $end = $('.' + direction);
    const $middle = $('.' + middle)

    $start.attr('id', '');
    $end.attr('id', 'now');

    $start.fadeOut(400, function() {
        if (middle !== null) {
            $middle.fadeIn(300, function() {
                $middle.fadeOut(300, function() {
                    $end.fadeIn(400, function() {});
                });
            });
        } else {
            $end.fadeIn(500);
        }
    });
}