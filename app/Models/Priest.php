<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Priest extends Model
{
    protected $table = 'priest';

    protected $fillable = ['dpi', 'name', 'last_name', 'birthday', 'address', 'phone_number', 'email'];
}
