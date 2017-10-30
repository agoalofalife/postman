<?php

namespace agoalofalife\postman\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $fillable = ['name', 'description', 'color_rgb'];
}
