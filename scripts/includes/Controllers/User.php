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
        if (isset($_GET["id"])) {
            $this->UserCabinetNotOwnerView($_GET["id"]);
        } else {
            $this->UserCabinetView();
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
        if ($this->CheckOnLogin()) {
            $this->UserCabinetView();
        } else {
            $this->format_options();
            $this->returnNavigationPanel();
            $this->data["title"] = "Login";
            View::render(VIEWS_PATH . "noSliderTemplate" . EXT, USER_PAGES_PATH . "mainLogin" . EXT, $this->data);

        }
    }

    public function UpdatePosts()
    {
        if (!$this->CheckOnLogin()) {
            Header("Location: /user/login");
        } else {
            $this->format_options();
            $this->returnNavigationPanel();
            $this->format_userData();
            $this->format_userPosts();
            $this->data["title"] = "Update posts";
            View::render(VIEWS_PATH . "noSliderTemplate" . EXT, USER_PAGES_PATH . "updateUserPosts" . EXT, $this->data);
        }
    }

    public function Edit()
    {
        if (!$this->CheckOnLogin()) {
            Header("Location: /user/login");
        } else {
            $this->EditCabinetView();
        }
    }

    private function EditCabinetView()
    {
        if (!$this->CheckOnLogin()) {
            Header("Location: /user/login");
        } else {

            $this->format_options();
            $this->returnNavigationPanel();
            $this->format_userData();
            $this->formatSocLinkData();
            $this->data["title"] = "Edit cabinet";
            View::render(VIEWS_PATH . "noSliderTemplate" . EXT, USER_PAGES_PATH . "editUserCabinet" . EXT, $this->data);

        }
    }

    public function UserCabinetView()
    {
        if (!$this->CheckOnLogin()) {
            $this->LoginUserView();
        } else {
            $this->format_options();
            $this->returnNavigationPanel();
            $this->format_userData();
            $this->formatSocLinkData();
            $this->data["title"] = "User Cabinet";
            View::render(VIEWS_PATH . "noSliderTemplate" . EXT, USER_PAGES_PATH . "mainUserCabinet" . EXT, $this->data);

        }
    }

    public function UserCabinetNotOwnerView($id)
    {
        $this->format_options();
        $this->returnNavigationPanel();
        $this->format_userDataById($id);
        $this->formatSocLinkDataById($id);
        $this->data["title"] = $this->data["userData"]["FullName"];
        View::render(VIEWS_PATH . "noSliderTemplate" . EXT, USER_PAGES_PATH . "mainUserNotOwnerCabinet" . EXT, $this->data);
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
            $this->data["title"] = "Register";
            View::render(VIEWS_PATH . "noSliderTemplate" . EXT, USER_PAGES_PATH . "mainRegister" . EXT, $this->data);
        } else {
            $this->UserCabinetView();
        }

    }

    public function writePost()
    {
        if (!$this->CheckOnLogin()) {
            $this->format_options();
            $this->returnNavigationPanel();
            $this->data["title"] = "Login";
            View::render(VIEWS_PATH . "noSliderTemplate" . EXT, USER_PAGES_PATH . "mainRegister" . EXT, $this->data);
        } else {
            $this->data["title"] = "Write post";
            $this->AddPostView();
        }
    }

    public function addNewPost()
    {
        if ($this->CheckOnLogin()) {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST["title"]) && isset($_POST["slogan"]) && isset($_POST["content"]) && isset($_POST["category"])) {
                    $blogM = new \Models\post();
                    $dateTime = new DateTime();
                    $blogM->addRow([
                        "title" => $_POST["title"],
                        "slogan" => $_POST["slogan"],
                        "content" => $_POST["content"],
                        "publication-date" => $dateTime->format('Y\-m\-d\ h:i:s'),
                        "img_alt" => "",
                        "state" => "created",
                        "author" => $_SESSION["reg"]["userId"]
                    ]);
                    $thisPost = $blogM->getOneRow([
                        "title" => $_POST["title"],
                        "slogan" => $_POST["slogan"],
                        "author" => $_SESSION["reg"]["userId"]
                    ]);
                    if (isset($_FILES['logo'])) {
                        $_FILES['logo']['name'] = $thisPost["id"];
                        $uploaddir = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . "blog" . DIRECTORY_SEPARATOR;
                        $uploadfile = $uploaddir . basename($_FILES['logo']['name']);
                        if (!move_uploaded_file($_FILES['logo']['tmp_name'], $uploadfile)) {
                            echo "BAG";
                        }
                        $imgPath = "/images/products/" . $_FILES['logo']['name'];
                    } else {
                        $imgPath = "/images/products/template.png";
                    }

                    $blogM->updateRow($thisPost["id"], [
                        "img_src" => $imgPath
                    ]);

                    $blogCatsM = new blogcategories();
                    $catsM = new categories();
                    $cat = $catsM->getCategoryByCategoryName($_POST["category"]);
                    $blogCatsM->AddElem($thisPost["id"], $cat["id"]);

                    $tagsM = new tags();
                    $blogTagsM = new posttages();
                    $tagsArr = json_decode($_POST["tags"]);
                    foreach ($tagsArr as $key => $value) {
                        $blogTagsM->AddElem($thisPost["id"], $tagsM->getId(["tag" => $value]));;
                    }


                }
            }
        } else {
            $this->format_options();
            $this->returnNavigationPanel();
            View::render(VIEWS_PATH . "noSliderTemplate" . EXT, USER_PAGES_PATH . "mainRegister" . EXT, $this->data);
        }
    }

    public function updateOnePost()
    {
        if (isset($_GET["id"])) {
            if ($this->CheckOnLogin()) {
                $blogM = new post();
                $userId = $blogM->getAuthorIdByPostId($_GET["id"])[0]["author"];

                unset($blogM);

                if($_SESSION["reg"]["userId"] == $userId){
                    $this->format_options();
                    $this->format_postData($_GET["id"]);
                    $this->data["title"] = "Update post";
                    View::render(VIEWS_PATH . "noSliderTemplate" . EXT, USER_PAGES_PATH . "mainPostEdit" . EXT, $this->data);
                }
                else{
                  Header("Location: /user/updatePosts");
                }
            }
        }
    }


    private function format_userDataById($id)
    {
        $userDataBase = new userAcc();
        $this->data["userData"] = $userDataBase->getById($id)[0];

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

    private function formatSocLinkDataById($id)
    {
        $socLinks = new \Models\userSocLincs();
        $socLinksArr = $socLinks->getSocLinksOfUser($id);
        $this->data["reg"]["socLinks"] = $socLinksArr;
    }

    private function format_postData($id)
    {
        $blogM = new post();
        $this->data["postData"] = $blogM->getPostById($id);
    }

    private function format_userPosts()
    {
        if (isset($this->data["userData"])) {
            $blogM = new post();
            $this->data["posts"] = $blogM->getPostByAuthorId($this->data["userData"]["id"]);
        }
    }

    private function AddPostView()
    {
        View::render(VIEWS_PATH . "noSliderTemplate" . EXT, USER_PAGES_PATH . "addUserPost" . EXT, $this->data);
    }
}