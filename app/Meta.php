<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meta extends Model
{
    protected $table = 'meta';
    protected $fillable =['description','keywords','title'];

    /**
     * Добавлние meta
     *
     * @param $fields
     * @return static
     */
    public static function add($fields)
    {
        $meta = new static;
        $meta->fill($fields);
        $meta->save();
        return $meta;
    }

    /**
     * Редактирование meta
     * @param $fields
     *
     */
    public function edit($fields)
    {
        $this->fill($fields);
        $this->save();
        return true;
    }
}
