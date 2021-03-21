<?php 
namespace App\Repositories\Impl;

use App\Models\Brand;
use App\Repositories\BrandProductRepository;
use App\Repositories\Eloquent\EloquentRepository;

class BrandProductRepositoryImpl extends EloquentRepository implements BrandProductRepository{
  
    public function getModel()
    {
        $model = Brand::class;

        return $model;
    }
}

?>