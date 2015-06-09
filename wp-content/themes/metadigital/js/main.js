(function($) {
    $(function(){
        function type(el, text, i){
            if( i <= text.length ) {
                el.html(text.substr(0, i));
                setTimeout(function(){ type(el, text, i + 1); }, 50);
            }
        }

        type($('.main .description'), " META IS A BRANDING LABORATORY, BASED IN MOSCOW, WICH SPECIALIZES IN PRODUCTS OF PREMIUM SEGMENT. " +
        "LOOKING AT THE WORLD THROUGH THE PRISM OF METAPHYSICS WE SEE THE PROCESSES THAT UNDERLIE THE SUCCESS OF ANY PROJECTS. " +
        "WE BUILD OUR OUTLOOK ON THE AESTHETICS AND PHILOSOPHY, TRYING TO UNDERSTAND THE DEPTH OF THE HUMAN MIND, USING THIS EXPERIENCE" +
        " TO CREATE MASTERPIECES OF ART OF BRANDING.", 0);

    });
})(jQuery);