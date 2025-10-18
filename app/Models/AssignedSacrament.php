<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssignedSacrament extends Model
{
    protected $table = 'assigned_sacrament';

    protected $fillable = ['sacrament_type_id', 'parishioner_id', 'scheduled_date', 'assigned_sacrament_status', 'priest_id'];

    public function sacramentType()
    {
        return $this->belongsTo(SacramentType::class);
    }

    public function parishioner()
    {
        return $this->belongsTo(Parishioner::class);
    }

    public function priest()
    {
        return $this->belongsTo(Priest::class);
    }

}
