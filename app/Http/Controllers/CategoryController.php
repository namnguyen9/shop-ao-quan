<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\FavoriteProduct;
use App\Models\OrderDetails;
use App\Models\PhotoLibrary;
use Illuminate\Http\Request;
use App\Services\CategoryProductService;
use App\Models\Product;
use App\Models\SeoMetaCategory;
use Illuminate\Support\Facades\Validator;


class CategoryController extends Controller
{
    protected $category_product_service;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(CategoryProductService $category_product_service)
    {
        $this->category_product_service = $category_product_service;
    }

    public function getData()
     {
         $category_product =$this->category_product_service->getAll();
 
         return response()->json($category_product, 200);
     }
 
    public function index()
    {
        return view('admin.category_product.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CategoryRequest $request)
    {
     
        $request->validate([
            
            'name' => 'unique:App\Models\Category,name',
        ],

        $messages = [
            'name.unique' => 'Tên danh mục đã tồn tại !'
        ]
    );

        $object = $this->category_product_service->create($request->all());
       
        return response()->json($object,201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $category_product = $this->category_product_service->findById($id);

        return response()->json($category_product, 200);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $check_category = Category::where('name',$request->name)->whereNotIn('id',[$id])->first();
      
        if($check_category){
            
            $request->validate([
                'name' => 'unique:App\Models\Category,name',
            ],

            $messages = [
                'name.unique' => 'Tên danh mục đã tồn tại !'
            ]
        );

        }else{

            $object = $this->category_product_service->update($request->all(),$id);

            return response()->json($object['category_product'],$object['statusCode']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $products = Product::where('category_id',$id)->get();

        $check_seo = SeoMetaCategory::where('category_id',$id)->first();

        if(count($products) > 0){

            foreach($products as $value){

                $library = PhotoLibrary::where('product_id',$value->id)->get();
     
                $favorite_products = FavoriteProduct::where('product_id',$value->id)->get();

                $order_detail = OrderDetails::where('product_id',$value->id)->get();

                if(count($order_detail)){
        
                    foreach($order_detail as $val){
        
                        $val->delete();
        
                    }
                }
            
                if(count($favorite_products)){
        
                    foreach($favorite_products  as $element){
                        $element->delete();
                    }
        
                }
        
                if(count($library)){
    
                    foreach($library as $image){
        
                        if(file_exists("uploads/images/" . $image->name)){
        
                            unlink("uploads/images/" . $image->name);
        
                            $image->delete();
                        }
                        $image->delete();
                     }
                }
                $value->delete();
            }
            
            
            if($check_seo){

                $check_seo->delete();
            }
          
            $object = $this->category_product_service->destroy($id);
    
            return response()->json($object,200);

        }else{

            if($check_seo){

                $check_seo->delete();
    
            }

            $object = $this->category_product_service->destroy($id);

            return response()->json($object,200);
        }
       
    }
    
    public function delete_multiple(Request $request){

        foreach($request->list_id as $id){

            $products = Product::where('category_id',$id)->get();

            $check_seo = SeoMetaCategory::where('category_id',$id)->first();

            if(count($products) > 0){

                foreach($products as $value){

                    $library = PhotoLibrary::where('product_id',$value->id)->get();
         
                    $favorite_products = FavoriteProduct::where('product_id',$value->id)->get();

                    $order_detail = OrderDetails::where('product_id',$value->id)->get();
                
                    if(count($order_detail)){
            
                        foreach($order_detail as $val){
            
                            $val->delete();
            
                        }
                    }

                    if(count($favorite_products)){
            
                        foreach($favorite_products  as $element){
                            $element->delete();
                        }
            
                    }
            
                    if(count($library)){
        
                        foreach($library as $image){
            
                            if(file_exists("uploads/images/" . $image->name)){
            
                                unlink("uploads/images/" . $image->name);
            
                                $image->delete();
                            }
            
                            $image->delete();
            
                         }
                    }
            
                   $value->delete();
                }
                if($check_seo){

                    $check_seo->delete();
                }

                $object = $this->category_product_service->destroy($id);
        
            }else{

                if($check_seo){

                    $check_seo->delete();
                }

                $object = $this->category_product_service->destroy($id);
        
            }
            
        }

        return response()->json($object,200);

    }

    public function hide_category($id){
        
        $object = $this->category_product_service->update(['status'=> 0],$id);

        return response()->json($object,200);
        
    }

    public function show_category($id){
        
        $object = $this->category_product_service->update(['status'=> 1],$id);

        return response()->json($object,200);
        
    }

    public function show_category_home(Request $request,$id) {

        $category_product = $this->category_product_service->findById($id);
        
        
        $category_product->products;
        
        if($category_product->seo_meta_category){

            $category_product->seo_meta_category;
        
            $category_product->seo_meta_category->url = $request->url();
    
        }
      
        foreach($category_product->products as $product){

        $product->photo_librarys;

         }

        return response()->json($category_product,200);

    }
}

