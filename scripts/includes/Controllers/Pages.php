<?php

namespace App;

class Pages extends Controller
{
    public function index(){
        $this->format_options();
        $this->returnNavigationPanel();
        View::render(VIEWS_PATH."template".EXT, INDEX_PAGES_PATH."mainIndex".EXT, $this->data);
    }
    public function about(){
        $this->format_options();
        $this->returnNavigationPanel();
        $this->data["title"] = "About us";
        View::render(VIEWS_PATH."template".EXT, ABOUT_PAGES_PATH."mainAbout".EXT, $this->data);
    }
    public function testimonial(){
        $this->format_options();
        $this->returnNavigationPanel();
        $this->data["title"] = "testimonial";
        View::render(VIEWS_PATH."template".EXT, TESTIMONIAL_PAGES_PATH."mainTestimonial".EXT, $this->data);
    }

}