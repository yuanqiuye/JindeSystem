function animate_havadata(url, send) {
    const $start = $('#now');
    const $animation = $('.animation');
    $start.attr('id', '');

    $start.fadeOut(400, function() {
        $animation.fadeIn();
        callserver(url, send, () => {
            if (dowhat.status == null) {
                $animation.fadeOut(400, function() {
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