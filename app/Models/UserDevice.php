<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDevice extends Model
{
    use HasFactory;

    protected $gaurded = [];

    function admin(){
        return $this->belongsTo(User::class, 'approved_by');
    }
    function user(){
        return $this->belongsTo(User::class, 'user_id');
    }



}
