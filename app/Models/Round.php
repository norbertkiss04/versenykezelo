<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Round extends Model
{
    protected $fillable = ['competition_id', 'round_number'];
    public $timestamps = false;

    function competition ()
    {
        return $this->belongsTo(Competition::class);
    }

    use HasFactory;
    use SoftDeletes;
}
