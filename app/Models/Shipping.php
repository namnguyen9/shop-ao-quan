<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasFactory;

    protected  $fillable = ['name','phone','customer_id','province_and_city_id','district_id','wards_and_communes','street_names'];

    public function user(){

        return $this->belongsTo(User::class);
        
    }

    public function province_and_city()
    {
        return $this->belongsTo(ProvinceAndCity::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function orders(){
        
        return $this->hasMany(Order::class,'shipping_id','id');

    }
}
