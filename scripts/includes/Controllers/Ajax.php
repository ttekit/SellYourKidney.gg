<?php

namespace App;

use Models\blogcategories;
use Models\categories;
use Models\comments;
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
            if (isset($_POST["postId"]) && isset($_POST["login"]) && isset($_POST["email"]) && isset($_POST["message"])) {
                if (isset($_POST["messageId"])) {
                    $messageId = $_POST["messageId"];
                } else {
                    $messageId = "NULL";
                }
                $postId = $_POST["postId"];
                $login = $_POST["login"];
                $email = $_POST["email"];
                $message = $_POST["message"];
                $commentsM = new comments();
                echo $commentsM->insertNewComment($postId, $login, $email, $message, $messageId);
            }
        }
    }

    public function addNewProd()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["name"]) && isset($_POST["content"]) && isset($_POST["price"])) {
                $imgPath = "/images/products/template.png";
                if (isset($_FILES['logo'])) {
                    $uploaddir = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . "products" . DIRECTORY_SEPARATOR;
                    $uploadfile = $uploaddir . basename($_FILES['logo']['name']);
                    if (!move_uploaded_file($_FILES['logo']['tmp_name'], $uploadfile)) {
                        echo "BAG";
                    }
                    $imgPath = "/images/products/" . $_FILES['logo']['name'];
                }
                $blogM = new \Models\products();
                $blogM->addRow([
                    "name" => $_POST["name"],
                    "price" => $_POST["price"],
                    "img_src" => $imgPath,
                    "img_alt" => "/",
                    "content" => $_POST["content"]
                ]);

            }
        }
    }

    public function updateProduct()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["name"]) && isset($_POST["content"]) && isset($_POST["price"]) && isset($_POST["id"])) {
                $imgPath = "/images/products/template.png";
                varDump($_FILES);

                if (isset($_FILES['logo'])) {
                    $uploaddir = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . "products" . DIRECTORY_SEPARATOR;
                    $uploadfile = $uploaddir . basename($_FILES['logo']['name']);
                    if (!move_uploaded_file($_FILES['logo']['tmp_name'], $uploadfile)) {
                        echo "BAG";
                    }
                    $imgPath = "/images/products/" . $_FILES['logo']['name'];
                }

                $blogM = new \Models\products();
                $blogM->updateRow($_POST["id"], [
                    "name" => $_POST["name"],
                    "price" => $_POST["price"],
                    "img_src" => $imgPath,
                    "img_alt" => "/",
                    "content" => $_POST["content"]
                ]);

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
}
