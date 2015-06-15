<?php

/**
 * @author: Vladimir Martynyuk
 */
class JSON_API_General_Controller
{

    public function get_site_info()
    {

        return get_bloginfo('description', 'display');
    }
}