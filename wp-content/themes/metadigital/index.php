<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="<?php bloginfo('charset'); ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <link rel="shortcut icon" href="/favicon.ico"/>
    <title><?php echo wp_title('|', true, 'right'); ?> <?php bloginfo('name'); ?></title>


    <?php wp_head(); ?>

    <style>
    </style>
</head>
<body ng-app="metaDigitalApp" ng-controller="HomeController as con">
<div class="sidebar">
    <ul>
        <li><a href="" class="to-main" onclick="animateLogo()">
                <div class="tooltip">{{ t[locale].sidebar_top }}</div>
            </a></li>
        <li><a href="" class="to-articles">
                <div class="tooltip">{{ t[locale].sidebar_services }}</div>
            </a></li>
        <li><a href="" class="to-gallery">
                <div class="tooltip">{{ t[locale].sidebar_works }}</div>
            </a></li>
        <li><a href="" class="to-main-footer">
                <div class="tooltip">{{ t[locale].sidebar_contacts }}</div>
            </a></li>
    </ul>
</div>

<div class="main" id="main">

    <div class="logo">
git add .        <img class="logo-scroll" src="./wp-content/themes/metadigital/images/scroll-icon.svg"
             onclick="$('.articles').goTo()">
    </div>
    <div class="home-link"><a href="http://metamoscow.com/" target="_blank">
            <img src="./wp-content/themes/metadigital/images/meta-moskow-logo.svg">
        </a>
    </div>
    <div class="home-icon"><i class="fa fa-home"></i></div>
    <div class="description" >
    </div>
<!--    <video preload="none" autoplay="autoplay" loop="loop">-->
<!--        <source src="./wp-content/themes/metadigital/video/metaspace.mp4" type="video/mp4"-->
<!--                codecs="avc1.42E01E, mp4a.40.2">-->
<!--    </video>-->
    <video autoplay loop poster="/wp-content/themes/metadigital/polina.png" id="bgvid">
        <source src="./wp-content/themes/metadigital/video/metaspace.webm" type="video/webm">
        <source src="./wp-content/themes/metadigital/video/metaspace.mp4" type="video/mp4">
    </video>
</div>
<div class="articles" id="articles">
    <div class="category {{ $parent.current_category != category ? '' : 'active' }}" ng-repeat="category in categories"
         ng-click="$parent.current_category = category; $parent.current_post = $parent.current_category.posts[0];">
        <div class="item">
            <div class="icon">
                <img
                    ng-src="{{ $parent.current_category != category ? category.icons.default : category.icons.active }}">
            </div>
            <div class="title">{{ category.name }}</div>
        </div>
    </div>
    <div style="clear: left"></div>
</div>
<div class="articles-drilldown">
    <div class="articles-list">
        <ul>
            <li ng-repeat="post in current_category.posts" ng-click="setCurrentPost(post)"
                class="{{ $parent.current_post != post ? '' : 'active' }}"><a href="#{{ post.slug }}">{{ post.title }}</a>
            </li>
        </ul>
    </div>
    <div class="articles-content">
        <div class="top-gradient"></div>
        <div class="articles-body">
            <div class="articles-header" name="services">
                {{ current_category.name }}
            </div>
            <div ng-bind-html="getHtml(current_post.content)"></div>
        </div>
        <div class="bottom-gradient"></div>
    </div>

</div>

<div id="gallery">

</div>

<div class="main-footer" id="contact_us" data-map="0">
    <div class="footer-address">
        <div class="footer-address-header">{{ t[locale].moskow }}</div>
        <p> {{ t[locale].address}} <br>
            +74957259669<br>
            info@metamoscow.com</p>

        <ul class="footer-address-header-social-links">
            <li><a href="#"><img src="<?php echo THEME_URL ?>/images/twitter-icon.png"></a></li>
            <li><a href="#"><img src="<?php echo THEME_URL ?>/images/vk-icon.png"></a></li>
            <li><a href="#"><img src="<?php echo THEME_URL ?>/images/linkedin-icon.png"></a></li>
            <li><a href="#"><img src="<?php echo THEME_URL ?>/images/facebook-icon.png"></a></li>
            <li><a href="#"><img src="<?php echo THEME_URL ?>/images/blogger-icon.png"></a></li>
        </ul>
    </div>

    <div class="footer-contact-us">
        <p>{{ t[locale].contact_us}}</p>

        <form class="footer-contact-us-inputs" ng-submit="contactUs()" novalidate="true">
            <div class="inputs">
                <input id="username" name="username" type="text" placeholder="{{ t[locale].name}}" ng-model="username">
            </div>
            <div class="inputs">
                <input id="useremail" name="useremail" type="text" placeholder="{{ t[locale].email}}"
                       ng-model="useremail">
            </div>
            <div class="inputs">
                <textarea rows="3" cols="26" id="useretext" name="useretext" type="text"
                          placeholder="{{ t[locale].feadback_text}}" ng-model="usertext"></textarea>
            </div>
            <input class="contact-us-send-button" name="send" type="submit" value="{{ t[locale].send_button}}">
        </form>
    </div>
    <div class="footer-google-link">
        <a href="#"></a>
    </div>
</div>

<div class="footer-bottom-image">
    <img src="<?php echo THEME_URL ?>/images/meta-moskow-logo-small.png">
</div>
<?php wp_footer(); ?>

<div id="languageoverlay"></div>
<div id="languagebox">
    <div id="languagebody">
        <div>
            <a class="locale locale-ru"></a>
            <a class="locale locale-en"></a>
        </div>
    </div>
</div>

<div class="gallery-overlay">
    <div class="slick-disabler"></div>
    <div class="gallery">
        <div class="lightbox-gallery-item"></div>
    </div>
    <a class='gallery-next'></a>
    <a class='gallery-prev'></a>

    <div class="slick-disabler"></div>
    <div class="about-container"><a class="about-button">{{ t[locale].about_text }}<a></div>
    <div class="about-panel">
        <button class="about-panel-hide">&nbsp;</button>
        <h1>{{ lightbox_title }}</h1>

        <p>{{ lightbox_description }}</p><br><br><br><br><a class="next-button">{{ t[locale].next_text }}<a>
    </div>
    <button class="about-panel-hide">&nbsp;</button>
    <div class="gallery-close"></div>
</div>

<div class="alert-overlay">
    <div class="alert-message">
        <ul>
            <li class="message-error" ng-repeat="error in messages.errors">{{ error }}</li>
            <li class="message-success" ng-repeat="success in messages.success">{{ success }}</li>
        </ul>
            <button class="close-button" type="submit">ok</button>
            <div class="alert-close"></div>
        </div>
    </div>
  </body>
</html>