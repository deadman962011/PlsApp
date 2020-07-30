<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyRate extends Model
{
    //				
    protected $fillable=['company_id','visitor_id','rate_value','rate_desc'];
}
