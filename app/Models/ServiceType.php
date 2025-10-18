<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceType extends Model
{
    protected $table = 'service_type';

    protected $fillable = ['name', 'description'];

    public function pays()
    {
        return $this->hasMany(Pay::class);
    }
}
