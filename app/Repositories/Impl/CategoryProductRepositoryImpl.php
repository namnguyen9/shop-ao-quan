<?php 
namespace App\Repositories\Impl;

use App\Models\Category;
use App\Repositories\Eloquent\EloquentRepository;
use App\Repositories\CategoryProductRepository;

class CategoryProductRepositoryImpl extends EloquentRepository implements CategoryProductRepository
{
    public function getModel()
    {
        $model = Category::class;
        
        return $model;
    }

}
?>