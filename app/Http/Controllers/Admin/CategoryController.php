<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
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
          if($id=''){
            // Add Category;
            $title = "Add Category";
            $category = new Category();
            $message = "Category added successfully !";

          }else{
            //Edit Category;
            $title = "Edit Category";
            $category = Category::find($id);
            $message = "Category updated successfully !";

          }           
    }

}
