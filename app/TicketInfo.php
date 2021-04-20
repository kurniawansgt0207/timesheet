<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketInfo extends Model
{
    //
    protected $table = "t_ticket";
    protected $primaryKey = "id";
    public $incrementing = true;
    protected $fillable = [
      'id', 'employeeId', 'jobId', 'departemenId', 'isActive', 'ticketSts', 'isApprove', 'auditemployeeId'
    ];
}
