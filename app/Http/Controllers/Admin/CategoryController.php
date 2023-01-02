<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    public function categories()
    {
        Session::put('page', 'categories');
        $categories = Category::with('section', 'parentcategory')->get()->toArray();
        // dd($categories);
        return view('admin.categories.categories')->with(compact('categories'));
    }

    public function updatedCategoryStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            //  echo "<pre>"; print_r($data); die;

            if ($data["status"] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }

            Category::where('id', $data['category_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'category_id' => $data['category_id']]);

        }
    }


    public function addEditCategory(Request $request, $id = null){
          if($id==""){
            // Add Category;
            $title = "Add Category";
            $category = new Category();
            $getCategories = array();  
            $message = "Category added successfully !";

          }else{
            //Edit Category;
            $title = "Edit Category";
            $category = Category::find($id);
             $getCategories  = Category::with('subcategories')->where(['parent_id' =>0,'section_id' =>$category['section_id']])->get();

            $message = "Category updated successfully !";

           
          } 
         
           if($request->isMethod('post')){
              $data = $request->all();
             // dd($data);

             //Upload Category Image

                    if (\Request::hasFile('category_image')) {

                        $image_tmp = $request->file('category_image');

                        if ($image_tmp->isValid()) {
                            //Get Image Extension
                            $extension = $image_tmp->getClientOriginalExtension();
                            //Generate New Image Name
                            $imageName = rand(11, 99999) . '.' . $extension;
                            $imagePath = 'admin/images/category_images';
                            $request->file('category_image')->move($imagePath, $imageName);
                           $category->category_image = $imageName;
                        }
                    }else{
                         $category->category_image = "";
                    }

                    $category->section_id = $data['section_id'];
                    $category->parent_id = $data['parent_id'];
                    $category->category_name = $data['category_name'];
                    $category->category_discount = $data['category_discount'];
                    $category->description = $data['description'];
                    $category->url = $data['url'];
                    $category->meta_title = $data['meta_title'];
                    $category->meta_keywords = $data['meta_keywords'];
                     $category->status = 1;
                    $category->meta_description = $data['meta_description'];
                    $category->save(); 

                    return redirect('admin/categories')->with('success_message',$message);

 
           }
          //Get all category
          $getSections = Section::get()->toArray(); 

           return view('admin.categories.add_edit_categories')->with(compact('title','category','getSections','getCategories'));          
    } 


    public function appendCategoryLevel(Request $request){
          if($request->isMethod('post')){
              $data = $request->all();
              $getCategories  = Category::with('subcategories')->where(['parent_id' =>0,'section_id' =>$data['section_id']])->get()->toArray();
               
                 return view('admin.categories.append_categories_level')->with(compact('getCategories'));   

          }
    }  

}
 