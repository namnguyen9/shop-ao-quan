<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    protected $table  = 'districts';

    public function province_and_city(){

        return $this->belongsTo(ProvinceAndCity::class);
        
    }

    
    public function shipping()
    {
        return $this->hasOne(Shipping::class,'district_id','id');
    }
}
