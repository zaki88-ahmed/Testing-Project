<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $url = [];
        foreach ($this->medias as $media){
            $url[] = new MediaResource($media);
//            return new MediaResource($media);
        }

//        return parent::toArray($request);
        return [
            'content' => $this->content,
            'status' => $this->status,
            'media' => $url,
//            'media' => $this->when($this->medias()->exists(), $this->medias),
//            'media' => $this->when($this->medias()->exists(), $this->medias->url),
//            'media' => new MediaResource($this->medias),
//            'media' => $this->when($this->medias()->exists(), $this->medias->url) ? $this->when($this->medias()->exists(), $this->medias->url) : 'null',
//            'media' => $this->medias->each(function ($key , $media){
////                return $media;
////                return $media['url'];
////                return $key->first();
//                return new MediaResource($key->first());
////                return new MediaResource($media);
////                return ($key->url);
////                return $media->url;
//            }),
        ];
    }
}
