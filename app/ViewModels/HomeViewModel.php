<?php

namespace App\ViewModels;

class HomeViewModel
{
    public $user;

    public $transactions;

    public function __construct($user, $outboundTransactions, $inboundTransactions)
    {
        $this->user = $user;
        $this->transactions = $this->initTransactions(
            $outboundTransactions,
            $inboundTransactions,
            $user->name
        );
    }

    private function initTransactions($outboundTransactions, $inboundTransactions, $userName)
    {
        return $this
            ->getFormatOutboundTransactions($outboundTransactions)
            ->merge(
                $this->getFormatInboundTransactions($inboundTransactions, $userName)
            );
    }

    private function getFormatOutboundTransactions($outboundTransactions)
    {
        return $outboundTransactions->map(function ($item) {
            return [
                'performed_at' => $item->performed_at->format('Y-m-d H:i'),
                'name' => $item->recipient->name,
                'amount' => $item->amount,
                'balance' => 0
            ];
        });
    }

    private function getFormatInboundTransactions($inboundTransactions, $name)
    {
        return $inboundTransactions->map(function ($item) use ($name) {
            return [
                'performed_at' => $item->performed_at->format('Y-m-d H:i'),
                'name' => $name,
                'amount' => $item->amount,
                'balance' => 0
            ];
        });
    }

}