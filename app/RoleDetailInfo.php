<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoleDetailInfo extends Model
{
    //
    protected $table = "m_role_detail";
    protected $primaryKey = "id";
    public $incrementing = true;
    protected $fillable = [
      'id','role_id','modul_id','created_at','updated_at','audituser'
    ];
}
