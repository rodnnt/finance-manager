<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Category;
use App\Models\Goal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;
use App\Models\Currency;
use App\Models\UserBudget;
use App\Http\Controllers\GoalController;

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

        $currentBalance = $sumBalance - $totalExpenses + $totalIncome;

        $sortBy = $request->get('sortBy', 'percentageTotal');
        $categories = Category::getCategoriesWithTotals($sortBy, $selectedCurrencyId);
        $userBudgets = UserBudget::where('user_id', Auth::id())
                                ->get()
                                ->keyBy('category_id');

        $goals = Goal::where('created_by', Auth::id())
                    ->where('currency_id', $selectedCurrencyId)
                    ->orderBy('deadline', 'asc')
                    ->get();
            
        foreach ($goals as $goal) {
            $account = Account::find($goal->account_id);
            $goal->current_value = $goal->getGoalCurrentBalance($account ? $account->currency_id : $selectedCurrencyId);
        }
       
        return view('welcome', compact('currencies', 'selectedCurrency', 'totalExpenses', 'totalIncome', 'currentBalance', 'categories', 'sortBy', 'userBudgets', 'goals'));
    }
}