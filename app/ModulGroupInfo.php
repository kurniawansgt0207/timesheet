<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModulGroupInfo extends Model
{
    //
    protected $table = "m_modul_group";
    protected $primaryKey = "id";
    public $incrementing = true;
    protected $fillable = [
      'id','modul_group','visorder','modul_group_icon','created_at','updated_at','audituser'
    ];
}
