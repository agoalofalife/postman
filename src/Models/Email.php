<?php

namespace agoalofalife\postman\Models;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    protected $fillable = ['theme', 'text'];
}
