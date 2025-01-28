<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;
use App\Models\Currency;

class WelcomeController extends Controller
{
    public function index(Request $request) {
        $currencies = Currency::all();
        $selectedCurrencyId = $request->get('currency_id') ?? Auth::user()->preferred_currency_id ?? 10;
        $selectedCurrency = $currencies->firstWhere('id', $selectedCurrencyId);

        $totalExpenses = Transaction::with('currency', 'financial_accounts', 'category')
            ->where('type', 'Despesa')
            ->whereHas('financial_accounts', function ($query) {
                $query->where('created_by', Auth::id());
            })
            ->when($selectedCurrencyId, function ($query, $currencyId) {
                $query->where('currency_id', $currencyId);
            })
            ->sum('value')
        ;

        $totalIncome = Transaction::with('currency', 'financial_accounts', 'category')
            ->where('type', 'Receita')
            ->whereHas('financial_accounts', function ($query) {
                $query->where('created_by', Auth::id());
            })
            ->when($selectedCurrencyId, function ($query, $currencyId) {
                $query->where('currency_id', $currencyId);
            })
            ->sum('value')
        ;

        $sumBalance = Account::with('currency')
            ->where('created_by', Auth::id())
            ->when($selectedCurrencyId, function ($query, $currencyId) {
                $query->where('currency_id', $currencyId);
            })
            ->sum('initial_balance')
        ;

        $currentBalance = $sumBalance + $totalExpenses + $totalIncome;

        $sortBy = $request->get('sortBy', 'percentageTotal');
        $categories = Category::getCategoriesWithTotals($sortBy, $selectedCurrencyId);
        
        return view('welcome', compact('currencies', 'selectedCurrency', 'totalExpenses', 'totalIncome', 'currentBalance', 'categories', 'sortBy'));
    }
}