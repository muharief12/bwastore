<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index() {
        $transactions = TransactionDetail::with(['transaction.user', 'product.galleries'])
                    ->whereHas('product', function($product){
                        $product->where('users_id', Auth::user()->id);
                    });
        $transaction_count = $transactions->count();
        $transaction_data = $transactions->orderBy('created_at', 'asc')->paginate(5);
        
        // $revenue = $transactions->get()->reduce(function ($carry, $item){
        //     return $carry + $item->price;
        // });

        $revenue = Transaction::with(['transaction.user'])->where('users_id', Auth::user()->id)->where('transaction_status', 'success')->sum('total_price');

        $customer = Transaction::with(['transaction.user'])->where('transaction_status', 'success')->distinct()->count('users_id');
        
        return view('pages.dashboard', compact('transaction_count', 'transaction_data', 'revenue', 'customer'));
    }
}
