<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Laravelrus\LocalizedCarbon\LocalizedCarbon;


class Post extends Model
{


    const ALLOW = 1;
    const DISALLOW = 0;

    protected $fillable = ['content'];

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
        $post->user_id = Auth::user()->id;
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
        return true;
    }

    /**
     * Количество просмотров
     * @return bool
     */
    public function setViews()
    {
        $this->views = $this->views + 1;
        $this->save();
        return true;
    }

    /**
     * Получить дату согздания объявления
     * @return mixed|null|string
     */
    public function getDate()
    {
        return LocalizedCarbon::instance($this->created_at)->diffForHumans();
    }

    /**
     * Разрешить объявление
     */
    public function allow()
    {
        $this->status = Post::ALLOW;
        $this->save();
    }
    /**
     * Запретить объявление
     */
    public function disAllow()
    {
        $this->status = Post::DISALLOW;
        $this->save();
    }

    /**
     * Переключатель объявления с активного на неактивный
     */
    public function toggleStatus()
    {
        if($this->status == Post::DISALLOW)
        {
            return $this->allow();
        }
        return $this->disAllow();
    }

    /**
     * Удаление поста
     */
    public function remove()
    {
        $this->delete();
    }

}
