<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeoMetaCategoryRequest;
use App\Models\SeoMetaCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\DB;

class SeoMetaCategoryController extends Controller
{
    //
    public function getMetaById($id){

        $data = SeoMetaCategory::where('category_id',$id)->get();

        return response()->json($data,200);
    }

    public function create(SeoMetaCategoryRequest $request){

        $check_seo_meta = SeoMetaCategory::where('category_id',$request->category_id)->get();
        
        if(count($check_seo_meta)){

            return response()->json(200);

        }else{

            SeoMetaCategory::insert($request->all());

            return response()->json(201);
        }
      
    }

    public function getDetail($id){

        $object = SeoMetaCategory::find($id);

        return response()->json($object,200);

    }

    public function update(SeoMetaCategoryRequest $request,$id){
        
        $object = SeoMetaCategory::find($id);
        $object->meta_keywords = $request->meta_keywords;
        $object->meta_desc = $request->meta_desc;
        $object->category_id  = $request->category_id;
        $object->save();

        return response()->json($object,201);
    }

    public function delete($id){

        $object = SeoMetaCategory::find($id);

        $object->delete();

        return response()->json($object,200);

    }
}
