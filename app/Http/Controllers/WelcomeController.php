<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Tag;

class WelcomeController extends Controller
{
    public function index(){
        return view('welcome')
        ->with('posts', Post::search())
        ->with('categories', Category::all())
        ->with('tags', Tag::all());
    }

    public function categories(Category $category){
        return view('welcome')
            ->with('category', $category)
            ->with('posts', $category->posts()->search())
            ->with('categories', Category::all())
            ->with('tags', Tag::all());
    }

    public function tags(Tag $tag){
        return view('welcome')
            ->with('tag', $tag)
            ->with('posts', $tag->posts()->search())
            ->with('categories', Category::all())
            ->with('tags', Tag::all());
    }
}
