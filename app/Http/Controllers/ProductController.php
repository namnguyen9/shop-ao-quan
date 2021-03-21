<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\FavoriteProduct;
use App\Models\OrderDetails;
use Str;
use App\Models\Product;
use App\Models\PhotoLibrary;
use Illuminate\Http\Request;
use App\Services\ProductService;

class ProductController extends Controller
{
    protected $product_service;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(ProductService $product_service )
    {
        $this->product_service = $product_service;
    }

    public function getData()
     {
         $products = $this->product_service->getAll();

         if($products){
            foreach($products as $pro){
                    $pro->category->name;
                    $pro->brand->name;
            }

         return response()->json($products, 200);
      
        }
    }
 
    public function index()
    {
        return view('admin.product.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(ProductRequest $request)
    {
        $request->validate([
            'name' => 'unique:App\Models\Product,name',
        ],
        $messages = [
            'name.unique' => 'Tên sản phẩm đã tồn tại !'
        ]
    );

        $product = $this->product_service->create($request->all());   
       
        return response()->json($product,201);  
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
    public function show_detail(Request $request, $id)
    {
        $product = $this->product_service->findById($id);

        if($product){
            
          if(count($product->photo_librarys) > 0 && $product->brand->seo_meta_brand && $product->category->seo_meta_category){

            $meta_title = $product->name;
            $meta_desc = $product->brand->seo_meta_brand->meta_desc;
            $meta_keywords = $product->category->seo_meta_category->meta_keywords.','.$product->brand->seo_meta_brand->meta_keywords;
            $image_og ='uploads/images/'.$product->photo_librarys[0]->name;
            $url_canonical = $request->url();

            $librarys = PhotoLibrary::where('product_id',$product->id)->limit(6)->get();

                if(count($librarys) > 0){

                    $product_suggestions  = [];

                    $check_product_suggestions = Product::where('category_id',$product->category->id)->where('brand_id',$product->brand->id)->whereNotIn('id',[$product->id])->get();
                    
                    if(count($check_product_suggestions) > 0 ){

                        foreach($check_product_suggestions as $value){

                            if(count($value->photo_librarys) > 0){
                                array_push($product_suggestions,$value);
                            }
                            
                        }
                        return view('pages.product.details',compact(['product','librarys','product_suggestions','meta_title','meta_desc','meta_keywords','image_og','url_canonical']));  
                    }else{

                        return view('pages.product.details',compact(['product','librarys','product_suggestions','meta_title','meta_desc','meta_keywords','image_og','url_canonical']));  
                    }
                }else{

                    $librarys = [];

                    return view('pages.product.details',compact(['product','librarys','product_suggestions','meta_title','meta_desc','meta_keywords','image_og','url_canonical']));  

                }

        }else{

            return redirect()->route('trang-chu');
        }
    }
        
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
        $product = $this->product_service->findById($id);

        return response()->json($product, 200);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $check_product = Product::where('name',$request->name)->whereNotIn('id',[$id])->first();
      
        if($check_product){
            
            $request->validate([
                'name' => 'unique:App\Models\Product,name',
            ],

            $messages = [
                'name.unique' => 'Tên sản phẩm đã tồn tại !'
            ]
        );

        }else{

         $object =$this->product_service->update($request->all(),$id);
    
         return response()->json($object['product'],$object['statusCode']);
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
            
        $library = PhotoLibrary::where('product_id',$id)->get();
     
        $favorite_products = FavoriteProduct::where('product_id',$id)->get();

        $order_detail = OrderDetails::where('product_id',$id)->get();

        if(count($order_detail)){

            foreach($order_detail as $val){

                $val->delete();

            }
        }


        if(count($favorite_products)){

            foreach($favorite_products  as $value){
                $value->delete();
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

        $object = $this->product_service->destroy($id);

        return response()->json($object,200);
     
    }

   public function  delete_multiple(Request $request){
       
    foreach($request->list_id as $id){

        $library = PhotoLibrary::where('product_id',$id)->get();

        $favorite_products = FavoriteProduct::where('product_id',$id)->get();

        $order_detail = OrderDetails::where('product_id',$id)->get();

        if(count($order_detail)){

            foreach($order_detail as $val){

                $val->delete();

            }
        }

        if(count($favorite_products)){

            foreach($favorite_products  as $value){
                $value->delete();
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

        $object = $this->product_service->destroy($id);

    }
        return response()->json($object,200);
   }
    
    public function hide_product($id){
        
        $product = $this->product_service->update(['status'=> 0],$id);

        return response()->json($product,200);
        
    }

    public function show_product($id){
        
        $product = $this->product_service->update(['status'=> 1],$id);

        
        return response()->json($product,200);
        
    }
}

