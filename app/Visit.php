<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    /**
     * Get the doctor that owns the visit.
     */
    public function doctor()
    {
        return $this->belongsTo('App\Doctor');
    }

    /**
     * Get the patient that owns the visit.
     */
    public function patient()
    {
        return $this->belongsTo('App\Patient');
    }
}
