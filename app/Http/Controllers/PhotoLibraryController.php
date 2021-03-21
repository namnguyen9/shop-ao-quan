<?php

namespace App\Http\Controllers;

use Str;
use App\Models\PhotoLibrary;
use Illuminate\Http\Request;

class PhotoLibraryController extends Controller
{

    public function getById_image($id){

            $images = PhotoLibrary::where('product_id',$id)->get();

            return response()->json($images,200);
    }

    public function create(Request $request,$id ){
            $check_images = PhotoLibrary::where('product_id',$id)->get();
            if(count($check_images) < 6){
                if($request->hasFile('images0')){
                    for($i = 0 ; $i <= 6 ; $i++){
                        $file = $request->file('images'.$i);    
                        if($file){
                        $name_image = $file->getClientOriginalName();
                        $image = Str::random(5) . "_" . $name_image;
                        while (file_exists("uploads/images/" . $image))
                        {
                            $image = Str::random(5) . "_" . $name_image;
                        }   
                            $file->move("uploads/images", $image);
                            $photo_library = new PhotoLibrary();
                            $photo_library->name = $image;
                            $photo_library->product_id  = $id;
                            $photo_library->save();
                        }else{
                            return response()->json(404);  
                        }
                    }
                }else{
                return response()->json(404);  
                }
            }else{
                return response()->json(200);  
            }
            
    }

    public function update_name(Request $request,$id){
        
        if($request->name){
            $request_name = preg_replace('/\s+/', '',$request->name);
            $image = PhotoLibrary::find($id);
            $product_id = $image->product->id;
            $file = file_exists("uploads/images/" . $request_name);
            $old_name = "uploads/images/" . $image->name;
            $new_name ="uploads/images/" . $request_name;
            $old_img= basename($old_name);
            if($file){
                return response()->json($product_id);
            }else{
                $check_ext = substr(strrchr($request_name, '.'), 1 );
                if($check_ext){
                    $get_name = substr($request_name, 0, -4);
                    $ext= substr(strrchr($old_img, '.'), 1);
                    rename($old_name,"uploads/images/".$get_name.".".$ext);
                    $image->name = $get_name.".".$ext;
                    $image->save();
                    return response()->json($product_id);
                }else{
                    $ext= substr(strrchr($old_img, '.'), 1);
                    $check_file = file_exists($new_name.".".$ext);
                    if($check_file){
                        return response()->json($product_id);
                    }else{
                        rename($old_name, $new_name.".".$ext);
                        $image->name = $request_name.".".$ext;
                        $image->save();
                    }
                }
            }
        }else{
            return response()->json($id);
        }
    }

    public function update_file(Request $request,$id){
        if($request->hasFile('file')){
                $get_img_byId = PhotoLibrary::find($id);
                $file = $request->file('file');
                $name_image = $file->getClientOriginalName();
                $image = Str::random(5) . "_" . $name_image;
                while (file_exists("uploads/images/" . $image))
                {
                $image = Str::random(5) . "_" . $name_image;
                }
                $file->move("uploads/images", $image);
                if(file_exists("uploads/images/" . $get_img_byId->name))
                {
                    unlink("uploads/images/" . $get_img_byId->name);
                }
                $get_img_byId->name = $image;
                $get_img_byId->product_id = $get_img_byId->product_id;
                $get_img_byId->save();
                return response()->json(200);
        }else{
            return response()->json(404);
        }
    }

    public function destroy($id){
        $get_file = PhotoLibrary::find($id);
        if($get_file){
            if(file_exists("uploads/images/" . $get_file->name))
            {
                $get_file->delete();

                unlink("uploads/images/" . $get_file->name);

                return response()->json(200);
            }else{
                $get_file->delete();

                return response()->json(200);
            }
        }
        return response()->json(404);
    }

    public function delete_multiple(Request $request){
        foreach($request->list_id as $id){
        
            $get_file = PhotoLibrary::find($id);

            if($get_file){
                if(file_exists("uploads/images/" . $get_file->name))
                {
                    $get_file->delete();

                    unlink("uploads/images/" . $get_file->name);

                }else{

                    $get_file->delete();

                }
            }
        }
        return response()->json(200);

    }
}
