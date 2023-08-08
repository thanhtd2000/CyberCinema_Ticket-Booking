<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public $transactions;
    public function __construct(Transaction $transactions)
    {
        $this->transactions = $transactions;
    }
    // public function index()
    // {
    //     $transactions = $this->transactions->paginate(10);
    //     return view('Admin.transactions.index', compact('transactions'));
    // }

    public function index(Request $request)
    {
        $keydate = $request->input('keydate');
        $keystatus = $request->input('keystatus');
        if ($keydate && $keystatus) {
            $transactions = $this->transactions
                ->where('transactions.created_at', 'LIKE', "%$keydate%")
                ->where('transactions.status', '=', $keystatus)
                ->select('transactions.*')->latest()
                ->paginate(20);
            return view("Admin.transactions.index", compact('transactions', 'keydate', 'keystatus'));
        } elseif ($keydate) {
            $transactions = $this->transactions
                ->where('transactions.created_at', 'LIKE', "%$keydate%")
                ->select('transactions.*')->latest()
                ->paginate(20);
            return view("Admin.transactions.index", compact('transactions', 'keydate'));
        } elseif ($keystatus) {
            $transactions = $this->transactions
                ->where('transactions.status', '=', $keystatus)
                ->select('transactions.*')->latest()
                ->paginate(20);
            return view("Admin.transactions.index", compact('transactions', 'keystatus'));
        }
        $transactions = $this->transactions->latest()->paginate(10);
        return view("Admin.transactions.index", compact('transactions'));
    }
}
