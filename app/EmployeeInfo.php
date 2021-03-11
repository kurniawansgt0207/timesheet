<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeInfo extends Model
{
    //
    protected $table = "m_employee";
    protected $primaryKey = "id";
    public $incrementing = true;
    protected $fillable = [
      'id','email','nama','nik','password','departemenID','jabatanID','levelId','roleId','isActive','audituserId'
    ];
}
