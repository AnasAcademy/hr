<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IpRestrict extends Model
{
    protected $guarded = [];

    function admin(){
        return $this->belongsTo(User::class, 'approved_by');
    }
    function user(){
        return $this->belongsTo(User::class, 'belongs_to');
    }
}
