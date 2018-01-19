<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{


    const IS_PUBLIC = 0;
    const IS_STANDART = 0;

    protected $fillable = ['title', 'content', 'description'];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
   /* public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }*/

    /**
     * Связь с пользователями,пост принадлежит к одному автору
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Связь с изображениями один ко многим у одного поста может быть много картинок
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        return $this->hasMany(Image::class, 'post_id');
    }

    /**
     * Добавлние поста
     *
     * @param $fields
     * @return static
     */
    public static function add($fields)
    {
        $post = new static;
        $post->fill($fields);
        $post->user_id = 1;
        $post->title = 1;
        $post->slug = 1;
        $post->save();
        return $post;
    }

    /**
     * Редактирование поста
     * @param $fields
     *
     */
    public function edit($fields)
    {
        $this->fill($fields);
        $this->save();
    }

    /**
     * Удаление поста
     */
    public function remove()
    {
        $this->delete();
    }

}
