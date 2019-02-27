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
        return $this->belongsTo(User::class, 'payer_id', 'id');
    }

    public function recipient()
    {
        return $this->belongsTo(User::class, 'recipient_id', 'id');
    }
}
