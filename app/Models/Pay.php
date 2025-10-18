<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pay extends Model
{
    protected $table = 'pay';

    protected $fillable = ['service_type_id', 'parishioner_id', 'pay_date', 'ammount'];

    public function parishioner() {
        return $this->belongsTo(Parishioner::class);
    }

    public function serviceType() {
        return $this->belongsTo(ServiceType::class);
    }
}
