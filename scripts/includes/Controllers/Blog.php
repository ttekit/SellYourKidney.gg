<?php

namespace App;

use Models\comments;
use Models\post;

class Blog extends Controller
{
    public function index(){
        if(isset($_GET["page"]) && $_GET["page"] != "blog"){
               $this->data["pagination"]["page"] = $_GET["page"];
        }
        else{
            $this->data["pagination"]["page"] = 0;
        }


        if(isset($_GET["count"])){
            $this->data["pagination"]["postsCount"] = $_GET["count"];
        }
        else{
            $this->data["pagination"]["postsCount"] = 3;
        }
        if(isset($_GET["filter"])){
            $this->data["blog"]["filter"] = $_GET["filter"];
        }

        $this->data["href"] = $_SERVER["REQUEST_URI"];
        $this->data["title"] = "Blog";
        $this->format_options();
        $this->returnNavigationPanel();
        $this->format_tags();
        $this->format_categories();
        View::render(VIEWS_PATH."template".EXT, BLOG_PAGES_PATH."mainBlog".EXT, $this->data);
    }

    public function post(){
            if(isset($_GET["id"])){
                $this->data["error"] = null;
                $id = $_GET["id"];
                $postM = new post();
                $onePost = $postM->getPostById($id);
                if(!is_null($onePost)) {
                    $this->data["pageData"] = $onePost;
                    $this->format_options();
                    $this->returnNavigationPanel();
                    $this->format_author($onePost["author"]);
                    $this->data["title"] = "Posts";
                    View::render(VIEWS_PATH . "template" . EXT, BLOG_PAGES_PATH . "postBlog" . EXT, $this->data);
                }
            }
    }



    private function format_author($id){
        $userM = new \Models\userAcc();
        $this->data["blog"]["author"] = $userM->getById($id)[0];
        unset($userM);
    }

    private function format_tags(){
        $filters = new \Models\tags();
        $this->data["posts"]["tags"] = $filters->getAllNotEmptyTegs(0);
        unset($filters);
    }
    private function format_categories(){
        $filters = new \Models\categories();
        $this->data["posts"]["categories"] = $filters->getAllNotEmptyCategories();
        unset($filters);
    }
}