<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    protected $fillable = ['name','address','owner_id'];

    public function owner()
    {
        return $this->belongsTo(User::class,'owner_id');
    }

    public function flats()
    {
        return $this->hasMany(Flat::class);
    }

    public function tenants()
    {
        return $this->hasMany(Tenant::class);
    }
}
