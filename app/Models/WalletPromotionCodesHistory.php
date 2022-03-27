<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WalletPromotionCodesHistory extends Model
{
    use HasFactory;
    public function wallet(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Wallet::class, 'id', 'wallet_id');
    }
    public function promotionCode(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(PromotionCode::class, 'id', 'promotion_code_id');
    }

}
