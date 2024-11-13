<?php

namespace App\Models;
use DB;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class CategoryModel extends Model
{
    use HasFactory;
    protected $table = 'category_models';
    protected $appends = array('parent_name');

    function getParentNameAttribute(){
        // dd($this->parent_id);
        if($this->parent_id){
            $parent_cat_name = CategoryModel::where('id',$this->parent_id)->value('category_name');
            return  $parent_cat_name;
        }else{
            return 'none';
        }
    }
    // function parentCategory(){
    //     $this->belongsTo(CategoryModel::class,'admin_id');
    // }
}
