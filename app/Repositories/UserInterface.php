<?php

namespace App\Repositories;

use App\Models\User;

interface UserInterface
{
    public function __construct(User $model);

    public function getAll();
    public function get();
    public function getUserByMail($email);
    public function getWallet();
    public function getName();
    public function getFirstName();
    public function getLastName();

    public function setId($id);
    public function setPassword($password);
    public function setLastName($lastName);
    public function setFirstName($firstName);
    public function setMail($mail);
    public function setWalletId($walletId);
    public function save();
    public function getId();
    public function getMail();
    public function getUserByUsername($username);
    public function setUsername($username);
}
