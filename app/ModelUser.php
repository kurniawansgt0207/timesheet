<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModelUser extends Model
{
    //
    protected $table = 'm_user';
    protected $primaryKey = "id";
    public $incrementing = true;
    protected $fillable = [
      'id','area','created_at','updated_at','audituser'
    ];
}
