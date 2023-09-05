<?php
 namespace App\Traits;

 trait GlobalScopesTrait
 {
    
    public function scopeActive($query)
    {
    	return $query->where('status',1);
    }

 } 

?>