function animate(direction, url, data) {
    const $start = $('#now');
    const $end = $('.' + direction);
    const $animation = $('.cssload-wrap3');

    $start.attr('id', '');
    $end.attr('id', 'now');

    $start.fadeOut(500, function() {
        $animation.fadeIn();

    });

}