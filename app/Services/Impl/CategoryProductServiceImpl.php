<?php 
namespace App\Services\Impl;

use App\Services\CategoryProductService;
use  App\Repositories\CategoryProductRepository;

class CategoryProductServiceImpl implements CategoryProductService
{
    protected $category_product_repository;

    public function __construct(CategoryProductRepository $category_product_repository)
    {
        $this->category_product_repository = $category_product_repository;
    }

    public function getAll()
    {
        $category_product = $this->category_product_repository->getAll();
        return $category_product;
    }

    public function findById($id)
    {
        $category_product = $this->category_product_repository->findById($id);
        return $category_product;
    }

    public function create($request)
    {
        $category_product = $this->category_product_repository->create($request);
        $statusCode = 201;
        if(!$category_product){
          $statusCode = 500;
        }
        $data = [
            'category_product'=>$category_product,
            'statusCode'=>$statusCode
        ];
        return $data;
    }

    public function update($request,$id)
    {
        $old_category_product = $this->category_product_repository->findById($id);

        if(!$old_category_product){
            $new_category_product = null;
            $statusCode = 404;
        }else{
            $new_category_product = $this->category_product_repository->update($request,$old_category_product);
            $statusCode = 200;
        }

        $data = [
            'category_product'=>$new_category_product,
            'statusCode'=>$statusCode
        ];
        return $data;
    }

    public function destroy($id)
    {
        $category_product = $this->category_product_repository->findById($id);

        if(!$category_product){
            $statusCode = 404;
            $message = "Not Found";
        }else{

        $this->category_product_repository->destroy($category_product);
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
