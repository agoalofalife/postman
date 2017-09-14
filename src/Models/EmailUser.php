<?php

namespace agoalofalife\postman\Models;

use Illuminate\Database\Eloquent\Model;

class EmailUser extends Model
{
    protected $table = 'email_user';
    protected $fillable = ['user_id', 'email_id'];
}
