<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Flat extends Model
{
     protected $fillable = ['building_id','owner_id','flat_number','flat_owner_name','flat_owner_contact','flat_owner_email'];

    public function building()
    {
        return $this->belongsTo(Building::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class,'owner_id');
    }

    public function bills()
    {
        return $this->hasMany(Bill::class);
    }

    public function tenant()
    {
        return $this->hasOne(Tenant::class);
    }
}
