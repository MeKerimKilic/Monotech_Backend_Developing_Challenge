<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromotionCode extends Model
{
    use HasFactory;
    public function walletPromotionCodesHistories(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(WalletPromotionCodesHistory::class, 'promotion_code_id', 'id');
    }

}
