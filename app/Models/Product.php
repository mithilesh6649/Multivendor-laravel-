<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\GlobalScopesTrait;
class Product extends Model
{
    use HasFactory,GlobalScopesTrait;

    public function section(){
        return $this->belongsTo('App\Models\Section','section_id');
    }

    public function category(){
     return $this->belongsTo('App\Models\Category','category_id');
    }

    public function attributes(){
     return $this->hasMany('App\Models\ProductsAttribute');
    }

     public function images(){
     return $this->hasMany('App\Models\ProductsImage');
    }


    public static function getDiscountPrice($product_id){
        $proDetails = Product::select('product_price','product_discount','category_id')->where('id',$product_id)->first();
         //Convert to array....
        $proDetails = json_decode(json_encode($proDetails),true);

        $catDetails = Category::select('category_discount')->where('id',$proDetails)->first();
         //Convert to array....
        $catDetails = json_decode(json_encode($catDetails),true);

        if($proDetails['product_discount']>0)
        {
             
           $discounted_price = $proDetails['product_price'] - ($proDetails['product_price']*$proDetails['product_discount']/100);        
     
        }
        else if($catDetails['category_discount']>0)
        {
             $discounted_price = $catDetails['category_price'] - ($catDetails['category_price']*$catDetails['category_discount']/100);
        }
        else
        {
            $discounted_price = 0;
        }

        return $discounted_price;


    }




}
