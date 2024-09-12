<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    protected $fillable = ['name', 'year', 'prize_pool', 'start_date', 'end_date'];
    public $timestamps = false;

    public function round()
    {
        return $this->hasMany(Round::class);
    }
}
