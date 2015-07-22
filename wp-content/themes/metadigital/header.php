<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="<?php bloginfo('charset'); ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <link rel="shortcut icon" href="/favicon.ico"/>
    <title><?php echo wp_title('|', true, 'right'); ?> <?php bloginfo('name'); ?></title>


    <?php wp_head(); ?>

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
        <img class="logo-image" src="<?php echo THEME_URL ?>/images/meta-digital.png">
<!--        <img class="logo-scroll" src="--><?php //echo THEME_URL ?><!--/images/scroll-icon.svg"-->
<!--             onclick="$('.articles').goTo()">-->
    </div>
    <div class="home-link"><a href="http://metamoscow.com/" target="_blank">
            <img src="<?php echo THEME_URL ?>/images/meta-moskow-logo.svg">
        </a>
    </div>
    <div class="home-icon"><i class="fa fa-home"></i></div>
    <div class="description" >
    </div>
    <video autoplay loop poster="./wp-content/themes/metadigital/images/polina.png" id="bgvid">
        <source src="<?php echo THEME_URL ?>/video/metaspace.webm" type="video/webm">
        <source src="<?php echo THEME_URL ?>/video/metaspace.mp4" type="video/mp4">
        <img src="<?php echo THEME_URL ?>/images/polina.png" />
    </video>
</div>