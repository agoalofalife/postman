<?php

namespace agoalofalife\postman\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SheduleEmail extends Model
{
    use SoftDeletes;

    protected $fillable = ['date' , 'email_id', 'mode_id', 'status_id'];

    public function email()
    {
        return $this->belongsTo(Email::class);
    }

    public function mode()
    {
        return $this->belongsTo(ModePostEmail::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
