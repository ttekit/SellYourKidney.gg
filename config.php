<?php
const DEVELOP_MODE = true;
const EXT = ".php";

const ADPASS = "admin";
const ADMAIL = "admin@mailh.com";

const ICON = "/assets/img/logo.ico";
const TITLE = "Sell your kidney";

const DB_HOST = 'localhost';
const DB_USER = 'root';
const DB_PASSWORD = '';
const DB_NAME = 'helloworld';

const SEP = "/";

const ABS_PATH = __DIR__;
const SCR_PATH = ABS_PATH . SEP . "scripts" . SEP;
const ENT_PATH = SCR_PATH . SEP . "static" . SEP;
const INC_PATH = SCR_PATH . SEP . "includes" . SEP;
const CORE_PATH = INC_PATH . SEP . "core" . SEP;
const MODELS_PATH = INC_PATH . SEP . "Models" . SEP;
const CONTROL_PATH = INC_PATH. SEP . "Controllers" . SEP;
const VIEWS_PATH = ABS_PATH . SEP . "view" . SEP;
const PAGES_PATH = VIEWS_PATH. "pages" . SEP;
const COMPONENTS_PATH = VIEWS_PATH. "Components" . SEP;
const ADM_PAGES_PATH = VIEWS_PATH."adminPages".SEP;
const ADM_ALL_PAGES_PATH = ADM_PAGES_PATH."pages".SEP;

const INDEX_PAGES_PATH = PAGES_PATH."Index".SEP;
const BLOG_PAGES_PATH = PAGES_PATH."Blog".SEP;
const CONTACT_PAGES_PATH = PAGES_PATH."Contact".SEP;
const PRODUCTS_PAGES_PATH = PAGES_PATH."Products".SEP;
const USER_PAGES_PATH = PAGES_PATH."User".SEP;
const TESTIMONIAL_PAGES_PATH = PAGES_PATH."Testimonial".SEP;
const ABOUT_PAGES_PATH = PAGES_PATH."About".SEP;

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

function varDump($obj){
    echo '<pre>';
    var_dump($obj);
    echo '</pre>';
}
function str_contains($haystack, $needle) {
    return $needle !== '' && mb_strpos($haystack, $needle) !== false;
}