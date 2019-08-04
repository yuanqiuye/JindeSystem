function animate_nondata(direction, middle) {
    var $start = $('#now');
    var $end = $('.' + direction);
    var $animation = $('.animation');
    var $middle = $('.' + middle);
    if (middle !== null) {
        $animation.fadeOut(100, function() {
            $middle.fadeIn(300);
        });
    } else {
        $start.attr('id', '');
        $end.attr('id', 'now');

        $start.fadeOut(400, function() {
            $end.fadeIn(500);
        });

    }

    $("#Sconfirm").on("click", function() {
        $middle.fadeOut(1000, function() {
            $end.attr('id', 'now');
            $end.fadeIn(400);
        });
    });

    $("#Fconfirm").on("click", function() {
        $middle.fadeOut(1000, function() {
            $end.attr('id', 'now');
            $end.fadeIn(400);
        });
    });


}