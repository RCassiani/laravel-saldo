<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    public $timestamps = false;

    public function user()
    {
        $this->belongsTo(User::class);
    }
}
