<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['id','nm_med','slug','name','age','email','eficiency_note','sideEffects_note','satisfaction_note','trash','replys','created_at','updated_at'];
}
