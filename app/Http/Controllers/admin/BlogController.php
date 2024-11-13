<?php


namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\BlogModel;
use App\Traits\Common_trait;

class BlogController extends Controller
{
    //
    use Common_trait;

    function all_blogs_list(){
        $all_blogs = BlogModel::all();      
        // dd($users_list); 
        return view('admin/blogs/index', compact('all_blogs'));
    }

    function insert_blog(Request $request){
        $formdata = $request->all(); 
        // dd($formdata);

        //Create slug
        $blog_slug = $this->create_unique_slug($formdata['title'], 'blog_models', 'slug');

        /////////Upload Image///////////
        if (!empty($request->blog_icon)) {

            $file =$request->file('blog_icon');
            $extension = $file->getClientOriginalExtension(); //dd($extension);
            $filename = $blog_slug.'.'.$extension;
            $file->move(public_path('admin-assets/img/blog_img/'), $filename);
            
        } 

        /////Insert into Database///////
        $blog = new BlogModel; 
        $blog->title = $request->title; 
        // $blog->content = $request->content; 
        $blog->slug = $blog_slug; 
        $blog->image = $filename; 
        $blog->status = $request->blog_status;
        $blog->save();
        //Last inserted ID
        if($blog->id > 0){
            return back()->with('flash-success', 'You Have Successfully Added New Blog.');
        } else{
            return back()->with('flash-error', 'something went wrong.');
        }    
       
    }

    function edit_blog(Request $request){
        $formdata = $request->all(); 
        // dd($formdata);

        $hidden_blog_id = $formdata['hidden_blog_id'];
        $get_blog = BlogModel::find($hidden_blog_id);

        ////////Check if title is changed then change the slug also///////////
        if($get_blog->title != $formdata['title']){
            $blog_slug = $this->create_unique_slug($formdata['title'], 'blog_models', 'slug');            
        } else {
            $blog_slug = $get_blog->slug;             
        } 

        if (!empty($request->blog_icon)) {

            $file =$request->file('blog_icon');
            $extension = $file->getClientOriginalExtension(); //dd($extension);
            $edited_filename = $blog_slug.'.'.$extension;           

            $path = public_path('admin-assets/img/blog_img');
            if(file_exists($path.'/'.$get_blog->image)){ 
                unlink($path.'/'.$get_blog->image);
            }
            $file->move(public_path('admin-assets/img/blog_img/'), $edited_filename);
            
            
        }  else {

            ////Rename Image Name according to New Title or Slug////
            $blog_icon = $get_blog->image;       
            $get_extension = explode(".", $blog_icon);  
            $dir = public_path('admin-assets/img/blog_img');
            //Rename image name in directory
            $oldfile_path = $dir.'/'.$get_blog->image;            
            $newfile_path = $dir.'/'.$blog_slug.'.'.$get_extension[1];
            rename($oldfile_path, $newfile_path);
            //Create Custom File Name
            $edited_filename = $blog_slug.'.'.$get_extension[1];

        }

        //////////////Update Data////////////////    
        $get_blog->title = $formdata['title'];        
        $get_blog->content = $formdata['content'];       
        $get_blog->slug = $blog_slug;
        $get_blog->image = $edited_filename;    
        $get_blog->status = $formdata['blog_status'];                  
        $get_blog->save();
        //Last inserted ID
        if($get_blog->id > 0){
            return back()->with('flash-success', 'You Have Successfully Edit Blog.');
        } else{
            return back()->with('flash-error', 'something went wrong.');
        }   


    }


    public function delete_blog($id){
       
        $data = BlogModel::find($id)->delete();         
        if($data){   
            return back()->with('flash-success', 'You Have Successfully Deleted Blog.');
        } else{
            return back()->with('flash-error', 'something went wrong.');
        }

    }


}
