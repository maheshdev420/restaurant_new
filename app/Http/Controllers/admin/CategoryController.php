<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoryModel;
use App\Traits\Common_trait;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    //
    use common_trait;
    public function get_all_categories_list()
    {
        $all_cat_list = CategoryModel::get();
        return view('admin/category/all-category-list', compact('all_cat_list'));

    }

    public function insert_cat(Request $request)
    {
        $formdata = $request->all();
        $cat_slug = $this->create_unique_slug($formdata['cat_name'], 'category_models', 'category_slug');

        $filename = null;
        if ($request->file('cat_icon')) {

            $file = $request->file('cat_icon');
            $extension = $file->getClientOriginalExtension();
            $filename = $cat_slug . '.' . $extension;
            $file->move(public_path('admin-assets/img/category_img/all-category/'), $filename);

        }

        $category = new CategoryModel;
        $category->category_name = $formdata['cat_name'];
        $category->category_slug = $cat_slug;
        $category->category_icon = $filename;
        $category->category_status = $formdata['cat_status'];
        $category->parent_id = $formdata['parent_category'] == 'null' ? 'none' : $formdata['parent_category'];
        $category->admin_id = Auth::guard('web')->user()->id;
        $category->save();
        if ($category->id > 0) {
            return back()->with('flash-success', 'You Have Successfully Added New Category.');
        } else {
            return back()->with('flash-error', 'something went wrong.');
        }

    }


    public function edit_cat(Request $request)
    {
        $hidden_cat_id = $request['hidden_cat_id'];
        $edit_category = CategoryModel::find($hidden_cat_id);
        if ($edit_category->category_name != $request['cat_name']) {
            $cat_slug = $this->create_unique_slug($request['cat_name'], 'category_models', 'category_slug');
        } else {
            $cat_slug = $edit_category->category_slug;
        }

        //Get uploaded file information
        if ($request->file('cat_icon')) {

            $file = $request->file('cat_icon');
            $extension = $file->getClientOriginalExtension(); //dd($extension);
            $filename = $cat_slug . '.' . $extension;

            //Create directory if not exist           
            $dirPath = public_path('admin-assets/img/category_img/all-category');
            if (File::exists($dirPath . '/' . $edit_category->category_icon)) {
                File::delete($dirPath . '/' . $edit_category->category_icon);
            }

            $file->move(public_path('admin-assets/img/category_img/all-category/'), $filename);

        } else {
            ////Rename Image Name according to New Title or Slug
            $img = $edit_category->category_icon;
            if ($img) {
                $get_extension = explode(".", $img);

                $dir = public_path('admin-assets/img/category_img/all-category');
                $oldfile_name = $dir . '/' . $edit_category->category_icon;
                $newfile_name = $dir . '/' . $cat_slug . '.' . $get_extension[1];
                rename($oldfile_name, $newfile_name);

                //Create Custom File Name
                $filename = $cat_slug . '.' . $get_extension[1];
            } else {
                $filename = null;
            }
        }



        $edit_category->category_name = $request['cat_name'];
        $edit_category->category_slug = $cat_slug;
        $edit_category->category_icon = $filename;
        $edit_category->parent_id = $request['parent_category'];
        $edit_category->category_status = $request['cat_status'];
        $edit_category->save();
        //Last inserted ID
        if ($edit_category->id > 0) {
            return back()->with('flash-success', 'You Have Successfully Edited Category.');
        } else {
            return back()->with('flash-error', 'something went wrong.');
        }
    }


    function categoryDelete($id)
    {
        $cat = CategoryModel::where('id',$id)->first();
        if ($cat) {
            $cat->delete();
            return redirect()->route('allcategorieslist')->with('flash-success', 'You Have Successfully Delete Category.');
        } else {
            return redirect()->route('allcategorieslist')->with('flash-error', 'something went wrong.');

        }
    }
    public function check_unique_category(Request $request)
    {
        dd($request->all());
    }


}
