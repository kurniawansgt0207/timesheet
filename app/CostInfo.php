<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CostInfo extends Model
{
    //
    protected $table = "m_cost";
    protected $primaryKey = "id";
    public $incrementing = true;
    protected $fillable = [
      'id','costname', 'visOrder'
    ];
}
