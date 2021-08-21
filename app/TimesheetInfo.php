<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketInfo extends Model
{
    //
    protected $table = "t_timesheet";
    protected $primaryKey = "id";
    public $incrementing = true;
    protected $fillable = [
        'id','yop','mop','ticketId','isClient','employeeId','jobId','departemenId','ticketSts','isApprove','isActive',
        'jmljam01','isOpen01','jmljam02','isOpen02','jmljam03','isOpen03','jmljam04','isOpen04','jmljam05','isOpen05',
        'jmljam06','isOpen06','jmljam07','isOpen07','jmljam08','isOpen08','jmljam09','isOpen09','jmljam10','isOpen10',
        'jmljam11','isOpen11','jmljam12','isOpen12','jmljam13','isOpen13','jmljam14','isOpen14','jmljam15','isOpen15',
        'jmljam16','isOpen16','jmljam17','isOpen17','jmljam18','isOpen18','jmljam19','isOpen19','jmljam20','isOpen20',
        'jmljam21','isOpen21','jmljam22','isOpen22','jmljam23','isOpen23','jmljam24','isOpen24','jmljam25','isOpen25',
        'jmljam26','isOpen26','jmljam27','isOpen27','jmljam28','isOpen28','jmljam29','isOpen29','jmljam30','isOpen30',
        'jmljam31','isOpen31','auditemployeeId'
    ];
}
