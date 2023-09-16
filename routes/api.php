<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::get('/posts', [PostController::class, 'allPosts']);
Route::post('/post/create', [PostController::class, 'addPost']);
Route::get('/post/show', [PostController::class, 'specificPost']);
Route::post('/post/edit', [PostController::class, 'updatePost']);
Route::post('/post/delete', [PostController::class, 'deletePost']);
//Route::get('/post/restore', [PostController::class, 'specificPost']);

Route::get('/comments', [CommentController::class, 'allComments']);
Route::post('/comment/create', [CommentController::class, 'addComment']);
Route::get('/comment/show', [CommentController::class, 'specificComment']);
Route::post('/comment/edit', [CommentController::class, 'updateComment']);
Route::post('/comment/delete', [CommentController::class, 'deleteComment']);
Route::post('/comment/toggle', [CommentController::class, 'toggleComment']);
