<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeoMetaBrandRequest;
use App\Models\SeoMetaBrand;
use Illuminate\Http\Request;

class SeoMetaBrandController extends Controller
{
    //
     //
     public function getMetaById($id){

        $data = SeoMetaBrand::where('brand_id',$id)->get();

        return response()->json($data,200);
    }

    public function create(SeoMetaBrandRequest $request){

        $check_seo_meta = SeoMetaBrand::where('brand_id',$request->brand_id)->get();
        

        if(count($check_seo_meta)){

            return response()->json(200);

        }else{

            SeoMetaBrand::insert($request->all());

            return response()->json(201);
        }
      
    }

    public function getDetail($id){

        $object = SeoMetaBrand::find($id);

        return response()->json($object,200);

    }

    public function update(SeoMetaBrandRequest $request,$id){
        
        $object = SeoMetaBrand::find($id);
        $object->meta_keywords = $request->meta_keywords;
        $object->meta_desc = $request->meta_desc;
        $object->brand_id  = $request->brand_id;
        $object->save();

        return response()->json($object,201);
    }

    public function delete($id){

        $object = SeoMetaBrand::find($id);

        $object->delete();

        return response()->json($object,200);

    }
}
