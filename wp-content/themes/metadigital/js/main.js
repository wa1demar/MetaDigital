(function($) {

    function getRandomArbitary(min, max) {
        return Math.floor(Math.random() * (max - min)) + min;
    };

    window.$ = jQuery;

    $.fn.goTo = function() {
        $('html, body').animate({
            scrollTop: $(this).offset().top + 'px'
        }, 'slow');
        return this; // for chaining...
    };

    $(".button1").click(function(){
        $("#section5").goTo();
    });

    window.Gallery = function(selector, options){

        var responsive_options = options.responsive;

        var g = $(selector);

        g.css('position', 'relative');
        g.css('overflow', 'hidden');

        var tiles = [];

        var defaults = {};

        var simple_tiles_count = function(){
            return ((defaults.width * defaults.height) - ((defaults.vertical_double_tiles_count + defaults.horizontal_double_tiles_count) * 2));
        };

        var redraw = function(){
            for(var i = 0; i < tiles.length; i++){
                tiles[i].tile.remove();
            }
            tiles = [];

            for(var i = 0; i < defaults.vertical_double_tiles_count; i++){
                var place =  randomPlaceForVerticalTile();
                var tile = generateTile();
                if(!place)
                    continue;

                tiles.push({
                    x: place.x,
                    y: place.y,
                    tile: tile,
                    type: 'vertical'
                });
            }

            for(var i = 0; i < defaults.horizontal_double_tiles_count; i++){
                var tile = generateTile();
                var place = randomPlaceForHorizontalTile();
                if(!place)
                    continue;

                tiles.push({
                    x: place.x,
                    y: place.y,
                    tile: tile,
                    type: 'horizontal'
                });
            }

            console.log(defaults.simple_tiles_count);
            for(i = 0; i < simple_tiles_count(); i++){
                var tile = generateTile();
                var place = randomPlace();
                if(!place)
                    continue;

                tiles.push({
                    x: place.x,
                    y: place.y,
                    tile: tile,
                    type: 'simple'
                });
            }

            i = 0;
            while(i < tiles.length){
                g.append(tiles[i].tile);
                i++;
            }
        };

        var applySize = function(){
            var width = g.width();
            var old_width = defaults.width;

            for(var i = 0; i < responsive_options.length; i++){
                var options = responsive_options[i];
                if(options.breakpoint >= width || (!defaults.width)){
                    defaults.width = options.settings.width;
                    defaults.height = options.settings.height;
                    defaults.vertical_double_tiles_count = options.settings.vertical_double_tiles_count;
                    defaults.horizontal_double_tiles_count = options.settings.horizontal_double_tiles_count;
                    defaults.simple_tiles_count = simple_tiles_count();
                }
            }
            if(old_width != defaults.width){
                redraw();
            }
        };

        var generateColor = function(){
            return '#'+Math.floor(Math.random()*16777215).toString(16);
        };

        var availablePlaces = function(){
            var result = [];
            for(var x = 0; x < defaults.width; x++){
                for(var y = 0; y < defaults.height; y++){
                    var is_available = true;
                    var z = 0;
                    while(z < tiles.length){
                        if(tiles[z].type == 'vertical' && x == tiles[z].x && y == (tiles[z].y + 1)){
                            is_available = false
                        }
                        if(tiles[z].type == 'horizontal' && y == tiles[z].y && x == (tiles[z].x + 1)){
                            is_available = false;
                        }
                        if(x == tiles[z].x && y == tiles[z].y){
                            is_available = false
                        }
                        z++;
                    }
                    if(is_available){
                        result.push({x: x, y: y});
                    }
                }
            }
            return result;
        };

        var availablePlacesForHorizontalTile = function(){
            var result = [];
            for(var x = 0; x < defaults.width - 1; x++){
                for(var y = 0; y < defaults.height; y++){
                    var is_available = true;
                    var z = 0;
                    while(z < tiles.length){
                        if(tiles[z].type == 'vertical' && x == tiles[z].x && y == (tiles[z].y + 1)){
                            is_available = false
                        }
                        if(tiles[z].type == 'horizontal' && y == tiles[z].y && x == (tiles[z].x + 1)){
                            is_available = false;
                        }
                        if(x == tiles[z].x && y == tiles[z].y){
                            is_available = false
                        }
                        // x + 1 for horizontal is available ?
                        if(tiles[z].type == 'vertical' && (x + 1) == tiles[z].x && y == (tiles[z].y + 1)){
                            is_available = false
                        }
                        if(tiles[z].type == 'horizontal' && y == tiles[z].y && (x + 1) == (tiles[z].x + 1)){
                            is_available = false;
                        }
                        if((x + 1) == tiles[z].x && y == tiles[z].y){
                            is_available = false
                        }
                        z++;
                    }
                    if(is_available){
                        result.push({x: x, y: y});
                    }
                }
            }
            return result;
        };

        var availablePlacesForVerticalTile = function(){
            var result = [];
            for(var x = 0; x < defaults.width; x++){
                for(var y = 0; y < defaults.height - 1; y++){
                    var is_available = true;
                    var z = 0;
                    while(z < tiles.length){
                        if(tiles[z].type == 'vertical' && x == tiles[z].x && y == (tiles[z].y + 1)){
                            is_available = false
                        }
                        if(tiles[z].type == 'horizontal' && y == tiles[z].y && x == (tiles[z].x + 1)){
                            is_available = false;
                        }
                        if(x == tiles[z].x && y == tiles[z].y){
                            is_available = false
                        }
                        // y + 1 for horizontal is available ?
                        if(tiles[z].type == 'vertical' && x == tiles[z].x && (y + 1) == (tiles[z].y + 1)){
                            is_available = false
                        }
                        if(tiles[z].type == 'horizontal' && (y + 1) == tiles[z].y && x == (tiles[z].x + 1)){
                            is_available = false;
                        }
                        if(x == tiles[z].x && (y + 1) == tiles[z].y){
                            is_available = false
                        }
                        z++;
                    }
                    if(is_available){
                        result.push({x: x, y: y});
                    }
                }
            }
            return result;
        };

        var randomPlaceForHorizontalTile = function(){
            var available_places = availablePlacesForHorizontalTile();
            if(available_places.length == 0){
                defaults.horizontal_double_tiles_count--;
                defaults.simple_tiles_count = simple_tiles_count();
                return null;
            }
            var index = Math.floor(Math.random()*available_places.length);
            return available_places[index];
        };

        var randomPlaceForVerticalTile = function(){
            var available_places = availablePlacesForVerticalTile();
            if(available_places.length == 0 || defaults.height < 2){
                defaults.vertical_double_tiles_count--;
                defaults.simple_tiles_count = simple_tiles_count();
                return null;
            }
            var index = Math.floor(Math.random()*available_places.length);
            return available_places[index];
        };

        var randomPlace = function(){
            var available_places = availablePlaces();
            if(available_places.length == 0){
                return null;
            }
            var index = Math.floor(Math.random()*available_places.length);
            return available_places[index];
        };

        var image_index = 0;
        var albums_count = Object.keys(options.albums).length;

        var generateTile = function(){
            var tile = $("<div class='gallery-item'></div>");
            var image = $("<div class='gallery-image'></div>");


            tile.css('position', 'absolute');

            tile.css('overflow', 'hidden');
            if(image_index >= albums_count)
                image_index = 0;

            while(options.albums[image_index].images.length == 0){
                image_index++;
                if(image_index >= albums_count)
                    image_index = 0;
            }

            var imageArray = options.albums[image_index].images;
            image.css('background-image', 'url(' + imageArray[getRandomArbitary(0,imageArray.length)].thumbnail + ')');
            tile.append(image);


            var hover = $('<div class="gallery_hover"></div>');
            hover.html($('<span>' + options.albums[image_index][locale]['title'] + '</span>').css('position', 'absolute').css('bottom', '60px').css('left', '15px'));

            tile.mouseover(function(){
                image.stop();
                image.animate({width:'110%', height:'110%', top: '-5%', left: '-5%'}, 500);
                hover.stop();
                hover.animate({bottom: 0}, 500);
            });
            tile.mouseleave(function(){
                image.animate({width:'100%', height:'100%', top: '0', left: '0'}, 500);

                hover.animate({bottom: '-100%'}, 500);
            });
            var tile_images = options.albums[image_index];
            tile.click(function(){
                new Lightbox(tile_images).render();
            });

            tile.append(hover);
            image_index++;
            return tile;
        };

        applySize();

        var resize = function(){
            var cell_width = g.width()/defaults.width;
            g.css('height', cell_width*2);

            console.log("--- "+tiles.length);

            var i = 0;
            while(i < tiles.length){
                if(tiles[i].type == 'vertical'){
                    tiles[i].tile.css('height', cell_width*2);
                }else{
                    tiles[i].tile.css('height', cell_width);
                }
                if(tiles[i].type == 'horizontal'){
                    tiles[i].tile.css('width', cell_width*2);
                }else{
                    tiles[i].tile.css('width', cell_width);
                }
                tiles[i].tile.css('top', (tiles[i].y) * cell_width);
                tiles[i].tile.css('left', (tiles[i].x) * cell_width);
                i++;
            }
        };
        resize();

        $(window).resize(function(){
            applySize();
            resize();
        });

        return {};
    };

    window.languageBox = function (){
        var choose = function(){};
        var lang = 'ru';
        return {
            render: function(){
                var winW = window.innerWidth;
                var winH = window.innerHeight;
                var dialogoverlay = document.getElementById('languageoverlay');
                var dialogbox = document.getElementById('languagebox');
                dialogoverlay.style.display = "block";
                dialogbox.style.top = "100px";
                dialogbox.style.display = "block";
                $('body').css('overflow', 'hidden');

                $("#languagebox .locale-ru").click(function(){
                    choose('ru');
                    return false;
                });
                $("#languagebox .locale-en").click(function(){
                    choose('en');
                    return false;
                });
                return this;
            },
            close: function() {
                document.getElementById('languagebox').style.display = "none";
                document.getElementById('languageoverlay').style.display = "none";
                $('body').css('overflow', 'auto');
                return this;
            },
            chooseCallback: function(callback){
                choose = callback;
                return this;
            }
        }
    };

    window.Lightbox = function (options){
        console.log(options);
        return {
            render: function(){
                var winW = window.innerWidth;
                var winH = window.innerHeight;
                var dialogoverlay = $('<div class="gallery-overlay"></div>');

                var panel_opened = false;

                var slick_disabler = $('<div class="slick-disabler"></div>');

                var dialogclose = $('<div class="gallery-close"></div>').css('color', 'white').click(function(){
                    if(panel_opened){
                        about_panel.animate({
                            bottom: '-60%'
                        }, 'slow');
                        panel_opened = false;
                        slick_disabler.hide();
                    }else{
                        dialogoverlay.remove();
                        $('body').css('overflow', 'auto');
                    }
                });

                dialogoverlay.css('dispaly', 'block');
                $('body').css('overflow', 'hidden');

                var carousel = $('<div class="gallery"></div>');
                for(var i = 0; i < options.images.length; i++){
                    carousel.append($('<div class="lightbox-gallery-item"></div>').css('background-image', 'url(' + options.images[i].full + ')'));
                }

                var next_arrow = $("<a class='gallery-next'></a>");
                var prev_arrow = $("<a class='gallery-prev'></a>");

                setTimeout(function(){
                    carousel.slick({
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
                }, 0);

                dialogoverlay.append(carousel);

                dialogoverlay.append(next_arrow);
                dialogoverlay.append(prev_arrow);
                dialogoverlay.append(dialogclose);

                var next_text = locale == 'ru' ? 'Следующий Проект' : 'Next Project' ;
                var about_panel = $('<div class="about-panel"><h1>' + options[locale].title + '</h1><p>' + options[locale].description + '</p><br><br><br><br><a class="next-button">' + next_text + '<a></div>');

                var about_text = locale == 'ru' ? 'О проекте' : 'About Project' ;
                var about_button = $('<div class="about-container"><a class="about-button">' + about_text + '<a></div>').click(function(){
                    panel_opened = true;
                    slick_disabler.show();
                    about_panel.animate({
                        bottom: 0
                    }, 'slow');
                });

                var close_button = $('<button class="about-panel-hide">&nbsp;</button>').click(function(){ dialogclose.click() });
                about_panel.prepend(close_button);

                dialogoverlay.append(about_button);

                dialogoverlay.append(slick_disabler);
                dialogoverlay.append(about_panel);
                dialogoverlay.append(dialogclose);


                $('body').append(dialogoverlay);
                return this;
            }
        }
    };


    $(document).ready(function(){

    });

})(jQuery);