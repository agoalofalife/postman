<?php

namespace agoalofalife\postman\Models;

use Illuminate\Database\Eloquent\Model;

class SheduleEmail extends Model
{
    protected $fillable = ['date' , 'email_id', 'mode_id'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'status_action' => 'boolean',
    ];


    /**
     * Get the status action.
     *
     * @param  string  $value
     * @return string
     */
    public function getStatusActionAttribute($value)
    {
        return boolval($value);
    }

    public function email()
    {
        return $this->belongsTo(Email::class);
    }

    public function mode()
    {
        return $this->belongsTo(ModePostEmail::class);
    }
}
