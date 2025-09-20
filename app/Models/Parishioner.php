<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parishioner extends Model
{
    protected $table = 'parishioner';

    protected $fillable = ['dpi', 'name', 'last_name', 'birthday', 'address', 'phone_number', 'email', 'community_id'];

}
