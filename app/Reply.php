<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $fillable = ['id', 'comment_id', 'name', 'age', 'content', 'trash', 'slug', 'created_at', 'updated_at'];
    
}
