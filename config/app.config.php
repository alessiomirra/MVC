<?php 

use App\Controllers\{PostController, LoginController};

return [
    'routes' => [
        'GET' => [
            '/' => [PostController::class, 'getPosts'],
            'posts' => [PostController::class, 'getPosts'],
            'posts/create' => [PostController::class, 'create'],
            'posts/:id' => [PostController::class, 'show'],
            'posts/:id/edit' => [PostController::class, 'edit'], 
            'auth/login' => [LoginController::class, 'showLogin'], 
            'auth/signup' => [LoginController::class, 'showSignup']
        ], 
        'POST' => [
            'posts' => [PostController::class, 'save'], 
            'posts/:id/delete' => [PostController::class, 'delete'], 
            'posts/:id' => [PostController::class, 'save'],
            'posts/:id/comments' => [PostController::class, 'saveComment'], 
            'auth/login' => [LoginController::class, 'login'], 
            'auth/signup' => [LoginController::class, 'signup'],
            'auth/logout' => [LoginController::class, 'logout']
        ]
    ]
];