<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\AuthInterface;
use App\Http\Interfaces\CommentInterface;
use App\Http\Resources\CommentResource;
use App\Http\Resources\PostResource;
use App\Http\Traits\ApiDesignTrait;
//use App\Models\role;
use App\Models\Comment;
use App\Models\Media;
use App\Models\Post;
use App\Models\Role;
use App\Models\User;

use App\Http\Interfaces\PostInterface;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class CommentRepository implements CommentInterface {

    use ApiDesignTrait;


    private $commentModel;
    private $mediaModel;


    public function __construct(Comment $comment, Media $media) {

        $this->commentModel = $comment;
        $this->mediaModel = $media;
    }

    public function addComment($request){

           $comment = $this->commentModel::create([
               'content' => $request->content,
              ]);

        if($request->media){
            $mediaUrl = Storage::disk('public')->put('/comment_medias', $request->media);
            $media = new Media();
            $media->type = 'post';
            $media->url = $mediaUrl;
            $media->save();
            $comment->medias()->attach($media->id, ['type'=>'post']);
        }

       return $this->ApiResponse(200, 'Comment Was Created', null, CommentResource::make($comment));
    }

    public function allComments(){

        $comment = $this->commentModel::get();
        return $this->ApiResponse(200, 'Done', CommentResource::collection($comment));
    }

    public function deleteComment($request){
        $comment = $this->commentModel::find($request->comment_id);

        if($comment){
            $comment->delete();
            $mediable = DB::table('mediables')->where('mediable_id', $request->comment_id)->first();
    //          dd($mediable);
            if($mediable){
                $media = $this->mediaModel::find($mediable->media_id);
                unlink(storage_path('app/public/' . $media->url));
                $media->delete();
            }
            return $this->ApiResponse(200, 'Post Was Deleted', null, CommentResource::make($comment));
        }
        return $this->ApiResponse(422, 'This Comment Not Found');
    }


    public function updateComment($request){

        $comment = $this->commentModel::find($request->comment_id);

        $comment->update($request->all());

        if($request->media){
            $mediable = DB::table('mediables')->where('mediable_id', $request->comment_id)->first();
            if($mediable){
                $media = $this->mediaModel::find($mediable->media_id);
                unlink(storage_path('app/public/' . $media->url));
                $mediaUrl = Storage::disk('public')->put('/comment_medias', $request->media);
                $media->url = $mediaUrl;
                $media->save();
            }
        }
            return $this->ApiResponse(200, 'Comment Was Updated', null, CommentResource::make($comment));
        }


    public function specificComment($request){
        $comment = $this->commentModel->find($request->comment_id);
        if($comment){
            return  $this->ApiResponse(200, 'Done', null, CommentResource::make($comment));
        }
        return  $this->ApiResponse(404, 'Not Found');

    }

    public function toggleComment($request){
        $comment = $this->commentModel->find($request->comment_id);
        if($comment) {
            $comment->update([
                'isHidden' => !$comment->isHidden,
            ]);
            return  $this->ApiResponse(200, 'Done', null, CommentResource::make($comment));
        }
        return  $this->ApiResponse(404, 'Not Found');
    }
}
