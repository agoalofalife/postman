<?php

namespace agoalofalife\postman\Models;

use agoalofalife\postman\Contract\Mode;
use Illuminate\Database\Eloquent\Model;

class ModePostEmail extends Model
{
    protected $fillable = ['name', 'description', 'owner'];

    public function getOwnerAttribute(string $value) : Mode
    {
        if (is_subclass_of($value, Mode::class) === false) {
            throw new \Exception('Class mode not implementation Mode contract.');
        }
        return new $value;
    }
}
