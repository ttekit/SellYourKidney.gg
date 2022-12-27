<?php
//GLOBAL SETTINGS
const DEVELOP_MODE = true;
const EXT = ".php";
const SEP = "/";
const TITLE = "Sell your kidney";

//DATA BASE SETTINGS
const DB_HOST = 'localhost';
const DB_USER = 'root';
const DB_PASSWORD = '';
const DB_NAME = 'helloworld';

//MAIN PATHS
const ABS_PATH = __DIR__;
const SCR_PATH = ABS_PATH . SEP . "scripts" . SEP;
const ENT_PATH = SCR_PATH . SEP . "static" . SEP;
const INC_PATH = SCR_PATH . SEP . "includes" . SEP;
const IMG_PATH = ABS_PATH . SEP . "images" . SEP;
const CORE_PATH = INC_PATH . SEP . "core" . SEP;
const MODELS_PATH = INC_PATH . SEP . "Models" . SEP;
const CONTROL_PATH = INC_PATH. SEP . "Controllers" . SEP;
const VIEWS_PATH = ABS_PATH . SEP . "view" . SEP;
const PAGES_PATH = VIEWS_PATH. "pages" . SEP;
const COMPONENTS_PATH = VIEWS_PATH. "Components" . SEP;
const ADM_VIEW_PATH = VIEWS_PATH."adminPages".SEP;
const ADM_PAGES_PATH = ADM_VIEW_PATH."pages".SEP;

//VIEW CLIENT PAGES PATHS
const INDEX_PAGES_PATH = PAGES_PATH."Index".SEP;
const BLOG_PAGES_PATH = PAGES_PATH."Blog".SEP;
const CONTACT_PAGES_PATH = PAGES_PATH."Contact".SEP;
const PRODUCTS_PAGES_PATH = PAGES_PATH."Products".SEP;
const USER_PAGES_PATH = PAGES_PATH."User".SEP;
const TESTIMONIAL_PAGES_PATH = PAGES_PATH."Testimonial".SEP;
const ABOUT_PAGES_PATH = PAGES_PATH."About".SEP;

//VIEW ADMIN PAGES PATHS
const ADM_INDEX_PATH = ADM_PAGES_PATH."Index".SEP;
const ADM_BLOG_EDIT_PATH = ADM_PAGES_PATH."BlogEdit".SEP;
const ADM_CONTACT_PATH = ADM_PAGES_PATH."Contact".SEP;
const ADM_PRODUCTS_EDIT_PATH = ADM_PAGES_PATH."ProductsEdit".SEP;
const ADM_USER_PATH = ADM_PAGES_PATH."Users".SEP;
const ADM_INFO_PATH = ADM_PAGES_PATH."Info".SEP;
const ADM_OPTIONS_PATH = ADM_PAGES_PATH."OptionsEdit".SEP;

// IMAGES PARAMS
const SAVED_FILE_EXT = ".jpg";

// IMAGES TYPES
const BLOG_IMAGES_PATH = IMG_PATH."blog".SEP;
const PRODUCT_IMAGES_PATH = IMG_PATH."products".SEP;
const USER_AVATARS_IMAGES_PATH = IMG_PATH."avatars".SEP;



function autoLoadCoreClass($name)
{
    $directories = [
        CORE_PATH,
        ENT_PATH,
        MODELS_PATH,
        CONTROL_PATH,
    ];
    foreach ($directories as $dir) {
        $parts = explode('\\', $name);
        if (file_exists($dir.end($parts).EXT)) {
            require_once $dir . end($parts).EXT;
        }
    }
}
spl_autoload_register("autoLoadCoreClass");


//GLOBAL FUNCTIONS
function varDump($obj){
    echo '<pre>';
    var_dump($obj);
    echo '</pre>';
}

function roundToBigger($num) {
    $tmp = round($num);
echo $tmp;
    if($num > $tmp){
        return $tmp+1;
    }
    else{
        return $tmp;
    }
}