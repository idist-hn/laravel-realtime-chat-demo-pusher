<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    //
    protected $fillable = ['name'];
    protected $table ="rooms";

    public function messages(){
        return $this->hasMany(Message::class);
    }

}
