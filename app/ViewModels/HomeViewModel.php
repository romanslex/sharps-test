<?php

namespace App\ViewModels;

class HomeViewModel
{
    public $transactions;

    public function __construct($outboundTransactions, $inboundTransactions)
    {
        $this->transactions = $this->initTransactions(
            $outboundTransactions,
            $inboundTransactions
        );
    }

    private function initTransactions($outboundTransactions, $inboundTransactions)
    {
        return $this
            ->getFormatOutboundTransactions($outboundTransactions)
            ->merge(
                $this->getFormatInboundTransactions($inboundTransactions)
            );
    }

    private function getFormatOutboundTransactions($outboundTransactions)
    {
        return $outboundTransactions->map(function ($item) {
            return [
                'performed_at' => $item->performed_at->format('Y-m-d H:i'),
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
                'performed_at' => $item->performed_at->format('Y-m-d H:i'),
                'name' => $item->payer->name,
                'amount' => $item->amount,
                'balance' => $item->recipient_balance,
                'is_outbound' => false
            ];
        });
    }

}