<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meds extends Model
{
    protected $table = 'med_04_2020';
    protected $fillable = ['id', 'active_princ', 'slug','slug_AP', 'lab', 'cod', 'nm_med', 'therap_class', 'type_med', 'status', 'note','count_av','cost', 'hosp_restriction', 'negotiate', 'stripe'];
}
