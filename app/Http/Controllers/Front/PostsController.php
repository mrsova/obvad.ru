<?php

namespace App\Http\Controllers\Front;

use App\Image;
use App\Post;
use function compact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class PostsController extends Controller
{
    /**
     * Вывести посты
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(10);
        return view('front.index', compact('posts'));
    }


    public function setViews(Request $request)
    {
        $post = Post::find($request->get('id'))->firstOrFail();
        if(!$post) {
            return response()->json(array(
                'success' => false
            ));
        }
        $post->setViews();
        return response()->json(array(
            'success' => true
        ));
    }

    /**
     * Обработка кнопки добавить Объявление
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function addPost(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'content' => 'required',
        ]);
        if ($validator->fails())
        {
            $headers = [ 'Content-Type' => 'application/json; charset=utf-8' ];
            return response()->json($validator->messages(), 200,$headers,JSON_UNESCAPED_UNICODE);
        }
        $reqPosts = $request->all();
        $post = Post::add($reqPosts);
        $i = 0;
        foreach($reqPosts as $key=>$itemReq)
        {
            if($request->hasFile($key)) {
                if($i > 2){
                    return response()->json(array(
                        'success' => false
                    ));
                }
                Image::uploadImages($request->file($key), $post->id);
                $i++;
            }
        }
        return response()->json(array(
            'success' => true
        ));
    }
}
