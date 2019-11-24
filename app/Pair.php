<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pair extends Model
{
    protected $fillable = [
        'user_id',
        'pair_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pair()
    {
        return $this->belongsTo(User::class);
    }
}
