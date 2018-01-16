<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    const IS_ADMIN = 1;
    const NOT_ADMIN = 0;
    const IS_BANNED = 1;
    const IS_ACTIVE = 0;

    use Notifiable;

    /**
     * Поля автоматически подставляемые в функцию field()
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'login'
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
        return $this->hasMany(Post::class);
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
     * Добавить поля при авторизации через вк, авторизации по вк
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
        if($value == null)
        {
            return $this->makeNormal();
        }
        return $this->makeAdmin();
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
    public function toggleBan($value)
    {
        if($value == null)
        {
            return $this->unban();
        }
        return $this->ban();
    }
}
