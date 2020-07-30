<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Visitor;
use App\Company;

class Message extends Model
{
    //						
    protected $fillable=['MessageTarget','MessageTargetType','MessageSource','MessageSourceType','MessageValue','MessageStatus'];

    protected $appends=['Source'];

    //Relations
    public function getSourceAttribute()
    {

        if($this->MessageSourceType == 1){

        
         return Visitor::find($this->MessageSource);
   
        }
        elseif($this->MessageSourceType == 2){
        
            return Visitor::find($this->MessageSource);
   
        }
    }





}



