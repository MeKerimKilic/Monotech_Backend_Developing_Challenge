<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;

use App\Repositories\WalletInterface;
use App\Repositories\UserInterface;


class RegisterController extends Controller
{
    private $userRepository;
    private $walletRepository;

    public function __construct(UserInterface $userRepository,WalletInterface $walletRepository)
    {
        $this->userRepository=$userRepository;
        $this->walletRepository=$walletRepository;
    }

    public function register(RegisterRequest $request): \Illuminate\Http\JsonResponse
    {

        $wallet= $this->walletRepository;
        $wallet->save();
        $user = $this->userRepository;
        $user->setFirstName($request->firstname);
        $user->setLastName($request->lastname);
        $user->setMail($request->email);
        $user->setUsername($request->username);
        $user->setWalletId($wallet->getId());
        $user->setPassword(bcrypt($request->password));
        $user->save();
        return response()->json([
            'message' => 'User Successfully Created.',
            'success'=>true
        ], 201);
    }
}
