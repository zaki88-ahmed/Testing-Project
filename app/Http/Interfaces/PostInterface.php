<?php
namespace App\Http\Interfaces;


interface PostInterface {


    public function addPost($request);

    public function allPosts();

    public function updatePost($request);

    public function deletePost($request);

    public function specificPost($request);

}
