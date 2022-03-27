<?php

namespace App\Repositories;

use App\Models\Wallet;

interface WalletInterface
{
    public function getAll();
    public function get();
    public function getUser();
    public function getWalletPromotionCodesHistory();
    public function __construct(Wallet $model);
    public function setId($id);
    public function getBalance();
    public function setBalance($balance);
    public function save();
    public function getId();
    public function findById($id);
}
