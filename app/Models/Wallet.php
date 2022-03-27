<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'id', 'wallet_id');
    }
    public function walletPromotionCodesHistories(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(WalletPromotionCodesHistory::class, 'wallet_id', 'id');
    }

}
