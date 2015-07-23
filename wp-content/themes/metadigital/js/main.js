(function ($) {

    function getRandomArbitary(min, max) {
        return Math.floor(Math.random() * (max - min)) + min;
    };

    window.$ = jQuery;

    $.fn.goTo = function () {
        $('html, body').animate({
            scrollTop: $(this).offset().top + 'px'
        }, 'slow');
        return this; // for chaining...
    };

    $(".button1").click(function () {
        $("#section5").goTo();
    });

    window.Gallery = function (selector, options) {

        var responsive_options = options.responsive;
        var tileClickCallback = function () {
        };
        var g = $(selector);

        g.css('position', 'relative');
        g.css('overflow', 'hidden');

        var tiles = [];

        var defaults = {};

        var simple_tiles_count = function () {
            return ((defaults.width * defaults.height) - ((defaults.vertical_double_tiles_count + defaults.horizontal_double_tiles_count) * 2));
        };

        var redraw = function () {
            for (var i = 0; i < tiles.length; i++) {
                tiles[i].tile.remove();
            }
            tiles = [];

            for (var i = 0; i < defaults.vertical_double_tiles_count; i++) {
                var place = randomPlaceForVerticalTile();
                var tile = generateTile();
                if (!place)
                    continue;

                tiles.push({
                    x: place.x,
                    y: place.y,
                    tile: tile,
                    type: 'vertical'
                });
            }

            for (var i = 0; i < defaults.horizontal_double_tiles_count; i++) {
                var tile = generateTile();
                var place = randomPlaceForHorizontalTile();
                if (!place)
                    continue;

                tiles.push({
                    x: place.x,
                    y: place.y,
                    tile: tile,
                    type: 'horizontal'
                });
            }

            for (i = 0; i < simple_tiles_count(); i++) {
                var tile = generateTile();
                var place = randomPlace();
                if (!place)
                    continue;

                tiles.push({
                    x: place.x,
                    y: place.y,
                    tile: tile,
                    type: 'simple'
                });
            }

            i = 0;
            while (i < tiles.length) {
                g.append(tiles[i].tile);
                i++;
            }
        };

        var applySize = function () {
            var width = g.width();
            var old_width = defaults.width;

            for (var i = 0; i < responsive_options.length; i++) {
                var options = responsive_options[i];
                if (options.breakpoint >= width || (!defaults.width)) {
                    defaults.width = options.settings.width;
                    defaults.height = options.settings.height;
                    defaults.vertical_double_tiles_count = options.settings.vertical_double_tiles_count;
                    defaults.horizontal_double_tiles_count = options.settings.horizontal_double_tiles_count;
                    defaults.simple_tiles_count = simple_tiles_count();
                }
            }
            if (old_width != defaults.width) {
                redraw();
            }
        };

        var generateColor = function () {
            return '#' + Math.floor(Math.random() * 16777215).toString(16);
        };

        var availablePlaces = function () {
            var result = [];
            for (var x = 0; x < defaults.width; x++) {
                for (var y = 0; y < defaults.height; y++) {
                    var is_available = true;
                    var z = 0;
                    while (z < tiles.length) {
                        if (tiles[z].type == 'vertical' && x == tiles[z].x && y == (tiles[z].y + 1)) {
                            is_available = false
                        }
                        if (tiles[z].type == 'horizontal' && y == tiles[z].y && x == (tiles[z].x + 1)) {
                            is_available = false;
                        }
                        if (x == tiles[z].x && y == tiles[z].y) {
                            is_available = false
                        }
                        z++;
                    }
                    if (is_available) {
                        result.push({x: x, y: y});
                    }
                }
            }
            return result;
        };

        var availablePlacesForHorizontalTile = function () {
            var result = [];
            for (var x = 0; x < defaults.width - 1; x++) {
                for (var y = 0; y < defaults.height; y++) {
                    var is_available = true;
                    var z = 0;
                    while (z < tiles.length) {
                        if (tiles[z].type == 'vertical' && x == tiles[z].x && y == (tiles[z].y + 1)) {
                            is_available = false
                        }
                        if (tiles[z].type == 'horizontal' && y == tiles[z].y && x == (tiles[z].x + 1)) {
                            is_available = false;
                        }
                        if (x == tiles[z].x && y == tiles[z].y) {
                            is_available = false
                        }
                        // x + 1 for horizontal is available ?
                        if (tiles[z].type == 'vertical' && (x + 1) == tiles[z].x && y == (tiles[z].y + 1)) {
                            is_available = false
                        }
                        if (tiles[z].type == 'horizontal' && y == tiles[z].y && (x + 1) == (tiles[z].x + 1)) {
                            is_available = false;
                        }
                        if ((x + 1) == tiles[z].x && y == tiles[z].y) {
                            is_available = false
                        }
                        z++;
                    }
                    if (is_available) {
                        result.push({x: x, y: y});
                    }
                }
            }
            return result;
        };

        var availablePlacesForVerticalTile = function () {
            var result = [];
            for (var x = 0; x < defaults.width; x++) {
                for (var y = 0; y < defaults.height - 1; y++) {
                    var is_available = true;
                    var z = 0;
                    while (z < tiles.length) {
                        if (tiles[z].type == 'vertical' && x == tiles[z].x && y == (tiles[z].y + 1)) {
                            is_available = false
                        }
                        if (tiles[z].type == 'horizontal' && y == tiles[z].y && x == (tiles[z].x + 1)) {
                            is_available = false;
                        }
                        if (x == tiles[z].x && y == tiles[z].y) {
                            is_available = false
                        }
                        // y + 1 for horizontal is available ?
                        if (tiles[z].type == 'vertical' && x == tiles[z].x && (y + 1) == (tiles[z].y + 1)) {
                            is_available = false
                        }
                        if (tiles[z].type == 'horizontal' && (y + 1) == tiles[z].y && x == (tiles[z].x + 1)) {
                            is_available = false;
                        }
                        if (x == tiles[z].x && (y + 1) == tiles[z].y) {
                            is_available = false
                        }
                        z++;
                    }
                    if (is_available) {
                        result.push({x: x, y: y});
                    }
                }
            }
            return result;
        };

        var randomPlaceForHorizontalTile = function () {
            var available_places = availablePlacesForHorizontalTile();
            if (available_places.length == 0) {
                defaults.horizontal_double_tiles_count--;
                defaults.simple_tiles_count = simple_tiles_count();
                return null;
            }
            var index = Math.floor(Math.random() * available_places.length);
            return available_places[index];
        };

        var randomPlaceForVerticalTile = function () {
            var available_places = availablePlacesForVerticalTile();
            if (available_places.length == 0 || defaults.height < 2) {
                defaults.vertical_double_tiles_count--;
                defaults.simple_tiles_count = simple_tiles_count();
                return null;
            }
            var index = Math.floor(Math.random() * available_places.length);
            return available_places[index];
        };

        var randomPlace = function () {
            var available_places = availablePlaces();
            if (available_places.length == 0) {
                return null;
            }
            var index = Math.floor(Math.random() * available_places.length);
            return available_places[index];
        };

        var image_index = 0;
        var albums_count = Object.keys(options.albums).length;

        var generateTile = function () {
            var tile = $("<div class='gallery-item'></div>");
            var image = $("<div class='gallery-image'></div>");


            tile.css('position', 'absolute');

            tile.css('overflow', 'hidden');
            if (image_index >= albums_count)
                image_index = 0;

            while (options.albums[image_index].images.length == 0) {
                image_index++;
                if (image_index >= albums_count)
                    image_index = 0;
            }

            var imageArray = options.albums[image_index].images;
            image.css('background-image', 'url(' + imageArray[getRandomArbitary(0, imageArray.length)].thumbnail + ')');
            tile.append(image);


            var hover = $('<div class="gallery_hover"></div>');
            hover.html($('<span>' + options.albums[image_index][locale]['title'] + '</span>').css('position', 'absolute').css('bottom', '60px').css('left', '15px'));

            tile.mouseover(function () {
                image.stop();
                image.animate({width: '120%', height: '120%', top: '-6%', left: '-6%'}, 300);
                //hover.stop();
                //hover.animate({bottom: 0}, 500);
            });
            tile.mouseleave(function () {
                image.animate({width: '100%', height: '100%', top: '0', left: '0'}, 300);

                //hover.animate({bottom: '-100%'}, 500);
            });
            var tile_index = image_index;
            tile.click(function () {
                tileClickCallback(tile_index);
            });

            tile.append(hover);
            image_index++;
            return tile;
        };

        applySize();

        var resize = function () {
            var cell_width = g.width() / defaults.width;
            g.css('height', cell_width * defaults.height);

            var i = 0;
            while (i < tiles.length) {
                if (tiles[i].type == 'vertical') {
                    tiles[i].tile.css('height', cell_width * 2);
                } else {
                    tiles[i].tile.css('height', cell_width);
                }
                if (tiles[i].type == 'horizontal') {
                    tiles[i].tile.css('width', cell_width * 2);
                } else {
                    tiles[i].tile.css('width', cell_width);
                }
                tiles[i].tile.css('top', (tiles[i].y) * cell_width);
                tiles[i].tile.css('left', (tiles[i].x) * cell_width);
                i++;
            }
        };
        resize();

        $(window).resize(function () {
            applySize();
            resize();
        });

        return {
            tileClick: function (callback) {
                tileClickCallback = callback;
            }
        };
    };

    window.LanguageBox = function () {
        var choose = function (lang) {

        };
        var lang = 'ru';
        return {
            render: function () {
                var dialogoverlay = document.getElementById('languageoverlay');
                var dialogbox = document.getElementById('languagebox');
                dialogoverlay.style.display = "block";
                dialogbox.style.top = "100px";
                dialogbox.style.display = "block";
                $('body').css('overflow', 'hidden');

                $("#languagebox .locale-ru").click(function () {
                    choose('ru');
                    $.cookie('language', 'ru', {expires: 7, path: '/'});
                    return false;
                });
                $("#languagebox .locale-en").click(function () {
                    choose('en');
                    $.cookie('language', 'en', {expires: 7, path: '/'});
                    return false;
                });


                return this;
            },
            close: function () {
                document.getElementById('languagebox').style.display = "none";
                document.getElementById('languageoverlay').style.display = "none";
                $('body').css('overflow', 'auto');
                return this;
            },
            chooseCallback: function (callback) {
                choose = callback;
                return this;
            }
        }
    };

    window.messageBox = function () {
        var overlay = $('.alert-overlay');
        overlay.css('display', 'block');
        $('body').css('overflow', 'hidden');

        overlay.find('.alert-close, .close-button').click(function () {
            $('body').css('overflow', 'auto');
            overlay.css('display', 'none');
        });
    };

    window.Lightbox = function (options) {
        var dialogoverlay = $('.gallery-overlay');
        var dialogclose = $('.gallery-close');
        var carousel = $('.gallery');
        var next_arrow = $(".gallery-next");
        var prev_arrow = $(".gallery-prev");
        var about_button = $('.about-container');
        var panel_opened = false;
        var close_button = $('.about-panel-hide');
        var next_button = $('.next-button');
        var about_panel = $('.about-panel');
        var slick_disabler = $('.slick-disabler');
        var slick = null;

        var displayWidth = $(document).width();

        var images = [];
        var nextProjectCallback = function () {
        };

        function isMobileDisplay() {
            if (displayWidth < 500) {
                return true;
            }
            return false;
        }

        function close() {
            unbindAll();
            slick.slick('unslick');
            dialogoverlay.css('display', 'none');
        }

        function unbindAll() {
            about_button.unbind('click');
            dialogclose.unbind('click');
            close_button.unbind('click');
            next_button.unbind('click');
        }

        function hide_panel() {
            slick_disabler.css("display", "none");
            if (isMobileDisplay()) {
                about_panel.css('height', '60%');
                $('.slick-disabler').hide();
                about_panel.animate({
                    bottom: '-100%'
                }, 'slow');
            } else {
                $('.slick-disabler').hide();
                about_panel.animate({
                    bottom: '-60%'
                }, 'slow');
            }
        }

        dialogclose.unbind('click').click(function () {
            console.log('here');
            if (panel_opened) {
                panel_opened = false;
                hide_panel();
            } else {
                $('body').css('overflow', 'auto');
                close()
            }
        });

        about_button.click(function () {
            if (isMobileDisplay()) {
                about_panel.css('height', '100%');
                slick_disabler.css("display", 'block');
            }

            panel_opened = true;
            $('.slick-disabler').show();
            about_panel.animate({
                bottom: 0
            }, 'slow');
        });

        close_button.click(function () {
            hide_panel()
        });
        next_button.click(function () {
            slick.slick('unslick');
            nextProjectCallback();
        });

        function render() {
            $('body').css('overflow', 'hidden');

            carousel.html('');
            var width = $(window).width();
            var height = $(window).height();
            console.log("width: " + width + ", height: " + height);
            for (var i = 0; i < images.length; i++) {
                var url = "";
                if (width > 600 && height > 600) {
                    url = images[i].medium;
                } else if (width > 300 && height > 300) {
                    url = images[i].small;
                } else {
                    url = images[i].full
                }

                carousel.append($('<div class="lightbox-gallery-item" ></div>').css('background-image', 'url(' + url + ')'));
            }

            dialogoverlay.css('display', 'block');

            slick = carousel.slick({
                dots: false,
                infinite: true,
                speed: 300,
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplay: false,
                arrows: true,
                prevArrow: prev_arrow,
                nextArrow: next_arrow
            });

        }

        return {
            render: function () {
                render();
                return this;
            },
            setImages: function (data) {
                images = data;
                return this;
            },
            nextProject: function (callback) {
                nextProjectCallback = callback;
            }
        }
    };


    $(document).ready(function () {

        var isMobile = false;
        if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent)
            || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))) isMobile = true;

        if (!isMobile) {
            $('video').get(0).play();
        }

        $('.home-icon').click(function () {
            console.log($(this).css('left'));
            if ($(this).css('left') != '0px') {
                console.log('close');
                $('.home-icon').animate({
                    left: '0'
                }, 'slow');
                $('.home-link').animate({
                    left: '-120px'
                }, 'slow');
            } else {
                console.log('open');
                $('.home-icon').animate({
                    left: '121px'
                }, 'slow');
                $('.home-link').animate({
                    left: '0'
                }, 'slow');
            }
        });
    });

    window.animateLogo = function () {
        var container = $('.main .description');

        var width = $('body').width();
        console.log(width);
        if (width > 1200) {
            $('.logo-image').animate({
                width: '30%'

            }, 700, function () {
                type(container, container.data('type'), 0);
            })
        } else if (width > 768) {
            $('.logo-image').animate({
                width: '47%',
                left: '180px'
            }, 700, function () {
                type(container, container.data('type'), 0);
                $('.sidebar li .tooltip').animate({'display': 'none'});
            })
        } else {
            $('.logo-image').animate({
                opacity: 0
            }, 700, function () {
                type(container, container.data('type'), 0);
                $('.sidebar li .tooltip').animate({'display': 'none'});
            })
        }
    };

    window.type = function (el, text, i) {
        if (i <= text.length) {
            el.html(text.substr(0, i));
            setTimeout(function () {
                type(el, text, i + 1);
            }, 30);
        }
    };

    $.urlParam = function (name) {
        var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
        if (results == null) {
            return null;
        }
        else {
            return results[1] || 0;
        }
    }
})(jQuery);