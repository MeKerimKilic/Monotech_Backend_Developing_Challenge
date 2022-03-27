<?php

namespace App\Repositories;

use App\Models\PromotionCode;
class PromotionCodeRepository implements PromotionCodeInterface
{

    protected $model;

    public function __construct(PromotionCode $model) {
        $this->model = $model;
    }
    public function setId($id){
        $this->model=$this->model->setAttribute('id',$id);
    }
    public function setCode($code){
        $this->model=$this->model->setAttribute('code',$code);
    }
    private function getRandCode(): string{
        $token = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet.= "0123456789";

        for($i=0; $i< 12; $i++){
            $token .= $codeAlphabet[mt_rand(0,strlen($codeAlphabet)-1)];
        }
        return $token;

    }
    public function createCode(): string{
        do
        {
            $token = $this->getRandCode();
            $code = $token . substr(strftime("%Y", time()),2);
            $codeIsEmpty = $this->findByCode($code)->get();
        }
        while(!$codeIsEmpty->isEmpty());
        $this->model=$this->model->setAttribute('code',$code);
        return $code;
    }
    public function findByCode($code){
        return $this->model->where('code',$code);
    }
    public function setQuota($quota){
        $this->model=$this->model->setAttribute('quota',$quota);
    }
    public function setAmount($amount){
        $this->model=$this->model->setAttribute('amount',$amount);
    }
    public function setStartDate($startDate){
        $this->model=$this->model->setAttribute('start_date',\Carbon\Carbon::createFromFormat('Y-m-d H:i', $startDate)->format('Y-m-d H:i:s'));
    }
    public function setEndDate($endDate){
        $this->model=$this->model->setAttribute('end_date',\Carbon\Carbon::createFromFormat('Y-m-d H:i', $endDate)->format('Y-m-d H:i:s'));
    }
    public function getAll(){
        return $this->model::all();
    }
    public function findById($id){
        return $this->model::find($id);
    }
    public function get(){
        return $this->model;
    }
    public function getId(){
        return $this->model->getAttribute('id');
    }

    public function getWalletPromotionCodesHistory(): WalletPromotionCodesHistoryRepository{
        return new WalletPromotionCodesHistoryRepository($this->model->walletPromotionCodesHistory());
    }
    public function getCode(){
        return $this->model->getAttribute('code');
    }
    public function getQuota(){
        return $this->model->getAttribute('quota');
    }
    public function getAmount(){
        return $this->model->getAttribute('amount');
    }
    public function getStartDate(){
        return $this->model->getAttribute('start_date');
    }
    public function getEndDate(){
        return $this->model->getAttribute('end_date');
    }
    public function save(): bool{
        return $this->model->save();
    }

}
