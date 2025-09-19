<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Community extends Model
{
    protected $table = 'community';

    protected $fillable = ['name', 'description', 'coordinator_id', 'subcoordinator_id'];

}
