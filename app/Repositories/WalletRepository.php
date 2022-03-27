<?php

namespace App\Repositories;

use App\Models\Wallet;

class WalletRepository implements WalletInterface
{
    protected $model;

    public function __construct(Wallet $model) {
        $this->model = $model;
    }
    public function setId($id){
        $this->model=$this->model->setAttribute('id',$id);
    }
    public function setBalance($balance){
        $this->model=$this->model->setAttribute('balance',$balance);
    }
    public function getAll(){
        return $this->model::all();
    }
    public function get(){
        return $this->model;
    }
    public function getUser(){
        return $this->model->user();
    }
    public function getWalletPromotionCodesHistory(): PromotionCodeRepository{
        return new PromotionCodeRepository($this->model->walletPromotionCodesHistory());
    }
    public function getBalance(){
        return $this->model->getAttribute('balance');
    }
    public function save(): bool
    {
        return $this->model->save();
    }
    public function getId(){
        return $this->model->getAttribute('id');
    }
    public function findById($id){
        return $this->model::find($id);
    }
}
