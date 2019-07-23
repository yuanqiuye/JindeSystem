function animate_havadata(url, send) {
    const $start = $('#now');
    const $animation = $('.animation');
    $start.attr('id', '');

    $start.fadeOut(200, function() {
        $animation.fadeIn(100);
        callserver(url, send, () => {
            if (dowhat.status == null) {
                $animation.fadeOut(1000, function() {
                    const $end = $('.' + dowhat.direction);
                    $end.attr('id', 'now');
                    $end.fadeIn(1000);
                });
            } else {
                status_handler(dowhat.status, dowhat.direction);
            }
        })
    });
}