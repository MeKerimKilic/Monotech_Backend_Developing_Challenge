<?php

namespace App\Repositories;

use App\Models\PromotionCode;

interface PromotionCodeInterface
{

    public function __construct(PromotionCode $model);
    public function setId($id);
    public function getAll();
    public function get();
    public function getWalletPromotionCodesHistory();
    public function getCode();
    public function getQuota();
    public function getAmount();
    public function getStartDate();
    public function getEndDate();
    public function setCode($code);
    public function setQuota($quota);
    public function setAmount($amount);
    public function setStartDate($startDate);
    public function setEndDate($endDate);
    public function save();
    public function getId();
    public function createCode();
}
