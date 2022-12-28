<?php

namespace App;

use Models\categories;
use Models\comments;
use Models\contactInfo;
use Models\post;
use Models\posttages;
use Models\tags;
use Models\userAcc;
use Models\userSocLincs;

class Ajax extends Controller
{
    public function index()
    {
        return null;
    }


    public function getComments()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["postId"])) {
                $id = $_POST["postId"];
                $commentsM = new comments();

                echo json_encode($commentsM->getById($id), JSON_UNESCAPED_UNICODE);
            }

        } else {
            echo "error?";
        }
    }

    public function getCommentsAndSubComments()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["postId"])) {
                $id = $_POST["postId"];
                $commentsM = new comments();

                echo json_encode($commentsM->getAllById($id), JSON_UNESCAPED_UNICODE);
            }

        } else {
            echo "error?";
        }
    }

    public function getSubComments()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["parentId"])) {
                $parentId = $_POST["parentId"];
                $commentsM = new comments();
                echo json_encode($commentsM->getSubCommentsBParentId($parentId), JSON_UNESCAPED_UNICODE);
            }

        } else {
            echo "ok";
        }
    }

    public function saveComment()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["postId"]) && isset($_POST["login"]) && isset($_POST["email"]) && isset($_POST["message"]) && isset($_POST["avatar"])) {
                if (isset($_POST["messageId"])) {
                    $messageId = $_POST["messageId"];
                } else {
                    $messageId = "NULL";
                }
                $postId = $_POST["postId"];
                $login = $_POST["login"];
                $email = $_POST["email"];
                $message = $_POST["message"];
                $ip = $_SERVER['REMOTE_ADDR'];
                $avatar = $_POST["avatar"];
                $commentsM = new comments();
                echo $commentsM->insertNewComment($postId, $login, $email, $message, $messageId, $ip, $avatar);
            }
        }
    }


    public function addNewProd()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["name"]) && isset($_POST["content"]) && isset($_POST["price"])) {
                $prodM = new \Models\products();
                $prodM->addRow([
                    "name" => $_POST["name"],
                    "price" => $_POST["price"],
                    "img_alt" => "/",
                    "content" => $_POST["content"]
                ]);
                $prodData = $prodM->getOneRow([
                    "name" => $_POST["name"],
                    "price" => $_POST["price"],
                    "content" => $_POST["content"]
                ]);
                if (isset($_FILES['logo'])) {
                    $_FILES["logo"]["name"] = $prodData["id"] . SAVED_FILE_EXT;
                    $uploadfile = PRODUCT_IMAGES_PATH . basename($_FILES['logo']['name']);
                    if (!move_uploaded_file($_FILES['logo']['tmp_name'], $uploadfile)) {
                        echo "BAG";
                    }
                    $imgPath = "/images/products/" . $_FILES['logo']['name'] . SAVED_FILE_EXT;
                    $prodM->updateRow($prodData["id"], [
                        "img_src" => $imgPath
                    ]);
                }


            }
        }
    }

    public function updateProduct()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["name"]) && isset($_POST["content"]) && isset($_POST["price"]) && isset($_POST["id"])) {
                $imgPath = "/images/products/template.png";
                $prodM = new \Models\products();
                if (isset($_FILES['logo']) && $_FILES["logo"] != "") {
                    $_FILES["logo"]["name"] = $_POST["id"] . SAVED_FILE_EXT;
                    $uploadfile = PRODUCT_IMAGES_PATH . basename($_FILES['logo']['name']);
                    if (!move_uploaded_file($_FILES['logo']['tmp_name'], $uploadfile)) {
                        echo "BAG";
                    }
                    $imgPath = "/images/products/" . $_FILES['logo']['name']. SAVED_FILE_EXT;

                    $prodM->updateRow($_POST["id"], [
                        "img_src" => $imgPath,
                        "img_alt" => "/"
                    ]);
                }


                $prodM->updateRow($_POST["id"], [
                    "name" => $_POST["name"],
                    "price" => $_POST["price"],
                    "content" => $_POST["content"]
                ]);

            }
        }
    }

    public function deleteOneProduct()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["prodId"])) {
                $prodM = new \Models\products();
                $result = $prodM->deleteProduct($_POST["prodId"]);
                echo json_encode($result, JSON_UNESCAPED_UNICODE);
            }
        }
    }

    public function searchProduct()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["value"])) {
                $prodM = new \Models\products();
                $result = $prodM->getByPartlyName($_POST["value"], 6);
                echo json_encode($result);
            }
        }
    }

    public function GetByPrice()
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            if (isset($_GET["min"]) && isset($_GET["max"])) {
                echo $_GET["min"];
                echo $_GET["max"];
                $prodM = new \Models\products();
                $result = $prodM->getByPriceLimits($_GET["min"], $_GET["max"]);
                echo json_encode($result);
            }
        }
    }


    public function deleteOnePost()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["postId"])) {
                $postM = new post();
                $postM->removeOnePost($_POST["postId"]);
                echo "POST_REMOVED";
            }
        }
    }

    public function updatePostStatus()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["postId"]) && isset($_POST["newStatus"])) {
                $postData = $_POST;
                $postM = new post();
                $result = $postM->updateRow($postData["postId"], [
                    "state" => $postData["newStatus"]
                ]);
                echo $result;
            }
        }
    }

    public function getPostsCount()
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $postM = new post();
            echo $postM->getAllPostsCount()["0"]["COUNT(*)"];
        }
    }

    public function updatePost()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["name"]) && isset($_POST["slogan"]) && isset($_POST["content"]) && isset($_POST["tags"]) && isset($_POST["categories"])) {
                $postM = new post();

                if (isset($_FILES['logo'])) {
                    $_FILES['logo']['name'] = $_POST["id"] . SAVED_FILE_EXT;

                    $uploadfile = BLOG_IMAGES_PATH . basename($_FILES['logo']['name']);

                    if (!move_uploaded_file($_FILES['logo']['tmp_name'], $uploadfile)) {
                        echo "BAG";
                    }

                    $imgPath = "/images/blog/" . $_FILES['logo']['name'] . SAVED_FILE_EXT;
                    echo($postM->updateRow($_POST["id"], [
                        "img_src" => $imgPath
                    ]));
                }


                $postM->updateRow($_POST["id"], [
                    "title" => $_POST["name"],
                    "slogan" => $_POST["slogan"],
                    "content" => $_POST["content"],
                    "img_alt" => "/"
                ]);

                $categoriesM = new categories();
                $catId = $categoriesM->getCategoryByCategoryName($_POST["categories"])["id"];
                echo $categoriesM->updatePostcategory($_POST["id"], $catId);

                $tagM = new tags();
                $postTagM = new posttages();
                $tagsArr = json_decode($_POST["tags"]);
                $tagM->removeAllTagsOfPostById($_POST["id"]);
                foreach ($tagsArr as $key => $tag) {
                    $id = $tagM->getTagIdByTag($tag);
                    echo $postTagM->AddElem($_POST["id"], $id)[0];
                }
            }
        }
    }

    public function getLimitCountOfPosts()
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            if (isset($_GET["posts-count"]) && isset($_GET["startPos"]) && isset($_GET["category"]) && isset($_GET["tag"])) {
                $blogM = new post();
                $res = $blogM->getPost($_GET["startPos"], $_GET["posts-count"], $_GET["category"], $_GET["tag"]);
                echo json_encode($res, JSON_UNESCAPED_UNICODE);
            }

        } else {
            echo "error?";
        }
    }


    public function addNewSocLinkData()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["name"]) && isset($_POST["link"]) && isset($_POST["userId"])) {
                $userSocLinkArr = new userSocLincs();
                $result = $userSocLinkArr->addSocLinkToUser($_POST["link"], $_POST["name"], $_POST["userId"]);
                if ($result[0] == 1) {
                    echo json_encode([
                        "name" => $_POST["name"],
                        "link" => $_POST["link"]
                    ]);
                }
                echo "";
            }
        }
    }

    public function removeSocLinkById()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["id"])) {
                $userSocLinkArr = new userSocLincs();
                $result = $userSocLinkArr->removeSocLinkById($_POST["id"]);
                echo $result;
            }
        }
    }

    public function updateUserData()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $userDB = new UserAcc();
            $userDB->updateUserData($_SESSION["reg"]["userId"], [
                "fullName" => $_POST["FullName"],
                "phone" => $_POST["Phone"],
                "mobile" => $_POST["Mobile"],
                "address" => $_POST["Address"],
                "job" => $_POST["Job"],
            ]);
            if (isset($_FILES["avatar"])) {
                if ($_FILES["avatar"] != "undefined") {
                    $_FILES["avatar"]["name"] = $_SESSION["reg"]["userId"];
                    $uploaddir = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . "avatars" . DIRECTORY_SEPARATOR;
                    $uploadfile = $uploaddir . basename($_FILES['avatar']['name']);
                    if (!move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadfile)) {
                        echo "BAG";
                    }
                    $imgPath = "/images/avatars/" . $_FILES['avatar']['name'];
                    $userDB->updateRow($_SESSION["reg"]["userId"], [
                        "avatar" => $imgPath
                    ]);
                }
            }
            unset($userDB);
        }
    }

    public function getCategory()
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            if (isset($_GET["postId"])) {
                $postData = $_GET;
                $categories = new categories();
                $result = $categories->getCategoryByPostId($postData["postId"]);
                echo json_encode($result, JSON_UNESCAPED_UNICODE);
            }
        }
    }

    public function getAllCategories()
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $categories = new categories();
            $result = $categories->getManyRows();
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
        }
    }


    public function getTags()
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            if (isset($_GET["postId"])) {
                $postData = $_GET;
                $tagsM = new tags();

                $result = $tagsM->getByPostId($postData["postId"]);
                echo json_encode($result, JSON_UNESCAPED_UNICODE);
            }
        }
    }

    public function getAllTags()
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $tagsM = new tags();
            $result = $tagsM->getManyRows();
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
        }
    }

    public function banUser()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["id"])) {
                $prodM = new \Models\userAcc();
                $result = $prodM->removeUser($_POST["id"]);
                echo json_encode($result, JSON_UNESCAPED_UNICODE);
            }
        }
    }

    public function findUserByLogin()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["login"])) {
                $prodM = new \Models\userAcc();
                $result = $prodM->getByLogin($_POST["login"]);
                echo json_encode($result);
            }
        }
    }

    public function getUserData()
    {
        if ($this->CheckOnLogin()) {
            $userDataBase = new userAcc();
            echo json_encode($this->data["userData"] = $userDataBase->getByLogin($_SESSION["reg"]["login"]));
        }
    }

    public function getFavorites()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["fav"])) {
                $dataArr = json_decode($_POST["fav"]);

                $result = [];
                $productM = new \Models\products();

                foreach ($dataArr as $key => $val) {
                    array_push($result, $productM->getByIdWithoutContent($val));
                }

                echo json_encode($result);
            }
        }
    }
    public function removeContactInfo(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["id"])) {
                $contUsM = new contactInfo();
                echo($contUsM->removeRow($_POST["id"]));
            }
        }
    }

    public function sendEmail(){
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            if(isset($_POST["reciver"]) && isset($_POST["message"])){
               return(mail($_POST["reciver"],"Answer", $_POST["message"]));
            }
        }
    }

}
