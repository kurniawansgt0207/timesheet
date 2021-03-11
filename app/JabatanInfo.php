<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JabatanInfo extends Model
{
    //
    protected $table = "m_jabatan";
    protected $primaryKey = "id";
    public $incrementing = true;
    protected $fillable = [
      'id','jabatan', 'levelId'
    ];
}
