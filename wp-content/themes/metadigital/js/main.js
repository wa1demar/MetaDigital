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

    var Gallery = function(selector){
        var vertical_double_tiles_count = 3;
        var horizontal_double_tiles_count = 3;
        var width = 8;
        var height = 3;
        var simple_tiles_count = (width * height) - ((vertical_double_tiles_count + horizontal_double_tiles_count) * 2);

        var g = $(selector);

        g.css('position', 'relative');

        var tiles = [];

        var generateColor = function(){
            return '#'+Math.floor(Math.random()*16777215).toString(16)
        };

        var availablePlaces = function(){
            var result = [];
            for(var x = 0; x < width; x++){
                for(var y = 0; y < height; y++){
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
            for(var x = 0; x < width - 1; x++){
                for(var y = 0; y < height; y++){
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
            for(var x = 0; x < width; x++){
                for(var y = 0; y < height - 1; y++){
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
            return available_places[Math.floor(Math.random()*available_places.length)];
        };

        var randomPlaceForVerticalTile = function(){
            var available_places = availablePlacesForVerticalTile();
            return available_places[Math.floor(Math.random()*available_places.length)];
        };

        var randomPlace = function(){
            var available_places = availablePlaces();
            return available_places[Math.floor(Math.random()*available_places.length)];
        };

        var generateTile = function(){
            var tile = $("<div class='gallery-item'></div>");
            tile.css('position', 'absolute');
            tile.css('background-color', generateColor());
            return tile;
        };

        for(var i = 0; i < vertical_double_tiles_count; i++){
            var place =  randomPlaceForVerticalTile();
            var tile = generateTile();

            tiles.push({
                x: place.x,
                y: place.y,
                tile: tile,
                type: 'vertical'
            });
        }

        for(var i = 0; i < horizontal_double_tiles_count; i++){
            var tile = generateTile();
            var place = randomPlaceForHorizontalTile();

            tiles.push({
                x: place.x,
                y: place.y,
                tile: tile,
                type: 'horizontal'
            });
        }

        for(var i = 0; i < simple_tiles_count; i++){
            var tile = generateTile();
            var place = randomPlace();

            tiles.push({
                x: place.x,
                y: place.y,
                tile: tile,
                type: 'simple'
            });
        }

        var i = 0;
        while(i < tiles.length){
            g.append(tiles[i].tile);
            i++;
        }

        var resize = function(){
            console.log(g);
            var cell_width = g.width()/width;
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

        return {
            resize: function(){
                resize();
            }
        }
    };

    $(document).ready(function(){
        var gallery = new Gallery("#gallery");
        $(window).resize(function(){
            gallery.resize();
        });
    });


})(jQuery);