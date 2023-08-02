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
    public function index()
    {
        $transactions = $this->transactions->paginate(10);
        return view('Admin.transactions.index', compact('transactions'));
    }
}
