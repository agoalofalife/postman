<?php

namespace agoalofalife\postman\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    protected $fillable = ['theme', 'text'];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
