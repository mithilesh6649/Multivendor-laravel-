<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;
     
    public static function sections(){
        $getSection = Section::active()->with('categories')->get()->toArray();
        return $getSection;
      // return \DB::select('SELECT * FROM sections');
    }
    
    public function categories(){
        return $this->hasMany('App\Models\Category','section_id')->where(['parent_id'=>0,'status'=>1])->with('subcategories');
    }

    public function scopeActive($query){
        return $query->where('status',1);
    }
}
