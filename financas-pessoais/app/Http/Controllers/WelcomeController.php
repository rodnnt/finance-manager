<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;

class WelcomeController extends Controller
{
    public function sumDespesas() {
        return Transaction::with('currency', 'financial_accounts', 'category')
            ->where('type', 'Despesa')
            ->whereHas('financial_accounts', function ($query) {
                $query->where('created_by', Auth::id());
            })
            ->sum('value');
    }

    public function index() {
        $despesas = $this->sumDespesas();

        return view('welcome', compact('despesas'));
    }
}
