<?php

namespace App;

use DateTime;
use http\Header;
use Models\blogcategories;
use Models\categories;
use Models\post;
use Models\posttages;
use Models\tags;
use Models\userAcc;

class User extends Controller
{
    public function index()
    {
        $this->format_options();
        $this->returnNavigationPanel();
        $this->format_userData();
        if ($this->CheckOnLogin()) {
            $this->UserCabinetView();
        } else {
            $this->LoginUserView();
        }

    }

    public function LoginUser()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["login"]) && isset($_POST["password"])) {
                $this->data["error"] = null;
                $login = htmlspecialchars(trim($_POST["login"]));

                if ($this->data["error"] == null) {
                    $userDB = new userAcc();
                    $userAcc = $userDB->getByLogin($login);
                    if ($userAcc == null) {
                        $this->data["error"]["user"] = "Incorrect data";
                        $this->LoginUserView();
                    } else {
                        $this->data["success"] = "Thank you very much! Your message is very important to us!";
                        $_SESSION["reg"]["login"] = $login;
                        $_SESSION["reg"]["userId"] = $userAcc["id"];
                        $_SESSION["reg"]["user_Ip"] = $_SERVER["REMOTE_ADDR"];
                        $_SESSION["reg"]["role"] = "user";
                        header("Location: /user/");
                    }
                } else {
                    $this->LoginUserView();
                }
            }
        } else {
            header('Location: /user');
        }
    }

    public function RegUser()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["login"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["passwordConfirm"])) {
                $this->data["error"] = null;
                $login = htmlspecialchars(trim($_POST["login"]));
                $email = htmlspecialchars(trim($_POST["email"]));
                $password = htmlspecialchars(trim($_POST["password"]));
                $passwordConfirm = htmlspecialchars(trim($_POST["passwordConfirm"]));
                $userDB = new userAcc();
                if (!Validator::email($email)) {
                    $this->data["error"]["email"] = "email is incorrect";
                    if ($userDB->getByEmail($email) != null) {
                        $this->data["error"]["accReg"] = "This email has been registered";
                    }
                }
                if (strlen($password) < 8 || strlen($password) > 24) {
                    $this->data["error"]["password"] = "Password must to be from 8 to 24 symbols";
                }
                if ($passwordConfirm != $password) {
                    $this->data["error"]["passwordConfirm"] = "Passwords do not match";
                }
                if ($this->data["error"] == null) {

                    $userDB = new userAcc();
                    $userDB->AddNewUser([
                        "login" => $login,
                        "email" => $email,
                        "password" => hash('sha256', $password)
                    ]);
                    $userAcc = $userDB->getByEmail($email);
                    $this->data["success"] = "Account has been successfully logged!";
                    $_SESSION["reg"]["email"] = $email;
                    $_SESSION["reg"]["userId"] = $userAcc["id"];
                    $_SESSION["reg"]["user_Ip"] = $_SERVER["REMOTE_ADDR"];
                    $_SESSION["reg"]["role"] = "user";
                    header('Location: /user');
                } else {
                    $this->Register();
                }
            }
        }
    }

    public function LoginUserView()
    {
        if (!$this->CheckOnLogin()) {
            $this->format_options();
            $this->returnNavigationPanel();
            View::render(VIEWS_PATH . "noSliderTemplate" . EXT, PAGES_PATH . "mainLogin" . EXT, $this->data);
        } else {
            $this->UserCabinetView();
        }
    }

    public function Edit()
    {
        if (!$this->CheckOnLogin()) {
            $this->format_options();
            $this->returnNavigationPanel();
            View::render(VIEWS_PATH . "noSliderTemplate" . EXT, PAGES_PATH . "mainLogin" . EXT, $this->data);
        } else {
            $this->EditCabinetView();
        }
    }

    private function EditCabinetView()
    {
        $this->format_options();
        $this->returnNavigationPanel();
        $this->format_userData();
        $this->formatSocLinkData();
        View::render(VIEWS_PATH . "noSliderTemplate" . EXT, PAGES_PATH . "editUserCabinet" . EXT, $this->data);
    }

    public function saveEditChanges()
    {

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $userDB = new UserAcc();
            $userDB->updateUserData($_SESSION["reg"]["userId"], $_POST);
        }
        header('Location: /user');
    }

    public function UserCabinetView()
    {
        $this->format_options();
        $this->returnNavigationPanel();
        $this->format_userData();
        $this->formatSocLinkData();
        View::render(VIEWS_PATH . "noSliderTemplate" . EXT, PAGES_PATH . "mainUserCabinet" . EXT, $this->data);
    }

    public function LogOut()
    {
        $_SESSION = [];
        Header("Location: /");
    }

    public function Register()
    {
        if (!$this->CheckOnLogin()) {
            $this->format_options();
            $this->returnNavigationPanel();
            View::render(VIEWS_PATH . "noSliderTemplate" . EXT, PAGES_PATH . "mainRegister" . EXT, $this->data);
        } else {
            $this->UserCabinetView();
        }

    }

    public function writePost()
    {
        if (!$this->CheckOnLogin()) {
            $this->format_options();
            $this->returnNavigationPanel();
            View::render(VIEWS_PATH . "noSliderTemplate" . EXT, PAGES_PATH . "mainRegister" . EXT, $this->data);
        } else {
            $this->AddPostView();
        }
    }

    public function addNewPost()
    {
        if ($this->CheckOnLogin()) {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST["title"]) && isset($_POST["slogan"]) && isset($_POST["content"]) && isset($_POST["category"])) {
                    if(isset($_FILES['logo'])){
                        $uploaddir = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . "products" . DIRECTORY_SEPARATOR;
                        $uploadfile = $uploaddir . basename($_FILES['logo']['name']);
                        if (!move_uploaded_file($_FILES['logo']['tmp_name'], $uploadfile)) {
                            echo "BAG";

                        }
                        $imgPath = "/images/products/" . $_FILES['logo']['name'];
                    }
                    else{
                        $imgPath = "/images/products/template.png";
                    }
                    $blogM = new \Models\post();
                    $dateTime = new DateTime();
                    $blogM->addRow([
                        "title" => $_POST["title"],
                        "slogan" => $_POST["slogan"],
                        "content" => $_POST["content"],
                        "dateOfPublication" => $dateTime->format('Y\-m\-d\ h:i:s'),
                        "imgSrc" => $imgPath,
                        "altSrc" => "",
                        "state" => "created",
                        "author" => $_SESSION["reg"]["userId"]
                    ]);

                    $blogCatsM = new blogcategories();
                    $catsM = new categories();
                    $thisPost = $blogM->getOneRow([
                        "title" => $_POST["title"],
                        "slogan" => $_POST["slogan"],
                        "author" => $_SESSION["reg"]["userId"]
                    ]);

                    $cat = $catsM->getCategoryByCategoryName($_POST["category"]);
                    $blogCatsM->AddElem($thisPost["id"], $cat["id"]);

                    $tagsM = new tags();
                    $blogTagsM = new posttages();
                    $tagsArr = json_decode($_POST["tags"]);
                    foreach ($tagsArr as $key=>$value){
                        varDump($tagsM->getId(["tag"=>$value]));
                        $blogTagsM->AddElem($thisPost["id"], $tagsM->getId(["tag"=>$value]));;
                    }

                    $blogCatsM->AddElem($thisPost["id"], $cat["id"]);

                }
            }
        } else {
            $this->format_options();
            $this->returnNavigationPanel();
            View::render(VIEWS_PATH . "noSliderTemplate" . EXT, PAGES_PATH . "mainRegister" . EXT, $this->data);
        }
    }

    private function CheckOnLogin()
    {
        if (isset($_SESSION["reg"])) {
            if ($_SESSION["reg"]["role"] == "user") {
                return true;
            }
        }
        return false;
    }

    private function format_userData()
    {
        if ($this->CheckOnLogin()) {
            $userDataBase = new userAcc();
            $this->data["userData"] = $userDataBase->getByLogin($_SESSION["reg"]["login"]);
        }
    }

    private function formatSocLinkData()
    {

        $socLinks = new \Models\userSocLincs();
        $socLinksArr = $socLinks->getSocLinksOfUser($_SESSION["reg"]["userId"]);
        $this->data["reg"]["socLinks"] = $socLinksArr;
    }

    private function AddPostView()
    {
        View::render(VIEWS_PATH . "noSliderTemplate" . EXT, PAGES_PATH . "addUserPost" . EXT, $this->data);
    }
}