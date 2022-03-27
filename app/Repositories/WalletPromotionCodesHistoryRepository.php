<?php

namespace App\Repositories;

use App\Models\WalletPromotionCodesHistory;

class WalletPromotionCodesHistoryRepository implements WalletPromotionCodesHistoryInterface
{

    protected $model;

    public function __construct(WalletPromotionCodesHistory $model) {
        $this->model = $model;
    }
    public function setId($id){
        $this->model=$this->model->setAttribute('id',$id);
    }
    public function setWalletId($walletId){
        $this->model=$this->model->setAttribute('wallet_id',$walletId);
    }
    public function setPromotionCodeId($promotionCodeId){
        $this->model=$this->model->setAttribute('promotion_code_id',$promotionCodeId);
    }
    public function getAll(){
        return $this->model::all();
    }
    public function get(){
        return $this->model;
    }
    public function getWallet(): WalletRepository{
        return new WalletRepository($this->model->wallet());
    }
    public function getPromotionCode(): PromotionCodeRepository{
        return new PromotionCodeRepository($this->model->promotionCode());
    }
    public function save(): bool
    {
        return $this->model->save();
    }
    public function getId(){
        return $this->model->getAttribute('id');
    }
}
