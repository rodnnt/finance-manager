<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function financial_accounts()
    {
        return $this->belongsTo(Account::class, 'account_id');
    }
    
    public function currency() {
        return $this->belongsTo(Currency::class, 'currency_id');
    }

    public function getGoalCurrentBalance($selectedCurrencyId = null)
    {
        $accountId = $this->account_id;

        $totalExpenses = Transaction::with('currency', 'financial_accounts', 'category')
            ->where('type', 'Despesa')
            ->whereHas('financial_accounts', function ($query) use ($accountId) {
                $query->where('account_id', $accountId);
            })
            ->when($selectedCurrencyId, function ($query, $currencyId) {
                $query->where('currency_id', $currencyId);
            })
            ->sum('value');

        $totalIncome = Transaction::with('currency', 'financial_accounts', 'category')
            ->where('type', 'Receita')
            ->whereHas('financial_accounts', function ($query) use ($accountId) {
                $query->where('account_id', $accountId);
            })
            ->when($selectedCurrencyId, function ($query, $currencyId) {
                $query->where('currency_id', $currencyId);
            })
            ->sum('value');

        $initialBalance = Account::find($accountId)->initial_balance;

        return $initialBalance - $totalExpenses + $totalIncome;
    }
}