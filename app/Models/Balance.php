<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\Array_;
use Illuminate\Support\Facades\DB;

class Balance extends Model
{
    public $timestamps = false;

    public function user()
    {
        $this->belongsTo(User::class);
    }

    public function deposit(float $value): Array
    {
        DB::beginTransaction();
        $totalBefore = $this->amount ? $this->amount : 0;
        $this->amount += number_format($value, 2, '.', '');
        $deposit = $this->save();

        $historic = auth()->user()->historics()->create([
            'type' => 'I',
            'amount' => $value,
            'total_before' => $totalBefore,
            'total_after' => $this->amount,
            'date' => date('Y-m-d'),
        ]);

        if ($deposit and $historic) {
            DB::commit();

            return [
                'success' => true,
                'message' => 'Sucesso ao recarregar'
            ];
        } else {
            DB::rollback();

            return [
                'success' => false,
                'message' => 'Falha ao carregar'

            ];
        }
    }

    public function withdraw(float $value): Array
    {
        if($this->amount < $value)
            return [
                'success' => false,
                'message' => 'Saldo insuficiente! Valor máximo de saque: R$ '.number_format($this->amount,2,',','.')

            ];

        DB::beginTransaction();
        $totalBefore = $this->amount ? $this->amount : 0;
        $this->amount -= number_format($value, 2, '.', '');
        $withdraw = $this->save();

        $historic = auth()->user()->historics()->create([
            'type' => 'O',
            'amount' => $value,
            'total_before' => $totalBefore,
            'total_after' => $this->amount,
            'date' => date('Y-m-d'),
        ]);

        if ($withdraw and $historic) {
            DB::commit();

            return [
                'success' => true,
                'message' => 'Sucesso ao retirar'
            ];
        } else {
            DB::rollback();

            return [
                'success' => false,
                'message' => 'Falha ao sacar'

            ];
        }
    }
}
