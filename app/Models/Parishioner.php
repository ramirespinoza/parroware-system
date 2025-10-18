<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parishioner extends Model
{
    protected $table = 'parishioner';

    protected $fillable = ['dpi', 'name', 'last_name', 'birthday', 'address', 'phone_number', 'email', 'community_id'];

    public function community() {
        return $this->belongsTo(Community::class);
    }

    public function pays()
    {
        return $this->hasMany(Pay::class);
    }

    public function assignedSacraments()
    {
        return $this->hasMany(AssignedSacrament::class);
    }
}
