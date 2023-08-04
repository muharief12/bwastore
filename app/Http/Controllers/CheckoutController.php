<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function process(Request $request)
    {
        // save user data
        $user = Auth::user();
        $user->update($request->except('total_price'));

        // checkout process
        $code = 'STORE-'.mt_rand(0000000, 9999999);
        $carts = Cart::with(['product','user'])->where('users_id', Auth::user()->id)->get();

        // transactions create
        $transaction = Transaction::create([
            'users_id' => Auth::user()->id,
            'insurance_price' => 0,
            'shipping_price' => 0,
            'total_price' => $request->total_price,
            'transaction_status' => 'PENDING',
            'code' => $code,
        ]);

        // transaction details create
        foreach ($carts as $cart) {
            $trx = 'TRX-'.mt_rand(0000000, 9999999);

            TransactionDetail::create([
                'code' => $trx,
                'transactions_id' => $transaction->id,
                'products_id' => $cart->product->id,
                'price' => $cart->product->price,
                'shipping_status'=> 'PENDING',
                'resi'=> '',
            ]);

        }

        Cart::where('users_id', Auth::user()->id)->delete();

        return redirect()->route('success');
    }

    public function callback(Request $request)
    {

    }
}
