<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'year', 'prize_pool', 'start_date', 'end_date'];
    public $timestamps = false;
}
