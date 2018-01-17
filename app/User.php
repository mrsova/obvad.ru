<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    const IS_ADMIN = 1;
    const NOT_ADMIN = 0;
    const IS_BANNED = 0;
    const IS_ACTIVE = 1;

    use Notifiable;

    /**
     * Поля автоматически подставляемые в функцию field()
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'login', 'vk_url', 'uids'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Связь с постом один ко многим у одного пользователя может быть много созданных постов
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany(Post::class, 'user_id');
    }


    //Обычная регистрация
    /**
     * Сгенерировать пароль пользователя
     * @param $password
     */
    public function generatePassword($password)
    {
        if($password != null)
        {
            $this->password = bcrypt($password);
            $this->save();
        }
    }

    /**
     * Добавлние пользователя
     *
     * @param $fields
     * @return static
     */
    public static function add($fields)
    {
        $user = new static;
        $user->fill($fields);
        $user->save();
        return $user;
    }

    //Методы привязки и авторизации через вк
    /**
     * Добавить поля пользователю который захочет привязать свой аккаунт к вк
     *
     * @param $fields
     * @return static
     */
    public function addFieldsVk($fields)
    {
        $this->uids = $fields['uids'];
        $this->vk_url = $fields['vk_url'];
        $this->save();
    }

    /**
     * Проверяет авторизовывался ли  через VK пользователь у нас на сайте
     *
     * @param $fields
     * @return static
     */
    public static function isVk($uids)
    {
        $user = self::where('uids', $uids)->first();

        if($user)
        {
            return $user;
        }
        else
        {
            return false;
        }
    }

    /**
     * Редактирование пользователя
     * @param $fields
     *
     */
    public function edit($fields)
    {
        $this->fill($fields);
        $this->save();
    }

    /**
     * Удаление пользователя
    */
    public function remove()
    {
        $this->delete();
    }

    /**
     * Дать пользователю доступ в админку
     */
    public function makeAdmin()
    {
        $this->is_admin = User::IS_ADMIN;
    }

    /**
     * Обычный пользователь
     */
    public function makeNormal()
    {
        $this->is_admin = User::NOT_ADMIN;
    }

    /**
     * Переключатель с обычного на админа
     * @param $value
     */
    public function toggleAdmin($value)
    {
        if ($value)
        {
            return $this->makeAdmin();
        }

        return $this->makeNormal();
    }

    /**
     * Забанить пользователя
     */
    public function ban()
    {
        $this->status = User::IS_BANNED;
        $this->save();
    }

    /**
     * Разбанить пользователя
     */
    public function unban()
    {
        $this->status = User::IS_ACTIVE;
        $this->save();
    }

    /**
     * Переключатель БАНА
     * @param $value
     */
    public function toggleStatus($value)
    {
        if($value)
        {
            return $this->unban();

        }
        return $this->ban();
    }
}
