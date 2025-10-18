<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $table = 'certificate';

    protected $fillable = ['certificate', 'isue_date', 'assigned_sacrament_id'];

    public function getFileUrlAttribute()
    {
        return asset('storage/' . $this->file_path);
    }

}
