<?php

namespace App\Controllers;

use PDO;
use App\Models\Post;
use App\Models\Comment;

require_once 'app/Controllers/BaseController.php';

class PostController extends BaseController
{
    protected string $tplDir = 'app/Views/';
    protected  Post $post;
    protected $content = '';
    protected $layout = 'layout/index.tpl.php';

    public function __construct(
        protected PDO $conn
       
    ) {
        $this->post = new Post($conn);
    }

  

    public function getPosts(): void
    {
        $posts = $this->post->all();

         $this->content = view('posts', compact('posts'), $this->tplDir);
         
       
    }

    public function show(int $postid): void 
    {
        $post = $this->post->findByPostId($postid);
        $comment = new Comment($this->conn);
        $comments = $comment->all($postid);
        $this->content = view('post', compact('post' ,'comments'));
      
    }

    public function edit(int $postid): void 
    {
       
        $post = $this->post->findByPostId($postid);
        $this->content = view('editPost', compact('post'));
      
    }

    public function create(): void 
    {
       
          $this->content = view('newpost');
      
    }
    
    public function save(?int $postid = null): void
    {
       
        $post = [
            'email' => $_POST['email'] ?? '',
            'title' => $_POST['title'] ?? '',
            'message' => $_POST['message'] ?? '',
        ];

        if (!$postid){
            $this->post->save($post);
        } else {
            $this->post->update($post, $postid);
        }
          
        header('Location:/');
      
    }

    public function delete(int $postid): void
    {

        $this->post->delete($postid);
          
        header('Location:/');
      
    }

    public function saveComment(int $postid): void
    {
       
        $comment = [
            'email' => $_POST['email'] ?? '',
            'comment' => $_POST['comment'] ?? '',
        ];

        $commentObj = new Comment($this->conn);
        $commentObj->save($comment, $postid);
          
        header('Location:/posts/'.$postid);
      
    }

    public function display(): void {
        require $this->layout;
    }
}