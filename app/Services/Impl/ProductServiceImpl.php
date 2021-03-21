<?php 
namespace App\Services\Impl;

use App\Services\ProductService;
use  App\Repositories\ProductRepository;

class ProductServiceImpl implements ProductService
{
    protected $product_repository;

    public function __construct(ProductRepository $product_repository)
    {
        $this->product_repository = $product_repository;
    }

    public function getAll()
    {
        $product = $this->product_repository->getAll();
        return $product;
    }

    public function findById($id)
    {
        $product = $this->product_repository->findById($id);
        return $product;
    }

    public function create($request)
    {
        $product = $this->product_repository->create($request);
        $statusCode = 201;
        if(!$product){
          $statusCode = 500;
        }
        $data = [
            'product'=>$product,
            'statusCode'=>$statusCode
        ];
        return $data;
    }

    public function update($request,$id)
    {
        $old_product = $this->product_repository->findById($id);

        if(!$old_product){
            $new_product = null;
            $statusCode = 404;
        }else{
            $new_product = $this->product_repository->update($request,$old_product);
            $statusCode = 200;
        }

        $data = [
            'product'=>$new_product,
            'statusCode'=>$statusCode
        ];
        return $data;
    }

    public function destroy($id)
    {
        $product = $this->product_repository->findById($id);

        if(!$product){
            $statusCode = 404;
            $message = "Not Found";
        }else{

        $this->product_repository->destroy($product);
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
