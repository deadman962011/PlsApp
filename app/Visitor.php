<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Company;
class Visitor extends Authenticatable
{
    use Notifiable;
     protected $table="visitors";
     protected $fillable=[
    	'vis_name', 'vis_last_name', 'vis_phone', 'vis_city', 'vis_address','vis_password','role','email'
    ];

    protected $hidden=['vis_password'];

      public function companies()
    {
        return $this->belongsToMany(Company::class,'company_visitor');
    }

    public function getAuthPassword()
    {
        return $this->vis_password;
    }

}
