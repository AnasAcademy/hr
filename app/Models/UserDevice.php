<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDevice extends Model
{
    use HasFactory;
    protected $guarded = [];

    function admin(){
        return $this->belongsTo(User::class, 'approved_by');
    }
    function user(){
        return $this->belongsTo(User::class, 'user_id');
    }


    public const allowedDistance = 3; // 3km


}
