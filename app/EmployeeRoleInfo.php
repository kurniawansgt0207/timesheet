<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeRoleInfo extends Model
{
    //
    protected $table = "m_employee_role";
    protected $primaryKey = "id";
    public $incrementing = true;
    protected $fillable = [
      'id','employeeId','roleId','isActive'
    ];
}
