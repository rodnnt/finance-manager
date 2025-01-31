<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBudget extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'budget',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public static function createOrUpdateBudget($userId, $categoryId, $budget)
    {
        $userBudget = self::where('user_id', $userId)
                        ->where('category_id', $categoryId)
                        ->first();

        if ($userBudget) {    
            $userBudget->update(['budget' => $budget]);
        } else {
            self::create([
                'user_id' => $userId,
                'category_id' => $categoryId,
                'budget' => $budget
                ]);
        }
    }
}