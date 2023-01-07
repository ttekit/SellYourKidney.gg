<?php

namespace App;

use Models\categories;
use Models\post;
use Models\posttages;
use Models\tags;

class AdminAjax extends Controller
{
    public function index()
    {
        return null;
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
                    "img_src" => "/images/default.jpg",
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
                    $imgPath = "/images/products/" . $_FILES['logo']['name'];
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
                    $imgPath = "/images/products/" . $_FILES['logo']['name'];

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

                    $imgPath = "/images/blog/" . $_FILES['logo']['name'];
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


    public function banUser()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["id"])) {
                $userM = new \Models\userAcc();
                $blogM = new \Models\post();
                $socLinkM = new \Models\userSocLincs();
                $blogM->removeAllUserPosts($_POST["id"]);
                $socLinkM->removeAllUserSocLinks($_POST["id"]);
                $result = $userM->removeUser($_POST["id"]);
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

}
