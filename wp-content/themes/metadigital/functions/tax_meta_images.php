<?php
/**
 * @author: Vladimir Martynyuk
 */


$config = array(
    'id' => 'services_icon_meta_box',                         // meta box id, unique per meta box
    'title' => 'Services Icon',                      // meta box title
    'pages' => array('services_category'),           // taxonomy name, accept categories, post_tag and custom taxonomies
    'context' => 'normal',                           // where the meta box appear: normal (default), advanced, side; optional
    'fields' => array(),                             // list of meta fields (can be added by field arrays)
    'local_images' => true,                         // Use local or hosted images (meta box images for add/remove)
    'use_with_theme' => true                        //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
);

$my_meta = new Tax_Meta_Class($config);

$my_meta->addImage('image_field_id',array('name'=> 'Default Icon '));
$my_meta->addImage('active_image_field_id',array('name'=> 'Active Icon '));


$my_meta->Finish();
