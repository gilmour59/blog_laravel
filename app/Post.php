<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'description', 'content', 'image', 'published_at', 'category_id', 'user_id'];

    public function deleteImage(){
        Storage::delete($this->image);
    }

    public function category(){
        return $this->belongsTo('App\Category');
    }

    public function tags(){
        return $this->belongsToMany('App\Tag');
    }

    public function hasTag($tagId){
        return in_array($tagId, $this->tags->pluck('id')->toArray());
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function scopeSearch($query){

        $search = request()->query('search');

        if($search) {
            return $query->where('title', 'like', '%'. $search .'%')
                ->orWhere('content', 'like', '%'. $search .'%')
                ->simplePaginate(1);
        }else{
            return $query->simplePaginate(1);
        }
    }

    public function scopePublish($query){
        return $query;
    }
}
