<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pay extends Model
{
    protected $table = 'pay';

    protected $fillable = ['service_type_id', 'parishioner_id', 'pay_date', 'ammount'];
}
