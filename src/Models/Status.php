<?php

namespace agoalofalife\postman\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    const IN_PROCESS = 'in_process';
    const DONE = 'done';
    const COLUMN_UNIQUE_NAME = 'unique_name';

    protected $fillable = ['name', 'description', 'color_rgb', self::COLUMN_UNIQUE_NAME];

    /**
     * Get id status "In process"
     * @param $query
     * @return int
     */
    public function scopeInProcess($query) : int
    {
        return $query->where(self::COLUMN_UNIQUE_NAME, self::IN_PROCESS)->get()->first()->id;
    }

    /**
     * Get id status in "Done"
     * @param $query
     * @return int
     */
    public function scopeDone($query) : int
    {
        return $query->where(self::COLUMN_UNIQUE_NAME, self::DONE)->get()->first()->id;
    }
}
