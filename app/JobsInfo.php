<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobsInfo extends Model
{
    //
    protected $table = "t_job";
    protected $primaryKey = "id";
    public $incrementing = true;
    protected $fillable = [
      'id', 'clientId', 'job_number', 'fee', 'tanggal_mulai', 'tanggal_selesai', 'isComplete', 'isApprove', 'jobStatus', 'auditemployeeId'
    ];
}
