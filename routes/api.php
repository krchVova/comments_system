<?php

use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Route::namespace('Api')->group(function (Router $router) {
    $router->apiResource('comment', 'CommentController');
});
