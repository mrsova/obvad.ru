<?php

namespace App\Http\Controllers\Front;

use App\Image;
use App\Post;
use function compact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(10);
        return view('front.index', compact('posts'));
    }

    public function addPost(Request $request)
    {
        $reqPosts = $request->all();
        $post = Post::add($reqPosts);
        foreach($reqPosts as $key=>$itemReq)
        {
            if($request->hasFile($key)) {
                print_r(Image::uploadImages($request->file($key), $post->id));
            }
        }
    }
}
