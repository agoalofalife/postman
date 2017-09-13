<?php

namespace agoalofalife\postman\Models;

use Illuminate\Database\Eloquent\Model;

class SheduleEmail extends Model
{
    protected $fillable = ['date' , 'email_id', 'mode_id'];
}
