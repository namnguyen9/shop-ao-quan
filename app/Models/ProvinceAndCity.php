<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProvinceAndCity extends Model
{
    use HasFactory;

    protected $table  = 'provinces_and_cities';

    public function districts(){
        
        return $this->hasMany(District::class,'city_id','id');
    }

    public function shipping()
    {
        return $this->hasOne(Shipping::class,'province_and_city_id','id');
    }
}
