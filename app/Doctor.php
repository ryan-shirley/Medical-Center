<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    /**
     * Get the visits for the doctor.
     */
    public function visits()
    {
        return $this->hasMany('App\Visit');
    }

    /**
     * Get the user for the doctor.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
