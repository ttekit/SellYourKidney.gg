<?php
    namespace App;
    session_start();
    namespace Models;

    use App\Controller;
    use App\Kernel;

require_once "config.php";
require_once "view/View.php";

    if(DEVELOP_MODE == true){
        error_reporting(E_ALL);

    }
    else{
        error_reporting(0);
    }

    try {
        Kernel::init("");

    }catch (Exception $e){

    }
?>