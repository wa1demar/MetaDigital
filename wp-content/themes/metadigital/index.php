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
      <video preload="none" autoplay="autoplay" loop="loop">
          <source src="./wp-content/themes/metadigital/video/metaspace.mp4" type="video/mp4" codecs="avc1.42E01E, mp4a.40.2">
      </video>
    </div>
    <?php wp_footer(); ?>
  </body>
</html>