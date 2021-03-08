<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientInfo extends Model
{
    //
    protected $table = "m_client";
    protected $primaryKey = "id";
    public $incrementing = true;
    protected $fillable = [
      'id','nama','alamat','kota','telpon','email','npwp','website','contactperson','isHolding','groupId','areaId','isActive','ope'
    ];
}
