<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['bill_id','amount','paid_by','paid_at','reference'];

    public function bill()
    {
        return $this->belongsTo(Bill::class);
    }

    public function payer()
    {
        return $this->belongsTo(User::class,'paid_by');
    }
}
