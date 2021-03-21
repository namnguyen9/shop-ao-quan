<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = ['name','desc','status'];

    public function products(){

        return $this->hasMany(Product::class,'brand_id','id');
    }
    
    public function seo_meta_brand()
    {
        return $this->hasOne(SeoMetaBrand::class,'brand_id','id');
    }  
}
