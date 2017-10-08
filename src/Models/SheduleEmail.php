<?php

namespace agoalofalife\postman\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SheduleEmail extends Model
{
    use SoftDeletes;
    protected $fillable = ['date' , 'email_id', 'mode_id', 'status_action'];

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
        return trans("postman::dashboard.status_action." . $value);
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
