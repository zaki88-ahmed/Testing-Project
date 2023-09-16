<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\AuthInterface;
use App\Http\Resources\MediaResource;
use App\Http\Resources\PostResource;
use App\Http\Traits\ApiDesignTrait;
//use App\Models\role;
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

class PostRepository implements PostInterface{

    use ApiDesignTrait;


    private $postModel;
    private $mediaModel;


    public function __construct(Post $post, Media $media) {

        $this->postModel = $post;
        $this->mediaModel = $media;
    }


    public function addPost($request){

           $post = $this->postModel::create([
               'content' => $request->content,
               'status' => $request->status,
              ]);
//           dd($request->media);
//        dd($request->media);
        if($request->media){
//            dd($request->media);
            foreach ($request->media as $media){
                $mediaUrl = Storage::disk('public')->put('/post_medias', $media);
                $media = new Media();
                $media->type = 'post';
                $media->url = $mediaUrl;
                $media->save();
                $post->medias()->attach($media->id, ['type'=>'post']);
            }
        }

       return $this->ApiResponse(200, 'Post Was Created', null, PostResource::make($post));
    }

    public function allPosts(){

        $posts = $this->postModel::get();
        return $this->ApiResponse(200, 'Done', PostResource::collection($posts));
    }

    public function deletePost($request){

        $post = $this->postModel::find($request->post_id);

        if($post){
          $post->delete();
          $mediable = DB::table('mediables')->where('mediable_id', $request->post_id)->first();
//          dd($mediable);
            if($mediable){
                $media = $this->mediaModel::find($mediable->media_id);
                unlink(storage_path('app/public/' . $media->url));
                $media->delete();
          }
          return $this->ApiResponse(200, 'Post Was Deleted', null, PostResource::make($post));
        }
        return $this->ApiResponse(422, 'This Post Not Found');
    }


    public function updatePost($request){

        $post = $this->postModel::find($request->post_id);

        if(!$post){
                return $this->ApiResponse(422,'Validation Error', 'Not Post Exist');
            }
        $post->update($request->all());

        if($request->media){
            $mediable = DB::table('mediables')->where('mediable_id', $request->post_id)->first();
            if($mediable){
                $media = $this->mediaModel::find($mediable->media_id);
                unlink(storage_path('app/public/' . $media->url));
                $mediaUrl = Storage::disk('public')->put('/post_medias', $request->media);
                $media->url = $mediaUrl;
                $media->save();
            }
        }
            return $this->ApiResponse(200, 'Post Was Updated', null, PostResource::make($post));
        }


    public function specificPost($request){

        $post = $this->postModel->find($request->post_id);

//        foreach ($post->medias as $media){
//            dd($media->url);
//        }

//        foreach ($post->medias as $media){
//            return new MediaResource($media);
//        }

        if($post){
            return  $this->ApiResponse(200, 'Done', null, PostResource::make($post));
        }

        return  $this->ApiResponse(404, 'Not Found');


    }
}
