<?php
namespace App\Services\Impl;

use App\Repositories\OrderRepository;
use App\Services\OrderService;

class OrderServiceImpl implements OrderService{

    protected $order_repository;

    public function __construct(OrderRepository $order_repository)
    {
        $this->order_repository = $order_repository;
    }

    public function getAll()
    {
        $order = $this->order_repository->getAll();
        return $order;
    }

    public function findById($id)
    {
        $order = $this->order_repository->findById($id);
        return $order;
    }

    public function create($request)
    {
        $order = $this->order_repository->create($request);
        $statusCode = 201;
        if(!$order){
          $statusCode = 500;
        }
        $data = [
            'order'=>$order,
            'statusCode'=>$statusCode
        ];
        return $data;
    }

    public function update($request,$id)
    {
        $old_order = $this->order_repository->findById($id);

        if(!$old_order){
            $new_order = null;
            $statusCode = 404;
        }else{
            $new_order = $this->order_repository->update($request,$old_order);
            $statusCode = 200;
        }

        $data = [
            'order'=>$new_order,
            'statusCode'=>$statusCode
        ];
        return $data;
    }

    public function destroy($id)
    {
        $order = $this->order_repository->findById($id);

        if(!$order){
            $statusCode = 404;
            $message = "Not Found";
        }else{

        $this->order_repository->destroy($order);
            $statusCode = 200;
            $message = "Delete success";
        }
            $data =  [
                'message'=>$message,
                'statusCode'=>$statusCode
            ];
            return $data;
    }

}

?>