<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Round extends Model
{
    protected $fillable = ['competition_id', 'round_number'];
    public $timestamps = false;

    use HasFactory;

    function competition ()
    {
        return $this->belongsTo(Competition::class);
    }
}
