(function ($) {

    window.$ = jQuery;

    $(document).ready(function () {

        $(".sidebar ul li a").hover(function() {
            $this = $(this);
            $this.find('.tooltip').css('display', 'block').css({opacity: 0}).animate({opacity: 1}, 'slow');
        }, function() {
            $this = $(this);
            $this.find('.tooltip').animate({opacity: 0}, 'slow', function() {
                $(this).css('display', 'none');
            });
        });

        preload([
            "./wp-content/themes/metadigital/images/meta_map_new2.jpg",
            "./wp-content/themes/metadigital/images/meta_map_new3.jpg"
        ]);

        $('#contact_us').click(function (ev) {
            var $this = $(this);
            if (ev.target.id == 'contact_us') {


                var mapId = parseInt($this.attr("data-map"));

                switch (mapId) {
                    case 0:
                        zoomImage($this, "./wp-content/themes/metadigital/images/meta_map_new2.jpg", mapId);
                        break;
                    case 1:
                        zoomImage($this, "./wp-content/themes/metadigital/images/meta_map_new3.jpg", mapId);
                        break;
                    case 2:
                        zoomImage($this, "./wp-content/themes/metadigital/images/meta_map_new1.jpg", mapId);
                        break;

                }
            }
        });
    });

    var zoomImage = function (el, background_img, mapId) {
        el.attr("data-map", (++mapId > 2 ? 0 : mapId));
        el.css({'background-image': 'url(' + background_img + ')'});

    };

    function preload(arg) {
        pics = [];
        for (var i = 0; i < arg.length; i++) {
            console.log(arg[i]);
            pics[i] = new Image();
            pics[i].src = arg[i];

        }
    }



})
(jQuery);