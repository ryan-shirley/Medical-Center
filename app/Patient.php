<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    /**
     * Get the visits for the patient.
     */
    public function visits()
    {
        return $this->hasMany('App\Visit');
    }

    /**
     * Get the user for the patient.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
