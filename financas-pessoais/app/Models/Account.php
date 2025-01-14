<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'financial_accounts';

    public function currency() {
        return $this->belongsTo(Currency::class, 'currency_id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'created_by');
    }
}
