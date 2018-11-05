<?php

namespace App\Http\Controllers\Admin;

use App\Models\Balance;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BalanceController extends Controller
{
    public function index()
    {
        $balance = auth()->user()->balance;
        $amount = $balance ? $balance->amount: 0;

        return view('admin.balance.index', compact('amount'));
    }

    public function deposit()
    {
        return view('admin.balance.deposit');
    }

    public function depositStore(Request $request)
    {
        $balance = auth()->user()->balance()->firstOrCreate([]);
        $response = $balance->deposit($request->value);
        if($response['success'])
            return redirect()
                            ->route('admin.balance')
                            ->with('success',$response['message']);
        return redirect()
                        ->back()
                        ->with('error',$response['message']);
    }

    public function withdraw()
    {
        return view('admin.balance.withdraw');
    }

    public function withdrawStore(Request $request)
    {
        $balance = auth()->user()->balance()->firstOrCreate([]);
        $response = $balance->withdraw($request->value);
        if($response['success'])
            return redirect()
                ->route('admin.balance')
                ->with('success',$response['message']);
        return redirect()
            ->back()
            ->with('error',$response['message']);
    }

    public function transfer()
    {
        return view('admin.balance.transfer');
    }

    public function transferConfirm(Request $request, User $user)
    {
        $receiver = $user->getReceiver($request->receiver);
        if(!$receiver)
            return redirect()
                        ->back()
                        ->with('error','Usuário não encontrado');

        if($receiver->id == auth()->user()->id)
            return redirect()
                        ->back()
                        ->with('error','Usuário logado igual usuário de transferencia');

        $balance = auth()->user()->balance;

        return view('admin.balance.transfer-confirm',compact('receiver', 'balance'));
    }

    public function transferStore(Request $request, User $user)
    {
        if(!$receiver = $user->find($request->receiver_id))
            return redirect()
                ->route('balance.transfer')
                ->with('error','Recebedor não encontrado!');

        $balance = auth()->user()->balance()->firstOrCreate([]);
        $response = $balance->transfer($request->value, $receiver);
        if($response['success'])
            return redirect()
                        ->route('admin.balance')
                        ->with('success',$response['message']);

        return redirect()
                    ->route('balance.transfer')
                    ->with('error',$response['message']);
    }

    public function historic()
    {
        $historics = auth()->user()->historics()->with('userReceiver')->get();
        return view('admin.balance.historic', compact('historics'));
    }

}
