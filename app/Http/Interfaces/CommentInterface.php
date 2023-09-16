<?php
namespace App\Http\Interfaces;


interface CommentInterface {


    public function addComment($request);

    public function allComments();

    public function deleteComment($request);

    public function specificComment($request);

    public function updateComment($request);

    public function toggleComment($request);

}
