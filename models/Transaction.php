<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $guarded = [];

    public $timestamps = false;

    protected $dates = ['performed_at'];

    public function payer()
    {
        return $this->belongsTo(User::class, 'id', 'payer_id');
    }

    public function recipient()
    {
        return $this->belongsTo(User::class, 'id', 'recipient_id');
    }
}
