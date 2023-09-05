<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class IndexController extends Controller
{
   

    public function index(){
        // $sliderBanners = Banner::ActiveScope()->where('type','Slider')->get()->toArray();
         // $fixBanners = Banner::ActiveScope()->where('type','Fix')->get()->toArray();
        $newProducts = Product::active()->orderBy('id','Desc')->limit(8)->get(); 
       // $query = \DB::select('SELECT * FROM products WHERE status = 1 ORDER BY id DESC LIMIT 8'); 
         //Illuminate\Support\Collection --> this to this Illuminate\Database\Eloquent\Collection; 
         //dd(collect($query),$newProducts);
       
        // $bestSellers = Product::active()->where('is_bestseller','Yes')->inRandomOrder()->get()->toArray();
        // $discountedProducts = Product::active()->where('product_discount','>',0)->inRandomOrder()->get()->toArray();
        // $featuredProducts = Product::active()->where('is_featured','Yes')->inRandomOrder()->get()->toArray();

      


        return  view('front.index',compact('newProducts'));
    }

}
