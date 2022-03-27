<?php

namespace App\Repositories;

use App\Models\WalletPromotionCodesHistory;

interface WalletPromotionCodesHistoryInterface
{
    public function __construct(WalletPromotionCodesHistory $model);
    public function getAll();
    public function get();
    public function getWallet();
    public function getPromotionCode();
    public function setId($id);
    public function setWalletId($walletId);
    public function setPromotionCodeId($promotionCodeId);
    public function save();
    public function getId();
}
