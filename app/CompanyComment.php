<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyComment extends Model
{
    //			
    protected $fillable=['company_id','visitor_id','comment_value','comment_vote'];
}
