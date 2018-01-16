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
    public static function uploadImages($images, $id)
    {
        foreach ($images as $im) {
            //Загружаем картинки в таблицу images и проставляем id для связи с постом
            $image = new static;
            $image->post_id = $id;
            $image->url = $im;
            $image->save();
        }
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
