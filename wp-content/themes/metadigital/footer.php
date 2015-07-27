<div id="gallery">

</div>

<div class="main-footer" id="contact_us" data-map="0">
    <div class="footer-address">
        <div class="footer-address-header">{{ t[locale].moskow }}</div>
        <p> {{ t[locale].address}} <br>
            +74957259669<br>
            info@metamoscow.com</p>

        <ul class="footer-address-header-social-links">
            <li><a target="_blank" href="https://twitter.com/metamoscow"><img src="<?php echo THEME_URL ?>/images/twitter-icon.png"></a></li>
            <li><a target="_blank" href="https://vk.com/wearemeta"><img src="<?php echo THEME_URL ?>/images/vk-icon.png"></a></li>
            <li><a target="_blank" href="https://www.linkedin.com/"><img src="<?php echo THEME_URL ?>/images/linkedin-icon.png"></a></li>
            <li><a target="_blank" href="https://www.facebook.com/pages/META-MOSCOW/1528633020688948"><img src="<?php echo THEME_URL ?>/images/facebook-icon.png"></a></li>
            <li><a target="_blank" href="https://www.behance.net/metamoscow"><img src="<?php echo THEME_URL ?>/images/blogger-icon.png"></a></li>
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


<div id="languageoverlay"></div>
<div id="languagebox">
    <div id="languagebody">
        <div>
            <a class="locale locale-ru" onclick="choose('ru')"></a>
            <a class="locale locale-en" onclick="choose('en')"></a>
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
<?php wp_footer(); ?>
</body>
</html>