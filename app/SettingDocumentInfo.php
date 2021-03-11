<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SettingDocumentInfo extends Model
{
    //
    protected $table = "m_set_document";
    protected $primaryKey = "docid";
    public $incrementing = true;
    protected $fillable = [      
        'docid','keterangan','autono','allowprefix','textprefix','allowyop','allowmop','doclength',
        'docnumfmt','docnum','objtypesmall','textprefix_last','yop_last','mop_last'
    ];
}
