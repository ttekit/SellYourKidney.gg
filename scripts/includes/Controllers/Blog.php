<?php

namespace App;

use Models\comments;
use Models\post;

class Blog extends Controller
{
    public function index(){
        if(isset($_GET["page"]) && is_int($_GET["page"])){
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
        $this->format_posts();
        $this->format_tags();
        $this->format_categories();
        View::render(VIEWS_PATH."template".EXT, PAGES_PATH."mainBlog".EXT, $this->data);
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
                    $this->data["title"] = "Posts";
                    View::render(VIEWS_PATH . "template" . EXT, PAGES_PATH . "postBlog" . EXT, $this->data);
                }
            }
    }


    private function format_posts(){
        $posts = new \Models\post();
        $this->data["blog"]["posts"] = $posts->getAllPosts();
        unset($posts);
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