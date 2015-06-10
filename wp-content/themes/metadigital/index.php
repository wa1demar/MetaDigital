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
  <body>
    <div class="main">
      <div class="home-link">
        <img src="./wp-content/themes/metadigital/images/meta-moskow-logo.svg"">
      </div>
      <div class="home-icon"><i class="fa fa-home"></i></div>
      <div class="logo">
        <img src="./wp-content/themes/metadigital/images/meta-moskow-logo.png"">
      </div>
      <div class="description">
      </div>
      <video preload="none" autoplay="autoplay" loop="loop">
          <source src="./wp-content/themes/metadigital/video/metaspace.mp4" type="video/mp4" codecs="avc1.42E01E, mp4a.40.2">
      </video>
    </div>
    <div class="articles">
      <div class="category">
        <div class="item">
          <span class="icon">
            <img src="./wp-content/themes/metadigital/images/marketing-icon.png"">
          </span>
          <br>
          ИНТЕРНЕТ-МАРКЕТИНГ
        </div>
      </div>
      <div class="category">
        <div class="item">
          <span class="icon">
            <img src="./wp-content/themes/metadigital/images/device-icon.png"">
          </span>
          <br>
          ДЕВАЙС?
        </div>
      </div>
      <div class="category">
        <div class="item">
          <span class="icon">
            <img src="./wp-content/themes/metadigital/images/design-icon.png"">
          </span>
          <br>
          WEB-ДИЗАЙН
        </div>
      </div>
      <div class="category">
        <div class="item">
          <span class="icon">
            <img src="./wp-content/themes/metadigital/images/bitrix-icon.png"">
          </span>
          <br>
          ПРОДУКТЫ 1C БИТРИКС
        </div>
      </div>
      <div class="category">
        <div class="item">
          <span class="icon">
            <img src="./wp-content/themes/metadigital/images/applications-icon.png"">
          </span>
          <br>
          РАЗРАБОТКА ПРИЛОЖЕНИЙ
        </div>
      </div>
      <div class="category">
        <div class="item">
          <span class="icon">
            <img src="./wp-content/themes/metadigital/images/outstuffing-icon.png"">
          </span>
          <br>
          АУСТАФФИНГ
        </div>
      </div>
      <div style="clear: left"></div>
    </div>
    <?php wp_footer(); ?>
  </body>
</html>