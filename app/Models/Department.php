<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [
        'name',
        'branch_id',
        'created_by',
        'manager_id'
    ];

    public function branch(){
        return $this->hasOne('App\Models\Branch','id','branch_id');
    }
    public function manager(){
        return $this->hasOne('App\Models\User','id','manager_id');
    }
    public function employees(){
        return $this->hasMany('App\Models\Employee','department_id','id');
    }
}
