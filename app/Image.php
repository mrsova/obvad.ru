<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    /**
     * Связь с постами один ко многим,картинка принадлежит только к одному посту
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }

    /**
     * Загрузка картинок
     * @param $image
     */
    public static function uploadImages($image, $id)
    {
        if ($image == null){ return; }
        $filename = str_random(15) . '.' . $image->extension();
        $image->storeAs('uploads/'.$id.'/', $filename);
        $img = new static;
        $img->post_id = $id;
        $img->url = $filename;
        $img->save();
        return true;
    }

    /**
     * Удаление картинок
     * @param $image
     */
    public static function removeImages($id)
    {
        return self::where('post_id', $id)->delete();

    }
}
