<?php

namespace AFB\ArtGenerator\Shortcodes;


class AFB_ART_GEN_SHORTCODES{

    public function __construct(){
        add_shortcode("afb_art_generator", array($this,"upload_image_page"));
    }


    public function upload_image_page(){

        ob_start();
        require AFB_ART_GEN_PATH."public/pages/upload-image.php";

        $html= ob_get_contents();
        ob_clean();

        return $html;
    }
}