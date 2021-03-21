<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name','desc','fabric_material','style','size','origin','color','price','status','category_id','brand_id'];

    public function category(){

        return $this->belongsTo(Category::class);

    }

    public function brand(){

        return $this->belongsTo(Brand::class);
        
    }

    public function photo_librarys(){

        return $this->hasMany(PhotoLibrary::class,'product_id','id');
    }

    
    public function order_details(){

        return $this->hasMany(OrderDetails::class,'product_id','id');
    }


    public function favorite_products(){
        
        return $this->hasMany(FavoriteProduct::class,'product_id','id');
    }
}

