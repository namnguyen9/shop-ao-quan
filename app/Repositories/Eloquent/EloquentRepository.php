<?php 
namespace App\Repositories\Eloquent;

use App\Repositories\Repository;

abstract class EloquentRepository implements Repository
{

    protected $model;
//Hàm khởi tạo
    public function __construct()
    {
        $this->setModel();
    }
//Hàm lấy model
    abstract public function getModel();

//Hàm đặt lại model
    public function setModel()
    {
        $this->model = app()->make($this->getModel());
    }
// Hàm lấy tất cả dữ liệu
    public function getAll()
    {
        $result = $this->model->all();

        return $result;
    }
//Hàm lấy về dữ liệu theo id của đối tượng
    public function findById($id)
    {
        $result = $this->model->find($id);

        return $result;
    }
//Hàm thêm dữ liệu
    public function create($data)
    {
        try {
            $object = $this->model->create($data);
        }catch(\Exception $e) {
            return $e->getMessage();
        }

        return $object;
    }
//Hàm cập nhật dữ liệu
    public function update($data,$object)
    {
        try{
            $object->update($data);
            return $object;
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }
//Hàm xóa dữ liệu theo đối tượng
    public function destroy($object)
    {
        $object->delete();
    }
   
}

?>