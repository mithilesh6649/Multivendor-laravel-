<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Section;
use App\Models\ProductsAttribute;
use Illuminate\Http\Request;
use Session,Auth;
use Image;

class ProductController extends Controller
{
    public function products()
    {
        Session::put('page', 'products');
        $products = Product::with(['section' => function ($query) {
            $query->select(['id', 'name'])->get();
        }, 'category' => function ($query) {
            $query->select(['id', 'category_name'])->get();
        }])->get()->toArray();
        //dd($products);
        return view('admin.products.products')->with(compact('products'));
    }

    public function addEditProduct(Request $request, $id = null)
    {
        if (empty($id)) {
            $title = "Add product";
            $product = new Product;
            $message = "Product added successfully";  
        } else {
             $title = "Edit product";
             $product = Product::find($id);
             $message = "Product updated successfully";

        }

        if ($request->isMethod('post')) {

           //dd($request->all());
          $data = $request->all();
            $rules = [
                'category_id' => 'required',
                'product_name' => 'required',
                'product_code' => 'required',
                'product_color' => 'required',
                'product_price' => 'required',
                'url' => 'required',
            ];

            $customMessage = [
                'category_id.required' => ' category is required',
                'product_name.required' => 'required',
                'product_code.required' => 'required',
                'product_color.required' => 'required',
                'product_price.required' => 'required',
                'url.required' => 'required',
            ];

           // $this->validate($request, $rules, $customMessage);
            
            //Upload Product Image after resize small: 250*250 medium:500*500 large:1000*1000

            if($request->hasFile('product_image')){
                $image_tmp = $request->file('product_image');
                if($image_tmp->isValid()){
                      $extension = $image_tmp->getClientOriginalExtension();
                            //Generate New Image Name
                      $imageName = rand(11, 99999) . '.' . $extension;
                      $largeImagePath = 'front/images/product_images/large/'.$imageName;
                      $mediumImagePath = 'front/images/product_images/medium/'.$imageName;
                      $smallImagePath = 'front/images/product_images/small/'.$imageName; 
                      //Upload the larage,medium,small images after resize
                       // if (!file_exists($largeImagePath)) {
                       //    mkdir($largeImagePath, 666, true);
                       // }

                       // if (!file_exists($mediumImagePath)) {
                       //    mkdir($mediumImagePath, 666, true);
                       // }

                       // if (!file_exists($smallImagePath)) {
                       //    mkdir($smallImagePath, 666, true);
                       // }

                      Image::make($image_tmp)->resize(1000,1000)->save($largeImagePath);
                      Image::make($image_tmp)->resize(500,500)->save($mediumImagePath);
                      Image::make($image_tmp)->resize(250,250)->save($smallImagePath);
                       //insert Image name in product table... 
                      $product->product_image  =  $imageName;   
                }
            }

            //Upload Product video.........

            if($request->hasFile('product_video')){
                $video_tmp = $request->file('product_video');
                if($video_tmp->isValid()){
                  //  $video_name = $video_tmp->getClientOriginalName(); 
                    $extension = $video_tmp->getClientOriginalExtension();
                    $videoName = rand(11, 99999).".".$extension;
                    $videoPath = 'front/videos/product_video/';

                    if (!file_exists($videoPath)) {
                          mkdir($videoPath, 666, true);
                    }

                    $video_tmp->move($videoPath,$videoName);
                    //Insert video name in product table...
                    $product->product_video = $videoName; 
                     
                } 
            }

            //Save Product details in products table...
 
            $categoryDetails = Category::find($data['category_id']);
            $product->section_id  = $categoryDetails['section_id'];
            $product->category_id  = $data['category_id'];
            $product->brand_id  = $data['brand_id'];
            
            $adminType = Auth::guard('admin')->user()->type;
            $vendor_id = Auth::guard('admin')->user()->vendor_id;
            $admin_id = Auth::guard('admin')->user()->id;
            if($adminType=='vendor'){
                $product->vendor_id = $vendor_id;
            }else{
                $product->vendor_id = 0;
            }          
            $product->admin_id = $admin_id; 
            $product->admin_type = $adminType;
            $product->product_name = $data['product_name'];
            $product->product_code = $data['product_code'];
            $product->product_color = $data['product_color'];
            $product->product_price = $data['product_price'];
            $product->product_discount = $data['product_discount'];
            $product->product_weight = $data['product_weight'];
            $product->description = $data['description'];
            $product->meta_title = $data['meta_title'];
            $product->meta_description = $data['meta_description'];
            $product->meta_keywords = $data['meta_keywords'];
            if(!empty($request->is_featured)){
               $product->is_featured = $data['is_featured'];
            }else{
                $product->is_featured = 'No'; 
            }
            $product->status  =  1;
            $product->save();
            return redirect('admin/products')->with('success_message',$message); 
            
           //dd($categoryDetails);


        }

        $sections = Section::with('categories')->get()->toArray();
        $brands = Brand::get()->toArray();
        return view('admin.products.add_edit_products')->with(compact('title', 'sections', 'brands','product'));
    }


    public function deleteProductImage($id){
        dd($id);
     //Get Product Image
    $productImage = Product::select('product_image')->where('id',$id)->first(); 
    //Get Product Image Path
            $largeImagePath = 'front/images/product_images/large/';
            $mediumImagePath = 'front/images/product_images/medium/';
            $smallImagePath = 'front/images/product_images/small/'; 

            //Delete Product small image if exists in small folder..
            if(file_exists($smallImagePath.$productImage->product_image)){
             unlink($smallImagePath.$productImage->product_image);
            }

            //Delete Product small image if exists in small folder..
            if(file_exists($mediumImagePath.$productImage->product_image)){
             unlink($mediumImagePath.$productImage->product_image);
            }

            //Delete Product small image if exists in small folder..
            if(file_exists($largeImagePath.$productImage->product_image)){
             unlink($largeImagePath.$productImage->product_image);
            }

            //Delete Product image from product table
            Product::where('id',$id)->update(['product_image','']);
            $message = 'Product Image has been deleted successfully';
            return redirect()->back()->with('success_message',$message);


    }

    public function deleteProductvideo($id){
          
    }
     
    public function addAttributes(Request $request,$id){
        
       $product =  Product::select(['id','product_name','product_code','product_color','product_price','product_image'])->with('attributes')->find($id)->toArray();
  
     // return   \DB::table('products')
     //             ->select('products.id','products.product_name','products.product_code','products.product_color','products.product_price','products.product_image','products_attributes.*')
     //            ->leftJoin('products_attributes','products.id','=','products_attributes.product_id')
     //            ->where('products.id','=',$id)->get()->toArray();
 
        if($request->isMethod('post'))
        {
             $data = $request->all();
              $allAttributes = []; 
            foreach($data['sku'] as $key=>$value) {
                if(!empty($value)){
                  
                  //SKU duplicate check
                    $skuCount  = ProductsAttribute::where('sku',$value)->count();
                    if($skuCount>0){
                        return redirect()->back()->with('error_message','SKU already exist ! Please add another SKU!');
                    }

                     //Size duplicate check
                    $sizeCount  = ProductsAttribute::where(['product_id'=>$id,'size'=>$data['size'][$key]])->count();
                    if($sizeCount>0){
                        return redirect()->back()->with('error_message','Size already exist ! Please add another Size!');
                    } 

                  $allAttributes[] = [
                    'product_id' => $id,
                    'sku' => $value,
                    'size' => $data['size'][$key],
                    'price' => $data['price'][$key],
                    'stock' => $data['stock'][$key],
                    'status' => 1,
                  ];    
                }

            }

              ProductsAttribute::insert($allAttributes);

             $message = 'Product  attributes has been saved successfully';
            return redirect()->back()->with('success_message',$message);
        }
        
       return view('admin.attributes.add_edit_attributes')->with(compact( 'product'));

      

    }


    public function updatedAttributeStatus(Request $request){
        if ($request->ajax()) {
            $data = $request->all();
            //  echo "<pre>"; print_r($data); die;

            if ($data["status"] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }

            ProductsAttribute::where('id', $data['attribute_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'attribute_id' => $data['attribute_id']]);

        }
    } 


    public function editAttributes(Request $request,$id){
          if($request->isMethod('post')){
             $data = $request->all();
            
             foreach($data['attributeId'] as $key=>$attribute ){
                if(!empty($attribute)){
                    ProductsAttribute::where('id',$data['attributeId'][$key])->update(['price'=>$data['price'][$key],'stock'=>$data['stock'][$key]]);
                }
             }  
          
              $message = 'Product  Attributes has been updated successfully';
            return redirect()->back()->with('success_message',$message);

          }
          
    }

    public function addImages($id){
          $product =  Product::select(['id','product_name','product_code','product_color','product_price','product_image'])->with('images')->find($id)->toArray();
            return view('admin.images.add_edit_images')->with(compact( 'product'));

      
    }

}
