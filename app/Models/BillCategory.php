<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BillCategory extends Model
{
    protected $fillable = ['name','owner_id'];

    public function owner()
    {
        return $this->belongsTo(User::class,'owner_id');
    }
}
