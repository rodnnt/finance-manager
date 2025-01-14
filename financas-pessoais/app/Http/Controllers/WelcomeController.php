<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;
use App\Models\Currency;

class WelcomeController extends Controller
{
    public function index(Request $request) {
        $currencies = Currency::all();
        $selectedCurrencyId = $request->get('currency_id') ?? Auth::user()->preferred_currency_id ?? 10;

        $despesas = $this->sumDespesas($selectedCurrencyId);
        $receitas = $this->sumReceitas($selectedCurrencyId);
        $saldo = $this->sumSaldo($selectedCurrencyId) + $receitas - $despesas; // fazer a soma dos saldos das contas

        $selectedCurrency = $currencies->firstWhere('id', $selectedCurrencyId);

        return view('welcome', compact('despesas', 'receitas', 'saldo', 'currencies', 'selectedCurrency'));
    }

    public function sumDespesas($currencyId) {
        return Transaction::with('currency', 'financial_accounts', 'category')
            ->where('type', 'Despesa')
            ->whereHas('financial_accounts', function ($query) {
                $query->where('created_by', Auth::id());
            })
            ->when($currencyId, function ($query, $currencyId) {
                $query->where('currency_id', $currencyId);
            })
            ->sum('value');
    }

    public function sumReceitas($currencyId) {
        return Transaction::with('currency', 'financial_accounts', 'category')
            ->where('type', 'Receita')
            ->whereHas('financial_accounts', function ($query) {
                $query->where('created_by', Auth::id());
            })
            ->when($currencyId, function ($query, $currencyId) {
                $query->where('currency_id', $currencyId);
            })
            ->sum('value');
    }

    public function sumSaldo($currencyId) {
        return Account::with('currency')
            ->where('created_by', Auth::id())
            ->when($currencyId, function ($query, $currencyId) {
                $query->where('currency_id', $currencyId);
            })
            ->sum('initial_balance');
    }
}