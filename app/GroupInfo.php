<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupInfo extends Model
{
    //
    protected $table = "m_group";
    protected $primaryKey = "id";
    public $incrementing = true;
    protected $fillable = [
      'id','groupcode','groupname','jmlkota','created_at','updated_at','audituser'
    ];
}
