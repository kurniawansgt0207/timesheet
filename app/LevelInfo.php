<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LevelInfo extends Model
{
    //
    protected $table = "m_level";
    protected $primaryKey = "id";
    public $incrementing = true;
    protected $fillable = [
      'id','levelname', 'levelno'
    ];
}
