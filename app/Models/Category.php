<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use tidy;

class Category extends Model
{
    use HasFactory;
    
    protected  $fillable = ['name','desc','status'];

    public function products(){

        return $this->hasMany(Product::class,'category_id','id');
        
    }

    
    public function seo_meta_category()
    {
        return $this->hasOne(SeoMetaCategory::class,'category_id','id');
    }   

}
