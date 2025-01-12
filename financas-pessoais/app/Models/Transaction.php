<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $casts = [
        'transaction_date' => 'datetime',
    ];  
    
    public function financial_accounts()
    {
        return $this->belongsTo(Account::class, 'account_id');
    }
    
    public function currency() {
        return $this->belongsTo(Currency::class, 'currency_id');
    }

    public function category() {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
