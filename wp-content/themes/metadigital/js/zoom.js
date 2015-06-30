/**
 * Created by LexX on 30.06.2015.
 */

$(function(){
    $('.main-footer').click(function() {
        var el = $(this);
        var mapId = el.data("map");
        var image = $(this).css('background-image');
        if (image.indexOf("map2.png") >= 0) {
            mapId = 1;
            console.log("inner" + mapId);
        }
        console.log(mapId);
        switch (mapId){
            case 0:
                zoom(el, "./wp-content/themes/metadigital/images/map2.png");
                break;
            case 1:
                zoom(el, "./wp-content/themes/metadigital/images/map3.png");
                break;
            //case 2: zoom($(this), "../images/map.png"); break;
        }
        //$('img.class').fadeOut(300, function(){
        //    $(this).attr('src','new_src.png').bind('onreadystatechange load', function(){
        //        if (this.complete) $(this).fadeIn(300);
        //    });
        //});
    });
})();


function zoom(el, background){
    el.css('background-image', "url('"+background+"')");
    el.attr("data-map", (el.data("map") + 1));
}