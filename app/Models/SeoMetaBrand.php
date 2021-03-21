<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeoMetaBrand extends Model
{
    use HasFactory;

    
    protected $table  = 'seo_meta_brand';

    protected $fillable = ['meta_keywords','meta_desc','brand_id'];


    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
