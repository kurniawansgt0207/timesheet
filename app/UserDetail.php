<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    //
    protected $table = 'users_detail';
    protected $primaryKey = "id";
    public $incrementing = true;
    protected $fillable = [
      'id','user_id','level','role_group'
    ];
}
