<?php

namespace App\Controllers;

use App\Models\Post;
use App\Models\Comment;
use PDO;

class PostController extends BaseController {

    protected Post $post;

    public function __construct(
            protected PDO $conn
    ) {
        parent::__construct($conn);
        $this->post = new Post($conn);
    }

    private function redirectIfNotLoggedIn() {
        if (!isUserLoggedin()) {
            redirect('/auth/login');
        }
    }

    public function getPosts(): void {
        $posts = $this->post->all();

        $this->content = view('posts', compact('posts'), $this->tplDir);
    }

    public function show(int $postid): void {
        $post = $this->post->findByPostId($postid);
        $comment = new Comment($this->conn);
        $comments = $comment->all($postid);
        $this->content = view('post', compact('post', 'comments'));
    }

    public function edit(int $postid): void {

        $this->redirectIfNotLoggedIn();
        $post = $this->post->findByPostId($postid);
        $this->content = view('editpost', compact('post'));
    }

    public function create(): void {

        $this->redirectIfNotLoggedIn();
        $this->content = view('newpost');
    }

    public function save(?int $postid = null): void {

        $this->redirectIfNotLoggedIn();
        $post = [
            'user_id' => getUserId(),
            'email' => $_POST['email'] ?? '',
            'title' => $_POST['title'] ?? '',
            'message' => $_POST['message'] ?? '',
        ];

        if (!$postid) {
            $this->post->save($post);
        } else {
            $this->post->update($post, $postid);
        }

        redirect('/');
    }

    public function saveComment(int $postid): void {
        
        $comment = [
        'post_id' => $postid,
        'user_id' => getUserId(),
        'email' => $_POST['email'] ?? '',
        'comment' => $_POST['comment'] ?? '',
        ];
        $commentObj = new Comment($this->conn);

        $commentObj->save($comment);

        redirect('/posts/' . $postid);
    }

    public function delete(int $postid): void {

        $this->redirectIfNotLoggedIn();

        $this->post->delete($postid);

        redirect('/');
    }

    public function display(): void {
        require $this->layout;
    }

}
