<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoleInfo extends Model
{
    //
    protected $table = "m_role";
    protected $primaryKey = "id";
    public $incrementing = true;
    protected $fillable = [
      'id','role'
    ];
}
