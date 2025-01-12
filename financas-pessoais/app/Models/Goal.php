<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function account()
    {
        return $this->belongsTo(Account::class, 'account_id');
    }
    
    public function currency() {
        return $this->belongsTo(Currency::class, 'currency_id');
    }
}