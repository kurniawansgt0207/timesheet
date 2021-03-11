<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AreaInfo extends Model
{
    //
    protected $table = "m_area";
    protected $primaryKey = "id";
    public $incrementing = true;
    protected $fillable = [
      'id','name', 'email', 'password', 'password_ori', 'img_profile', 'stat_active'
    ];
}
