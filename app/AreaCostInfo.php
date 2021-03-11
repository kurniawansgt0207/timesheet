<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AreaCostInfo extends Model
{
    //
    protected $table = "m_area_cost";
    protected $primaryKey = "id";
    public $incrementing = true;
    protected $fillable = [
      'id','areaId', 'costId','costAmt','isActive'
    ];
}
