(function($) {
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

    var Gallery = function(selector, options){

        var responsive_options = options.responsive;

        var g = $(selector);

        g.css('position', 'relative');

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
            tile.css('position', 'absolute');
            //tile.css('background-color', generateColor());
            tile.css('background-repeat', 'no-repeat');
            tile.css('background-position', 'center');
            if(image_index >= albums_count)
                image_index = 0;

            while(options.albums[image_index].images.length == 0){
                image_index++;
                if(image_index >= albums_count)
                    image_index = 0;
            }
            tile.css('background-image', 'url(' + options.albums[image_index].images[0].thumbnail + ')');
            image_index++;
            return tile;
        };

        applySize();

        var resize = function(){
            var cell_width = g.width()/defaults.width;
            g.css('height', cell_width*2);

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
                var ok_button = $("<button>OK</button>");
                var self = this;
                ok_button.click(function(){
                    self.ok();
                });
                return this;
            },
            close: function() {
                document.getElementById('languagebox').style.display = "none";
                document.getElementById('languageoverlay').style.display = "none";
                $('body').css('overflow', 'auto');
                return this;
            },
            ruCallback: function(callback){
                $("#languagebox .locale-ru").click(function(){
                    callback();
                });
                return this;
            },
            enCallback: function(callback){
                $("#languagebox .locale-en").click(function(){
                    callback();
                });
                return this;
            }
        }
    };


    $(document).ready(function(){

        var Alert = new languageBox();
        Alert.render().enCallback(function(){
            console.log('en');
            Alert.close();
        }).ruCallback(function(){
            console.log('ru');
            Alert.close();
        });

        $.ajax({
            url: '/api/gallery/get_all_galleries',
            method: 'GET',
            success: function(data){
                delete data.status;
                var gallery = new Gallery("#gallery", {
                    albums: data,
                    responsive: [
                        {
                            breakpoint: 20000,
                            settings: {
                                vertical_double_tiles_count: 2,
                                horizontal_double_tiles_count: 3,
                                width: 8,
                                height: 2
                            }
                        },
                        {
                            breakpoint: 1300,
                            settings: {
                                vertical_double_tiles_count: 1,
                                horizontal_double_tiles_count: 2,
                                width: 6,
                                height: Math.ceil(Object.keys(data).length/6)
                            }
                        },
                        {
                            breakpoint: 800,
                            settings: {
                                vertical_double_tiles_count: 1,
                                horizontal_double_tiles_count: 1,
                                width: 4,
                                height: Math.ceil(Object.keys(data).length/4)
                            }
                        },
                        {
                            breakpoint: 550,
                            settings: {
                                vertical_double_tiles_count: 1,
                                horizontal_double_tiles_count: 1,
                                width: 2,
                                height: Math.ceil(Object.keys(data).length/2)
                            }
                        }
                    ]
                });
            }
        });
    });

})(jQuery);