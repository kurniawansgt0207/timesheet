<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModulInfo extends Model
{
    //
    protected $table = "m_modul";
    protected $primaryKey = "id";
    public $incrementing = true;
    protected $fillable = [
      'id','modul_name','modul_label','modul_icon','modul_status','modul_visorder','modul_link','modul_group','created_at','updated_at','audituser'
    ];
}
