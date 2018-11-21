<?php

require_once '../app/models/Posts.php';
require_once '../app/views/home/HomeView.php';


class Home extends Controller{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        //get posts
        $post=new Posts();
        $rows=$post->showPosts($this->user->getDB());

        //załaduj widok
        $this->loadView($rows);
        $this->view->render();

    }


    public function getConcretePost($id_post)
    {
        //get concrete post
        $post=new Posts();
        $rows=$post->showPosts($this->user->getDB(), $id_post);
        
        //załaduj widok
        $rows=$rows->fetch();
        $this->loadView($rows);
        $this->view->render('concretePost');
        
    }

}
