<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\UserBudget;

class Category extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function budgets()
    {
        return $this->hasMany(UserBudget::class);
    }

    public function getValueAttribute()
    {
        $totalExpenses = $this->transactions()->where('type', 'Despesa')->sum('value');
        $totalIncome = $this->transactions()->where('type', 'Receita')->sum('value');
        
        return abs($totalExpenses - $totalIncome);
    }

    public static function getCategoriesWithTotals($sortBy = 'percentageTotal', $currencyId)
    {
        $transactions = 
            Transaction::with('currency', 'financial_accounts', 'category')
                ->whereHas('financial_accounts', function ($query) {
                    $query->where('created_by', Auth::id());
                })
                ->when($currencyId, function ($query, $currencyId) {
                    $query->where('currency_id', $currencyId);
                })
                ->get();

        return $transactions
            ->groupBy('category_id')
            ->map(function ($transactions) {
                $category = $transactions->first()->category;

                $totalIncome = $transactions->where('type', 'Receita')->sum('value');
                $totalExpenses = $transactions->where('type', 'Despesa')->sum('value');
                $balance = abs($totalIncome - $totalExpenses);
                $budget = UserBudget::where('user_id', Auth::id())
                                    ->where('category_id', $category->id)
                                    ->first()->budget ?? 0;
                if ($budget == 0) {
                    $budget = $category->budget;
                }
                if ($budget == 0.01) {
                    $percentage = 100;
                    $percentageExcess = 0;
                    $percentageTotal = 100;
                } else {
                    $percentage = $budget > 0.01 ? ($balance / $budget) * 100 : 0;
                    $percentageExcess = ($balance > $budget) ? (($balance - $budget) / $budget) * 100 : 0;
                    $percentageTotal = $percentage + $percentageExcess;
                }


                return [
                    'id' => $category->id,
                    'name' => $category->name,
                    'total_income' => $totalIncome,
                    'total_expenses' => $totalExpenses,
                    'balance' => abs($balance),
                    'budget' => $budget,
                    'percentage' => $percentage,
                    'percentageExcess' => $percentageExcess,
                    'percentageTotal' => $percentageTotal,
                    'transactions' => $transactions,
                ];
            })
            ->values()
            ->sortByDesc($sortBy)
        ;
    }
}