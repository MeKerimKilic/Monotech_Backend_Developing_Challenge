<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository implements UserInterface
{
    protected $model;


    public function __construct(User $model) {
        $this->model = $model;

    }
    public function setId($id){
        $this->model=$this->model->setAttribute('id',$id);
    }
    public function setWalletId($walletId){
        $this->model=$this->model->setAttribute('wallet_id',$walletId);
    }
    public function setMail($mail){
        $this->model=$this->model->setAttribute('email',$mail);
    }
    public function setUsername($username){
        $this->model=$this->model->setAttribute('username',$username);
    }
    public function setFirstName($firstName){
        $this->model=$this->model->setAttribute('firstname',$firstName);
    }
    public function setLastName($lastName){
        $this->model=$this->model->setAttribute('lastName',$lastName);
    }
    public function setPassword($password){
        $this->model=$this->model->setAttribute('password',$password);
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
    public function getUserByMail($email){
        return $this->model->where('email',$email)->first();
    }
    public function getUserByUsername($username){
        return $this->model->where('username',$username)->first();
    }
    public function getName(): string{
        return $this->getFirstName().' '.$this->getLastName();
    }
    public function getFirstName(){
        return $this->model->getAttribute('firstname');
    }
    public function getLastName(){
        return $this->model->getAttribute('lastname');
    }
    public function save(): bool
    {
        return $this->model->save();
    }
    public function getMail(){
        return $this->model->getAttribute('email');
    }
    public function getId(){
        return $this->model->getAttribute('id');
    }
}
