function animate_havadata(url, send) {
    const $start = $('#now');
    const $animation = $('.animation');


    $start.fadeOut(200, function() {
        $animation.fadeIn(100);
        callserver(url, send, () => {
            if (dowhat.status == null) {
                $start.attr('id', '');
                $animation.fadeOut(100, function() {
                    const $end = $('.' + dowhat.direction);
                    $end.attr('id', 'now');
                    $end.fadeIn(400);
                });
            } else {
                status_handler(dowhat.status, dowhat.direction);
            }
        })
    });
}