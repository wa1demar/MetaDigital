<!DOCTYPE html>
<html>
<head lang="en">
    <title><?php echo wp_title('|', true, 'right'); ?> 404</title>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-alpha1/jquery.min.js"></script>
    <script src="<?php echo THEME_URL ?>/js/jquery.timers.min.js"></script>
    <script>

        $(document).ready(function () {
            $('p.first').css({display: "block"});

            type($('p.first'), " # curl -I <?php echo "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']; ?>", 0);

            $("p.second").oneTime("2500ms", function () {
                $(this).css({display: "block"});
            });
            $("p.third").oneTime("3000ms", function () {
                $(this).css({display: "block"});
            });
            $("p.fourth").oneTime("4200ms", function () {
                $(this).css({display: "block"});
            });
            $("p.fifth").oneTime("4300ms", function () {
                $(this).css({display: "block"});
            });
            $("p.sixth").oneTime("4600ms", function () {
                $(this).css({display: "block"});
                $("p.seventh").css({display: "block"});
                $("span.seconds").everyTime(1000, function (i) {
                    $(this).text(10 - i);
                }, 10);
                $("span.seconds").oneTime("10s", function () {
                window.location.replace("http://<?php echo $_SERVER['HTTP_HOST']; ?>");
                });
            });
            $("span.blinked").everyTime(500, function (i) {
                $(this).toggle();
            });

            function type(el, text, i) {
                if (i <= text.length) {
                    el.html(text.substr(0, i));
                    setTimeout(function () {
                        type(el, text, i + 1);
                    }, 30);
                }
            };
        });

    </script>
    <style>
        p {
            display: none;
        }

        p.first {
            display: block;
        }
    </style>

</head>
<body style="background: #000000; color: #FFFFFF;">
<p class="first">#</p>

<p class="second"> > HTTP/1.1 404 Not Found</p>

<p class="third"> > Host: <?php echo $_SERVER['HTTP_HOST']; ?></p>

<p class="fourth"> > Connection: close</p>

<p class="fifth"> > Message: Page does not exist. Try to go back <a style="color: #FFFFFF; text-decoration: underline"
                                                                    href="<?php echo "http://" . $_SERVER['HTTP_HOST']; ?>"><?php echo "http://" . $_SERVER['HTTP_HOST']; ?></a>
</p>

<p class="sixth"> > will be redirect automaticaly after <span class="seconds">10</span> s</p>

<p class="seventh"> # <span class="blinked">&#124;</span></p>
</body>
</html>