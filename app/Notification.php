<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    //
    protected $fillable=['NotifStatus','NotifValue','NotifTargetType','NotifTargetId'];
}
