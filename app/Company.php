<?php

namespace App;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\Model;
use App\Visitor;
class Company extends Authenticatable implements JWTSubject
{


      /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }



      protected $table="companies";
      protected $fillable=[
    	'cmp_name', 'cmp_phone', 'cmp_city', 'cmp_email', 'cmp_image','cmp_password',
    ];
    public function visitors()
    {
    	return $this->belongsToMany(Visitor::class,'company_visitor');
    }
     public function services()
    {
    	return $this->belongsToMany(Service::class,'company_services');
    }

    public function getAuthPassword()
    {
        return $this->cmp_password;
    }
    
}
