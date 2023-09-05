<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\GlobalScopesTrait;
class Category extends Model
{
    use HasFactory,GlobalScopesTrait;

    public function section()
    {
        return $this->belongsTo('App\Models\Section', 'section_id')->select('id', 'name');
    }

    public function parentcategory()
    {
        return $this->belongsTo('App\Models\Category', 'parent_id')->select('id', 'category_name');
    }

     public function subcategories()
    {
        return $this->hasMany('App\Models\Category', 'parent_id')->where('status',1);
    }

    public static function categoryDetails($url){
       $categoryDetails =  self::select('id','category_name','url')->with('subcategories')->where('url',$url)->first()->toArray();
       $catIds = array();
       $catIds[] = $categoryDetails['id'];
       foreach($categoryDetails['subcategories'] as $key => $subcat) {
              
              $catIds[] = $subcat['id'];

            }
       return $resp = array('catIds'=>$catIds,'categoryDetails'=>$categoryDetails);    
    }
}
