<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\Array_;

class Balance extends Model
{
    public $timestamps = false;

    public function user()
    {
        $this->belongsTo(User::class);
    }

    public function deposit(float $value) : Array
    {
        $this->amount += number_format($value, 2,'.','');
        $deposit = $this->save();

        if($deposit)
            return [
                'success' => true,
                'message' => 'Sucesso ao recarregar'
            ];

        return[
            'success' => false,
            'message' => 'Falha ao carregar'

        ];

        return redirect()->route('admin.balance');
    }
}
