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


    public function email()
    {
        return $this->belongsTo(Email::class);
    }
}
