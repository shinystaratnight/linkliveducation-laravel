<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\User;
use App\Categories;
use App\StudyMaterialCat;
use App\TestCat;
use App\Http\Requests;
use Illuminate\Http\Request;
use Session; 
use Intervention\Image\Facades\Image; 
use Illuminate\Support\Facades\DB;

class CategoriesController extends MainAdminController
{
	public function __construct()
    {
		 $this->middleware('auth');
		  
		parent::__construct(); 	
		  
    }
    public function categories()    { 
        
              
        $categories = Categories::orderBy('id')->get();
        
        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');
            
        }
 
         
        return view('admin.pages.categories',compact('categories'));
    }
    
    public function addeditCategory()    { 
         
        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');
            
        }

        

        return view('admin.pages.addeditCategory');
    }
    
    public function addnew(Request $request)
    { 
       
        $data =  \Input::except(array('_token')) ;
        
        $rule=array(
                'category_name' => 'required'                
                 );
        
         $validator = \Validator::make($data,$rule);
 
        if ($validator->fails())
        {
                return redirect()->back()->withErrors($validator->messages());
        } 
        $inputs = $request->all();
      // echo "<pre>"; print_r($inputs); die; 
        if(!empty($inputs['id'])){
           
            $cat = Categories::findOrFail($inputs['id']);

        }else{

            $cat = new Categories;
        }
        
        
        if($inputs['category_slug']=="")
        {
            $category_slug = str_slug($inputs['category_name'], "-");
        }
        else
        {
            $category_slug =str_slug($inputs['category_slug'], "-"); 
        }
        
        
        $cat->category_name = $inputs['category_name']; 
        $cat->category_slug = $category_slug;
        $cat->image_name = $inputs['image_name']; 
		$cat->image_name2 = $inputs['image_name2']; 
		$cat->image_name3 = $inputs['image_name3']; 
		$cat->image_name4 = $inputs['image_name4']; 
		$cat->image_name5 = $inputs['image_name5']; 
		$icon = $request->file('icon');
		if($icon){
		  \File::delete(public_path() .'/site_assets/icons/'.$cat->icon.'-b.png');
		  \File::delete(public_path() .'/site_assets/icons/'.$cat->icon.'-s.png');
		  $tmpFilePath = 'site_assets/icons/';          
		  $hardPath = substr($category_slug,0,100).'_'.time();
		  $img = Image::make($icon);
		  $img->save($tmpFilePath.$hardPath.'-b.png');
		  $img->save($tmpFilePath.$hardPath. '-s.png');
		  $cat->icon = $hardPath. '-s.png';
		  }
		  $image = $request->file('image');
		if($image){
		  \File::delete(public_path() .'/site_assets/images/'.$cat->image.'-b.png');
		  \File::delete(public_path() .'/site_assets/images/'.$cat->image.'-s.png');
		  $tmpFilePath = 'site_assets/images/';          
		  $hardPath = substr($category_slug,0,100).'_'.time();
		  $img = Image::make($image);
		  $img->save($tmpFilePath.$hardPath.'-b.png');
		  $img->save($tmpFilePath.$hardPath. '-s.png');
		  $cat->image = $hardPath. '-s.png';
		  }
		  $image2 = $request->file('image2');
		if($image2){
		  \File::delete(public_path() .'/site_assets/images/'.$cat->image2.'-b.png');
		  \File::delete(public_path() .'/site_assets/images/'.$cat->image2.'-s.png');
		  $tmpFilePath = 'site_assets/images/';          
		  $hardPath = substr('image2',0,100).'_'.time();
		  $img = Image::make($image2);
		  $img->save($tmpFilePath.$hardPath.'-b.png');
		  $img->save($tmpFilePath.$hardPath. '-s.png');
		  $cat->image2 = $hardPath. '-s.png';
		  }
		  $image3 = $request->file('image3');
		if($image3){
		  \File::delete(public_path() .'/site_assets/images/'.$cat->image3.'-b.png');
		  \File::delete(public_path() .'/site_assets/icons/'.$cat->image3.'-s.png');
		  $tmpFilePath = 'site_assets/images/';          
		  $hardPath = substr('image3',0,100).'_'.time();
		  $img = Image::make($image3);
		  $img->save($tmpFilePath.$hardPath.'-b.png');
		  $img->save($tmpFilePath.$hardPath. '-s.png');
		  $cat->image3 = $hardPath. '-s.png';
		  }
		  $image4 = $request->file('image4');
		if($image4){
		  \File::delete(public_path() .'/site_assets/images/'.$cat->image4.'-b.png');
		  \File::delete(public_path() .'/site_assets/images/'.$cat->image4.'-s.png');
		  $tmpFilePath = 'site_assets/images/';          
		  $hardPath = substr('image4',0,100).'_'.time();
		  $img = Image::make($image4);
		  $img->save($tmpFilePath.$hardPath.'-b.png');
		  $img->save($tmpFilePath.$hardPath. '-s.png');
		  $cat->image4 = $hardPath. '-s.png';
		  }
		  $image5 = $request->file('image5');
		if($image5){
		  \File::delete(public_path() .'/site_assets/images/'.$cat->image5.'-b.png');
		  \File::delete(public_path() .'/site_assets/images/'.$cat->image5.'-s.png');
		  $tmpFilePath = 'site_assets/images/';          
		  $hardPath = substr('image5',0,100).'_'.time();
		  $img = Image::make($image5);
		  $img->save($tmpFilePath.$hardPath.'-b.png');
		  $img->save($tmpFilePath.$hardPath. '-s.png');
		  $cat->image5 = $hardPath. '-s.png';
		  }

        $cat->save();
        
        if(!empty($inputs['id'])){

            \Session::flash('flash_message', 'Changes Saved');

            return \Redirect::back();
        }else{

            \Session::flash('flash_message', 'Added');

            return \Redirect::back();

        }            
        
         
    }     
   
    
    public function editCategory($cat_id)    
    {     
    
    	  if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');
            
        }
        	     
          $cat = Categories::findOrFail($cat_id);
          
           

          return view('admin.pages.addeditCategory',compact('cat'));
        
    }	 
    
    public function delete($cat_id)
    {
    	if(Auth::User()->usertype=="Admin" or Auth::User()->usertype=="Owner")
        {
        	
        $cat = Categories::findOrFail($cat_id);
        $cat->delete();

        \Session::flash('flash_message', 'Deleted');

        return redirect()->back();
        }
        else
        {
            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');
            
        
        }
    }
    
    
    public function category()
    {

        return view('admin.pages.study_material_category');
    }
    public function testcategory()
    {

        return view('admin.pages.testcategory');
    }
    
    
    public function add_study_mat_category(Request $request)
    {
        if($request->cat_id)
        {
            $categories = StudyMaterialCat::where('id', $request->cat_id)->firstOrFail();
        }
        else
        {
            $categories = new StudyMaterialCat;
        }
        
        
        $categories->name = $request->category_name;
        $categories->save();
        
        \Session::flash('message', 'Category Saved');
        return redirect()->back();
    }
    public function add_test_category(Request $request)
    {
        if($request->cat_id)
        {
            $categories = TestCat::where('id', $request->cat_id)->firstOrFail();
        }
        else
        {
            $categories = new TestCat;
        }
        $categories->name = $request->category_name;
        $categories->save();
        \Session::flash('message', 'Category Saved');
        return redirect()->back();
    }

    public function show_study_mat_category(Request $request)
    {
        $value = StudyMaterialCat::all();
        
        return view('admin.pages.show_study_mat_category', compact('value'));
    }
    
    public function show_test_category(Request $request)
    {
        $value = TestCat::all();
        
        return view('admin.pages.show_test_category', compact('value'));
    }
    
    public function study_mat_category_delete(Request $request)
    {
        StudyMaterialCat::where('id', $request->id)->delete();
        \Session::flash('message', 'Category Deleted');
        return redirect()->back();
    }
    
    public function test_category_delete(Request $request)
    {
        TestCat::where('id', $request->id)->delete();
        \Session::flash('message', 'Category Deleted');
        return redirect()->back();
    }
}