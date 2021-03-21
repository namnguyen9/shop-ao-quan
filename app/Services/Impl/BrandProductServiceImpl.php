<?php
namespace App\Services\Impl;

use App\Repositories\BrandProductRepository;
use App\Services\BrandProductService;

class BrandProductServiceImpl implements BrandProductService{

    protected $brand_product_repository;

    public function __construct(BrandProductRepository $brand_product_repository)
    {
        $this->brand_product_repository = $brand_product_repository;
    }

    public function getAll()
    {
        $brand_product = $this->brand_product_repository->getAll();
        return $brand_product;
    }

    public function findById($id)
    {
        $brand_product = $this->brand_product_repository->findById($id);
        return $brand_product;
    }

    public function create($request)
    {
        $brand_product = $this->brand_product_repository->create($request);
        $statusCode = 201;
        if(!$brand_product){
          $statusCode = 500;
        }
        $data = [
            'brand_product'=>$brand_product,
            'statusCode'=>$statusCode
        ];
        return $data;
    }

    public function update($request,$id)
    {
        $old_brand_product = $this->brand_product_repository->findById($id);

        if(!$old_brand_product){
            $new_brand_product = null;
            $statusCode = 404;
        }else{
            $new_brand_product = $this->brand_product_repository->update($request,$old_brand_product);
            $statusCode = 200;
        }

        $data = [
            'brand_product'=>$new_brand_product,
            'statusCode'=>$statusCode
        ];
        return $data;
    }

    public function destroy($id)
    {
        $brand_product = $this->brand_product_repository->findById($id);

        if(!$brand_product){
            $statusCode = 404;
            $message = "Not Found";
        }else{

        $this->brand_product_repository->destroy($brand_product);
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