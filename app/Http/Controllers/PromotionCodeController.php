<?php

namespace App\Http\Controllers;

use App\Http\Requests\PromotionCodeAssignRequest;
use App\Http\Requests\PromotionCodeCreateRequest;
use App\Models\PromotionCode;
use App\Models\WalletPromotionCodesHistory;
use App\Repositories\PromotionCodeInterface;
use App\Repositories\UserInterface;
use App\Repositories\WalletInterface;
use App\Repositories\WalletPromotionCodesHistoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PromotionCodeController extends Controller
{
    private $userRepository;
    private $walletRepository;
    private $promotionCodeRepository;
    private $walletPromotionCodesHistoryRepository;
    public function __construct(
        UserInterface $userRepository,
        WalletInterface $walletRepository,
        PromotionCodeInterface $promotionCodeRepository,
        WalletPromotionCodesHistoryInterface $walletPromotionCodesHistoryRepository
    )
    {
        $this->userRepository=$userRepository;
        $this->walletRepository=$walletRepository;
        $this->promotionCodeRepository=$promotionCodeRepository;
        $this->walletPromotionCodesHistoryRepository=$walletPromotionCodesHistoryRepository;
    }
    public function list(){
        $json=[];
        $promotionCodes=$this->promotionCodeRepository->getAll();
        foreach ($promotionCodes as $key=>$promotionCode) {
            $users=[];
            $wallets=$promotionCode->walletPromotionCodesHistories()->get();
            $tempWallet=[];
            foreach ($wallets as $key=>$wallet) {
                $wallet=$wallet->wallet()->first();
                $user=$wallet->user()->first();
                if(in_array($wallet->id,$tempWallet)){
                    continue;
                }else{
                    $tempWallet[]=$wallet->id;
                }
                $users[$key]=[
                    'id'=>$user->id,
                    'username'=>$user->username,
                    'email'=>$user->email,
                    'firstname'=>$user->firstname,
                    'lastname'=>$user->lastname,
                    'wallet'=>[
                        'id'=>$wallet->id,
                        'balance'=>$wallet->balance,
                        'updated_at'=>$wallet->updated_at->format('m-d-Y H:i')
                    ]
                ];

            }

            $json[$key]=[
                'id'=>$promotionCode->id,
                'code'=>$promotionCode->code,
                'start_date'=>$promotionCode->start_date,
                'end_date'=>$promotionCode->end_date,
                'amount'=>$promotionCode->amount,
                'quota'=>$promotionCode->quota,
                'users'=>$users,
            ];
        }
        return response()->json([
            'data' => $json,
            'success'=>true
        ], 200);
    }
    public function create(PromotionCodeCreateRequest $request){
        $promotionCode=$this->promotionCodeRepository;
        $promotionCode->setStartDate($request->start_date);
        $promotionCode->setEndDate($request->end_date);
        $promotionCode->setAmount($request->amount);
        $promotionCode->setQuota($request->quota);
        $promotionCode->createCode();
        $promotionCode->save();
        return response()->json([
            'data' => [
                'id'=>$promotionCode->getId(),
                'code'=>$promotionCode->getCode(),
                'start_date'=>$promotionCode->getStartDate(),
                'end_date'=>$promotionCode->getEndDate(),
                'amount'=>$promotionCode->getAmount(),
                'quota'=>$promotionCode->getQuota(),
            ],
            'success'=>true
        ], 201);
    }
    public function assign(PromotionCodeAssignRequest $request){
        $promotionCode=$this->promotionCodeRepository->findByCode($request->code);
        if($promotionCode){
            $promotionCode=$promotionCode->first();
            $wallets=$promotionCode->walletPromotionCodesHistories()->get();
            if($wallets->count()<$promotionCode->quota){
                $user = Auth::user();
                $this->walletPromotionCodesHistoryRepository->setWalletId($user->wallet_id);
                $this->walletPromotionCodesHistoryRepository->setPromotionCodeId($promotionCode->id);
                $this->walletPromotionCodesHistoryRepository->save();
                $wallet=$this->walletRepository->findById($user->wallet_id);
                $wallet->balance=intval($wallet->balance)+intval($promotionCode->amount);
                $wallet->save();
                return response()->json([
                    'success'=>true
                ], 201);
            }else{
                return response()->json([
                    'data' => [],
                    'message'=>'Promotion Code Quota Limit',
                    'success'=>false
                ], 400);
            }

        }else{
            return response()->json([
                'data' => [],
                'message'=>'Promotion Code Not Found',
                'success'=>false
            ], 404);
        }
        $promotionCode=$this->promotionCodeRepository->findByCode($request->code)->first();
        $wallets=$promotionCode->wallets()->get();
        if($wallets->count()){

        }
        dd($wallets->count());
    }
    public function index($id){
        $promotionCode=$this->promotionCodeRepository->findById($id);
        if($promotionCode){
            $users=[];
            $wallets=$promotionCode->walletPromotionCodesHistories()->get();
            $tempWallet=[];
            foreach ($wallets as $key=>$wallet) {
                $wallet=$wallet->wallet()->first();
                $user=$wallet->user()->first();
                if(in_array($wallet->id,$tempWallet)){
                    continue;
                }else{
                    $tempWallet[]=$wallet->id;
                }
                $users[$key]=[
                    'id'=>$user->id,
                    'username'=>$user->username,
                    'email'=>$user->email,
                    'firstname'=>$user->firstname,
                    'lastname'=>$user->lastname,
                    'wallet'=>[
                        'id'=>$wallet->id,
                        'balance'=>$wallet->balance,
                        'updated_at'=>$wallet->updated_at->format('m-d-Y H:i')
                    ]
                ];

            }
            $json=[
                'id'=>$promotionCode->id,
                'code'=>$promotionCode->code,
                'start_date'=>$promotionCode->start_date,
                'end_date'=>$promotionCode->end_date,
                'amount'=>$promotionCode->amount,
                'quota'=>$promotionCode->quota,
                'users'=>$users,
            ];
            return response()->json([
                'data' => $json,
                'success'=>true
            ], 200);
        }else{
            return response()->json([
                'data' => [],
                'message'=>'Promotion Code Not Found',
                'success'=>false
            ], 404);
        }

    }
}
