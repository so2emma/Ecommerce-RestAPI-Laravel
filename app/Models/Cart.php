<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Auth;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ["user_id"];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }

    public static function getCart($userId = null): Cart
    {
        if($userId === null && Auth::check()) {
            $userId = Auth::id();
        }

        $cart = self::where('user_id', $userId)->first();

        if(!$cart){
            $cart = new self();
            $cart->user_id = $userId;
            $cart->save();
        }
        return $cart;
    }
}
