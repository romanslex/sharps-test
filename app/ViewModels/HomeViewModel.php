<?php

namespace App\ViewModels;

use Models\User;

class HomeViewModel
{
    public $user;
    public $users;
    public $transactions;

    public function __construct(User $user, $users, $outboundTransactions, $inboundTransactions)
    {
        $this->user = $this->initUser($user);
        $this->users = $this->initUsers($users);
        $this->transactions = $this->initTransactions(
            $outboundTransactions,
            $inboundTransactions
        );
    }

    private function initUser($user)
    {
        return [
            'name' => $user->name,
            'balance' => $user->balance,
        ];
    }

    private function initUsers($users)
    {
        return $users->map(function ($user) {
            return [
                'label' => $user->name,
                'value' => $user->id
            ];
        });
    }

    private function initTransactions($outboundTransactions, $inboundTransactions)
    {
        return array_merge(
            $this->getFormatInboundTransactions($inboundTransactions)->toArray(),
            $this->getFormatOutboundTransactions($outboundTransactions)->toArray()
        );
    }

    private function getFormatOutboundTransactions($outboundTransactions)
    {
        return $outboundTransactions->map(function ($item) {
            return [
                'recipient_id' => $item->recipient_id,
                'performed_at' => $item->performed_at->format('Y-m-d H:i:s'),
                'name' => $item->recipient->name,
                'amount' => $item->amount,
                'balance' => $item->payer_balance,
                'is_outbound' => true
            ];
        });
    }

    private function getFormatInboundTransactions($inboundTransactions)
    {
        return $inboundTransactions->map(function ($item) {
            return [
                'performed_at' => $item->performed_at->format('Y-m-d H:i:s'),
                'name' => $item->payer->name,
                'amount' => $item->amount,
                'balance' => $item->recipient_balance,
                'is_outbound' => false
            ];
        });
    }

}