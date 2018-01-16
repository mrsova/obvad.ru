<?php

namespace App\Http\Controllers\Admin;

use App\Image;
use App\Post;
use function compact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use function redirect;
use function view;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('welcome', compact('posts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $post = Post::add($request->all());
        Image::uploadImages([1, 2, 3], $post->id);
        return redirect()->back();
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        Image::removeImages($post->id);
        $post->remove();
        return redirect()->back();
    }

}
