<?php

namespace Models;

use App\Exceptions\NotEnoughMoneyException;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $guarded = [];

    public $timestamps = false;

    protected $dates = ['performed_at'];

    public function payer()
    {
        return $this->belongsTo(User::class, 'payer_id', 'id');
    }

    public function recipient()
    {
        return $this->belongsTo(User::class, 'recipient_id', 'id');
    }

    public static function createRemittance($payer, $recipient, $amount)
    {
        $transaction = null;
        \DB::transaction(function() use ($payer, $recipient, $amount, &$transaction) {
            if($payer->balance < $amount)
                throw new NotEnoughMoneyException('Not enough money for this action');

            $payer->balance -= $amount;
            $recipient->balance += $amount;

            $payer->save();
            $recipient->save();

            $transaction = $payer->outboundTransactions()->create([
                'recipient_id' => $recipient->id,
                'amount' => $amount,
                'payer_balance' => $payer->balance,
                'recipient_balance' => $recipient->balance,
                'performed_at' => now()
            ]);
        });
        return $transaction;
    }
}
