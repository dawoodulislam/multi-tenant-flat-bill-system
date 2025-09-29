<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $fillable = ['owner_id','building_id','flat_id','bill_category_id','month','amount','status','notes','due_previous'];

    protected $casts = [
        'month' => 'date',
    ];

    protected $dates = ['month'];

    public function owner()
    {
        return $this->belongsTo(User::class,'owner_id');
    }

    public function building()
    {
        return $this->belongsTo(Building::class);
    }

    public function flat()
    {
        return $this->belongsTo(Flat::class);
    }

    public function category()
    {
        return $this->belongsTo(BillCategory::class,'bill_category_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function markPaid($amount, $paidBy = null, $reference = null)
    {
        // create payment and adjust status & due
        $this->payments()->create([
            'amount' => $amount,
            'paid_by' => $paidBy,
            'reference' => $reference,
            'paid_at' => now(),
        ]);

        // if amount covers total owed (amount + due_previous) => paid
        $totalDue = $this->amount + $this->due_previous;
        $paidSum = $this->payments()->sum('amount');

        if ($paidSum >= $totalDue) {
            $this->status = 'paid';
        }
        $this->save();
    }
}
