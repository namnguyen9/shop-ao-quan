<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeoMetaCategory extends Model
{
    use HasFactory;

    protected $table  = 'seo_meta_category';

    protected $fillable = ['meta_keywords','meta_desc','category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}
