<?php

namespace App\Http\Controllers\Front;

use App\Post;
use function compact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(10);
        return view('front.index', compact('posts'));
    }

    public function addPost()
    {
        
    }
}
