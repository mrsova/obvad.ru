<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as ImageInt;

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
        //Имя картинки
        $filename = str_random(15) . '.' . $image->extension();
        //Путь
        $path = public_path('uploads/'.$id.'/' . $filename);
        $path150 = public_path('uploads/'.$id.'/small/' . $filename);

        //Создаем папку
        File::makeDirectory(public_path().'/uploads/'.$id, 0777, true, true);
        File::makeDirectory(public_path().'/uploads/'.$id.'/small/', 0777, true, true);
        //Получаем библиотекой изображение с сервера
        $img = ImageInt::make($image->getRealPath());
        //Узнаем высоту и ширину
        $height = $img->height();
        $width = $img->width();

        //Делаем ресайз и сохраняем на диске
        if($width > $height){
            $img->resize(600, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path);
        }else{
            $img->resize(null, 600, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path);
        }

        $img->fit(297,190)->save($path150);
        //Сохраняем в бд
        $img = new static;
        $img->post_id = $id;
        $img->url = $filename;
        $img->save();

        return true;
    }

    /**
     * Получить картинку
     * @return string
     */
    public function getImage($id)
    {
        if($this->url == null)
        {
            return '/img/no-image.png';
        }
        return '/uploads/'.$id.'/'. $this->url;
    }

    /**
     * Получить картинку
     * @return string
     */
    public function getImageSmall($id)
    {
        if($this->url == null)
        {
            return '/img/no-image.png';
        }
        return '/uploads/'.$id.'/small/'. $this->url;
    }

    /**
     * Удаление картинок
     * @param $id - идентификатор поста
     * @param $image
     */
    public static function removeImages($id)
    {
        Storage::deleteDirectory('uploads/'.$id);
        self::where('post_id', $id)->delete();
        return true;
    }

    /**
     * Удаление картинки из поста
     * @param $id - идентификатор картинки
     * @param $image
     */
    public static function removeImageItem($id)
    {
        $imgage = self::where('id', $id)->first();
        Storage::delete([
            'uploads/'.$imgage->post->id.'/'. $imgage->url,
            'uploads/'.$imgage->post->id.'/small/'. $imgage->url
        ]);
        self::where('id', $id)->delete();
        return true;
    }
}
