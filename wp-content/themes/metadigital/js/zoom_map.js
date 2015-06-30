(function ($) {

    window.$ = jQuery;

    $(document).ready(function(){
        $('.main-footer').click(function () {
            var $this = $(this);
            var mapId = parseInt($this.attr("data-map"));

            switch (mapId) {
                case 0:
                    zoomImage($this, "./wp-content/themes/metadigital/images/map2.png", mapId);
                    break;
                case 1:
                    zoomImage($this, "./wp-content/themes/metadigital/images/map3.png", mapId);
                    break;

            }
        });
    });

    var zoomImage = function (el, background_img, mapId) {
        //el.css('background-image', "url('" + background + "')");
        el.attr("data-map", (++mapId));

        el.animate({opacity: 0}, 'fast', function () {
            el
                .css({'background-image': 'url(' + background_img + ')'})
                .animate({opacity: 1});
        });

    }
})(jQuery);