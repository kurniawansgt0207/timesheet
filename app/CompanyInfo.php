<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyInfo extends Model
{
    //
    protected $table = "m_company_info";
    protected $primaryKey = "id";
    public $incrementing = true;
    protected $fillable = [
      'id','company_name','company_addres','company_phone','company_npwp','company_email','company_website','company_contact'
    ];
}
