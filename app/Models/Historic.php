<?php

namespace App\Models;

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Historic extends Model
{
    protected $fillable = [
        'type',
        'amount',
        'total_before',
        'total_after',
        'user_id_transaction',
        'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function userReceiver()
    {
        return $this->belongsTo(User::class,'user_id_transaction');
    }

    public function type($type = null)
    {
        $types = [
            'I' => 'Depósito',
            'O' => 'Saque',
            'T' => 'Transferência',
        ];

        if(!$type)
            return $types;

        if($this->user_id_transaction != null and $type =='I')
            return 'Recebido';

        return $types[$type];
    }

    public function getDateAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }
}
