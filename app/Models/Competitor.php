<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competitor extends Model
{
    protected $fillable = ['user_id', 'round_id'];
    public $timestamps = false;
    use HasFactory;
}
