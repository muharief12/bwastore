<?php

namespace App\Http\Controllers;

use App\Models\Province;
use App\Models\Regency;
use App\Models\TransactionDetail;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DashboardTransactionController extends Controller
{
    public function index() {
        $sellTransactions = TransactionDetail::with(['transaction.user', 'product.galleries'])
                    ->whereHas('product', function($product){
                        $product->where('users_id', Auth::user()->id);
                    })->get();
        $buyTransactions = TransactionDetail::with(['transaction.user', 'product.galleries'])
                    ->whereHas('transaction', function($transaction) {
                        $transaction->where('users_id', Auth::user()->id);
                    })->get();
        
        
        return view('pages.dashboard-transactions', compact('sellTransactions','buyTransactions'));
    }

    public function details(Request $request, $id) {
        $transaction = TransactionDetail::with(['transaction.user', 'product.galleries'])->findOrFail($id);
        $province = Province::find($transaction->transaction->user->provinces_id);
        $regency = Regency::find($transaction->transaction->user->regencies_id);
        
        return view('pages.dashboard-transactions-details', compact('transaction', 'province', 'regency'));
    }

    public function printInv(Request $request, $id) {
        $transaction = TransactionDetail::with(['transaction.user', 'product.galleries'])->findOrFail($id);
        $province = Province::find($transaction->transaction->user->provinces_id);
        $regency = Regency::find($transaction->transaction->user->regencies_id);
        
        $pdf = FacadePdf::loadview('pages.dashboard-transactions-print-inv',[
            'transaction' => $transaction,
            'province' => $province,
            'regency' => $regency,
        ]);
        return $pdf->stream();
    }

    public function update(Request $request, $id) {
        $data = $request->all();
        $item = TransactionDetail::findOrFail($id);
        $item->update($data);
        
        return redirect()->route('dashboard-transactions-details', $id);
    }
}
