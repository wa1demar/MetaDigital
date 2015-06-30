<?php

/*
Controller name: General
Controller description: Data manipulation methods for site info
*/

class JSON_API_General_Controller
{

    public function get_site_info()
    {

        global $json_api;
        $lang = $json_api->query->lang;
        if (!$lang) $lang = 'ru';

        $posts_list = get_posts(array(
            'post_type' => 'siteinfo',
            'lang' => $lang
        ));

        $info = array();

        for ($i = 0; $i < count($posts_list); $i++) {
            $l['description'] = $posts_list[$i]->post_content;
            $l['lang'] = $lang;

            array_push($info, $l);
            unset($l);

        }

        return $info;
    }

    public function contact_us()
    {
        global $json_api;

        $username = $json_api->query->username;
        $useremail = $json_api->query->useremail;
        $usertext = $json_api->query->usertext;
        $lang = $json_api->query->lang;
        if (!$lang) $lang = 'ru';

        $messages = array(
            'ru' => array(
                'error_username' => "Имя состоит из менее чем трёх символов",
                'error_useremail' => "Емейл не указан или указан неверно",
                'error_usertext' => "Сообщение содержит меньше пяти слов или меньше десяти символов",
                'error_other' => "Ошибка при отправке сообщения",
                'success' => "Спасибо, что связались с нами. Вам обязательно ответят."
            ),
            'en' => array(
                'error_username' => "The name consists of fewer than three characters",
                'error_useremail' => "Email Unknown or invalid",
                'error_usertext' => "The message contains less than five words or less ten characters",
                'error_other' => "Error sending message",
                'success' => "Thank you for contacting us. You will answer."
            )
        );

        $result = "";
        $result['errors'] = array();

        if (!$username || strlen($username) < 3) {
            array_push($result['errors'], $messages[$lang]['error_username']);
        }

        if (!$useremail || strlen($useremail) < 3 || !filter_var($useremail, FILTER_VALIDATE_EMAIL)) {
            array_push($result['errors'], $messages[$lang]['error_useremail']);
        }

        if (!$usertext || strlen($usertext) < 10 || str_word_count($usertext) < 5) {
            array_push($result['errors'], $messages[$lang]['error_usertext']);
        }

        if (!$result['errors']) {

            $to      = 'zehelloworld@gmail.com';
            $subject = 'MetaDigital';
            $message = $usertext;
            $headers = 'From: info@metadigital.com';

            if (!mail($to, $subject, $message, $headers)) {
                array_push($result['errors'], $messages[$lang]['error_other']);
            } else {
                $result['success'] = array();
                array_push($result['success'], $messages[$lang]['success']);
            }


        }


        return $result;

    }
}