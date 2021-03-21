<?php 
namespace App\Repositories\Impl;

use App\Models\Order;
use App\Repositories\OrderRepository;
use App\Repositories\Eloquent\EloquentRepository;

class OrderRepositoryImpl extends EloquentRepository implements OrderRepository{
  
    public function getModel()
    {
        $model = Order::class;

        return $model;
    }
}

?>