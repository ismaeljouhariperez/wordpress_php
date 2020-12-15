(function ($) {
    wp.customize('header_background', function (value) {
        value.bind(function (newVal) {
            $('.header').attr('style', 'background:' + newVal + '!important');
        });
    });

})(jQuery);
