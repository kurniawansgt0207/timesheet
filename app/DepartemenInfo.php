<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DepartemenInfo extends Model
{
    //
    protected $table = "m_departemen";
    protected $primaryKey = "id";
    public $incrementing = true;
    protected $fillable = [
      'id','departemen'
    ];
}
