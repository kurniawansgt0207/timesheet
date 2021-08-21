<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActivityTypeInfo extends Model
{
    //
    protected $table = "m_activity_type";
    protected $primaryKey = "id";
    public $incrementing = true;
    protected $fillable = [
      'id','aktifitas','visorder','auditemployeeId'
    ];
}
