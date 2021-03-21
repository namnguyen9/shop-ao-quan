<?php 
namespace App\Repositories\Impl;

use App\Models\Product;
use App\Repositories\Eloquent\EloquentRepository;
use App\Repositories\ProductRepository;

class ProductRepositoryImpl extends EloquentRepository implements ProductRepository
{
    public function getModel()
    {
        $model = Product::class;
        
        return $model;
    }

}
?>