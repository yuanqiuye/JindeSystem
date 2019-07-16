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
                //待處理(重導向利用下面方法)statusdandler

            }
        })
    });
}