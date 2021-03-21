<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhotoLibrary extends Model
{
    use HasFactory;

    protected $table  = 'photo_librarys';

    protected $fillable = ['name','product_id'];

    
    public function product(){

        return $this->belongsTo(Product::class);
        
    }

}
