<?php

namespace App\Http\Controllers\Admin;

use App\Image;
use App\Post;
use function compact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use function preg_replace_array;
use function redirect;
use function view;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'content' => 'required'
        ]);
        $post = Post::add($request->all());

        if($request->hasFile('fileMulti'))
        {
            foreach($request->file('fileMulti') as $file)
            {
                Image::uploadImages($file, $post->id);
            }
        }
        return redirect()->route('posts.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'content' => 'required'
        ]);
        $post = Post::find($id);
        $post->edit($request->all());
        $removeImages = $request->get('removeImg');
        if($removeImages)
        {
            $removeImages = explode(',', $removeImages);
            foreach($removeImages as $item)
            {
                Image::removeImageItem($item);
            }
        }
        if($request->hasFile('fileMulti'))
        {
            foreach($request->file('fileMulti') as $file)
            {
                Image::uploadImages($file, $post->id);
            }
        }
        return redirect()->back();
    }

    /**
     * переключение
     * @param $id
     */
    public function toggle($id)
    {
        $post = Post::find($id);
        $post->toggleStatus();
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
