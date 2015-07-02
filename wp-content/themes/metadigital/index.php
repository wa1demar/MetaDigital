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
            <li><a href="#top" class="to-main"></a><div class="tooltip">{{ t[locale].sidebar_top }}</div></li>
            <li><a href="#services" class="to-articles"></a><div class="tooltip">{{ t[locale].sidebar_services }}</div></li>
            <li><a href="#gallery" class="to-gallery"></a><div class="tooltip">{{ t[locale].sidebar_works }}</div></li>
            <li><a href="#contact_us" class="to-main-footer"></a><div class="tooltip">{{ t[locale].sidebar_contacts }}</div></li>
        </ul>
    </div>

    <div class="main" id="main">
      <div class="home-link">
        <img src="./wp-content/themes/metadigital/images/meta-moskow-logo.svg">
      </div>
      <div class="home-icon"><i class="fa fa-home"></i></div>
      <div class="logo">
        <img class="logo-image" src="./wp-content/themes/metadigital/images/meta-moskow-logo.png">
        <img class="logo-scroll" src="./wp-content/themes/metadigital/images/scroll-icon.svg" onclick="$('.articles').goTo()">
      </div>
      <div class="description">
      </div>
      <video preload="none" autoplay="autoplay" loop="loop">
          <source src="./wp-content/themes/metadigital/video/metaspace.mp4" type="video/mp4" codecs="avc1.42E01E, mp4a.40.2">
      </video>
    </div>
    <div class="articles" id="articles">
      <div class="category {{ $parent.current_category != category ? '' : 'active' }}" ng-repeat="category in categories" ng-click="$parent.current_category = category; $parent.current_post = $parent.current_category.posts[0];">
        <div class="item">
          <span class="icon">
            <img ng-src="{{ $parent.current_category != category ? category.icons.default : category.icons.active }}">
          </span>
          <br>
          <span class="title">{{ category.name }}</span>
        </div>
      </div>
      <div style="clear: left"></div>
    </div>
    <div class="articles-drilldown">
      <div class="articles-list">
        <ul>
          <li ng-repeat="post in current_category.posts" ng-click="$parent.current_post = post" class="{{ $parent.current_post != post ? '' : 'active' }}">{{ post.title }}</li>
        </ul>
      </div>
      <div class="articles-content">
          <div class="articles-body">
              <div class="articles-header">
                  {{ current_category.name }}
              </div>
              <div style="margin-bottom: 130px;" ng-bind-html="getHtml(current_post.content)"></div>
          </div>
      </div>
      <div class="bottom-gradient"></div>
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
                <li><a href="#"><img src="<?php echo THEME_URL?>/images/twitter-icon.png"></a> </li>
                <li><a href="#"><img src="<?php echo THEME_URL?>/images/vk-icon.png"></a> </li>
                <li><a href="#"><img src="<?php echo THEME_URL?>/images/linkedin-icon.png"></a> </li>
                <li><a href="#"><img src="<?php echo THEME_URL?>/images/facebook-icon.png"></a> </li>
                <li><a href="#"><img src="<?php echo THEME_URL?>/images/blogger-icon.png"></a> </li>
            </ul>
        </div>

        <div class="footer-contact-us">
            <p>{{ t[locale].contact_us}}</p>
            <form class="footer-contact-us-inputs">
                <div class="inputs">
                    <input id="username" name="username" type="text" placeholder="{{ t[locale].name}}">
                </div>
                <div class="inputs">
                    <input id="useremail" name="useremail" type="text" placeholder="{{ t[locale].email}}">
                </div>
                <div class="inputs">
                    <textarea rows="3" cols="26" id="useretext" name="useretext" type="text" placeholder="{{ t[locale].feadback_text}}"></textarea>
                </div>
                <input class="contact-us-send-button" name="send" type="submit" value="{{ t[locale].send_button}}">
            </form>
        </div>
        <div class="footer-google-link">
            <a href="#"></a>
        </div>
    </div>

    <div class="footer-bottom-image">
        <img src="<?php echo THEME_URL?>/images/meta-moskow-logo-small.png">
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

  </body>
</html>