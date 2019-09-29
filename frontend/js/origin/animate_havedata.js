function animate_havadata(url, send, binary) {
    this.binary = binary || false;
    const $start = $('#now');
    const $animation = $('.animation');
    $start.attr('id', '');
    $start.fadeOut(200, function() {
        $animation.fadeIn(100);
        callserver(url, send, () => {
            if (dowhat.status == null) {
                $animation.fadeOut(100, function() {
                    const $end = $('.' + dowhat.direction);
                    $end.attr('id', 'now');
                    $end.fadeIn(400);
                });
            } else {
                status_handler(dowhat.status, dowhat.direction);
            }
        }, this.binary)
    });
}