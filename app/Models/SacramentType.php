<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SacramentType extends Model
{
    protected $table = 'sacrament_type';

    protected $fillable = ['name', 'description'];

    public function assignedSacraments()
    {
        return $this->hasMany(AssignedSacrament::class);
    }
}
