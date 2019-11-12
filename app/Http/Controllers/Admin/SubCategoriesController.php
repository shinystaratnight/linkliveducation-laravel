<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\User;
use App\Categories;
use App\SubCategories;
use App\StudyMaterialCat;
use App\StudyMaterialSubcat;
use App\TestCat;
use App\TestSubcat;
use App\Http\Requests;
use Illuminate\Http\Request;
use Session;
use Intervention\Image\Facades\Image; 
use Illuminate\Support\Facades\DB;

class SubCategoriesController extends MainAdminController
{
	public function __construct()
    {
		 $this->middleware('auth');
		  
		parent::__construct(); 	
		  
    }
        public function subcate_featured_listing($listing_id,$status)
    {


        if(Auth::User()->usertype=="Admin")
        {
            
            $subcategories= SubCategories::findOrFail($listing_id);
 
            
            $subcategories->featured_listing = $status;
			$subcategories->save();
            \Session::flash('flash_message', 'Save changed');

            return redirect()->back();
        }
        else
        {
            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');
             
        }
    }
    public function subcategories()    { 
        
              
        $subcategories = SubCategories::orderBy('id')->get();

       
        
        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');
            
        }
         
        return view('admin.pages.subcategories',compact('subcategories'));
    }

    public function ajax_subcategories($cat_id)    { 
        
        $cat_id = \Input::get('cat_id');
              
        $subcategories = SubCategories::where('cat_id',$cat_id)->orderBy('sub_category_name')->get();

         
         
        return view('admin.pages.ajax_subcategories',compact('subcategories'));
    }
    
    public function addeditSubCategory()    { 
         
        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');
            
        }
        $categories = Categories::orderBy('category_name','ASC')->get();
        
        return view('admin.pages.addeditSubCategory',compact('categories'));
    }
    
    public function addnew(Request $request)
    { 
    	
    	$data =  \Input::except(array('_token')) ;
	    
	    $rule=array(
		        'category' => 'required',
                'category_name' => 'required'		         
		   		 );
	    
	   	 $validator = \Validator::make($data,$rule);
 
        if ($validator->fails())
        {
                return redirect()->back()->withErrors($validator->messages());
        } 
	    $inputs = $request->all();
		
		if(!empty($inputs['id'])){
           
            $subcat_obj = SubCategories::findOrFail($inputs['id']);

        }else{

            $subcat_obj = new SubCategories;
		
        }
		
		
		if($inputs['category_slug']=="")
		{
			$sub_category_slug = str_slug($inputs['category_name'], "-");
		}
		else
		{
			$sub_category_slug =str_slug($inputs['category_slug'], "-"); 
		}
		
		$subcat_obj->cat_id = $inputs['category']; 
		$subcat_obj->sub_category_name = $inputs['category_name']; 
		$subcat_obj->sub_category_slug = $sub_category_slug;
		
		$image = $request->file('image');
		if($image)
			{
		  \File::delete(public_path() .'/site_assets/images/'.$subcat_obj->image.'-b.jpg');
		  \File::delete(public_path() .'/site_assets/images/'.$subcat_obj->image.'-s.jpg');
		  $tmpFilePath = 'site_assets/images/';          
		  $hardPath = substr($sub_category_slug,0,100).'_'.time();
		  $img = Image::make($image);
		  $img->save($tmpFilePath.$hardPath.'-b.jpg');
		  $img->fit(283, 178)->save($tmpFilePath.$hardPath. '-s.jpg');
		  $subcat_obj->image = $hardPath. '-s.jpg';
		  }
		
		 
	    $subcat_obj->save();
		
		if(!empty($inputs['id'])){

            \Session::flash('flash_message', 'Changes Saved');

            return \Redirect::back();
        }else{

            \Session::flash('flash_message', 'Added');

            return \Redirect::back();

        }		     
        
         
    }     
    
    public function editSubCategory($id)    
    {     
    
    	  if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');
            
        }
          
		$categories = Categories::orderBy('category_name','ASC')->get();
		$subcat = SubCategories::where('id',$id)->get()[0]; 
   return view('admin.pages.addeditSubCategory',compact('categories','subcat'));
        
    }	 
    
    public function delete($id)
    {
    	if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');
            
        }
        	
        $sub_cat = SubCategories::findOrFail($id);
        $sub_cat->delete();

        \Session::flash('flash_message', 'Deleted');

        return redirect()->back();

    }
    
    public function subcategory()
    {
        
        $categories = StudyMaterialCat::all();

        return view('admin.pages.study_mat_subcategory', compact('categories'));
    }
    public function testsubcategory()
    {
        
        $categories = TestCat::all();

        return view('admin.pages.testsubcategory', compact('categories'));
    }
    
    
    public function add_study_mat_subcategory(Request $request)
    {
        if($request->sub_category_id)
        {
            $categories = StudyMaterialSubcat::where('id', $request->sub_category_id)->firstOrFail();
        }
        else
        {
            $categories = new StudyMaterialSubcat;
        }
        
        
        $categories->name = $request->subcategory_name;
        if($request->cat_id)
        {
            $categories->cat_id = $request->cat_id;
        }
        
        $categories->save();
        
        \Session::flash('message', 'Sub Category Saved');
        return redirect()->back();
    }
    public function add_test_subcategory(Request $request)
    {
        if($request->sub_category_id)
        {
            $categories = TestSubcat::where('id', $request->sub_category_id)->firstOrFail();
        }
        else
        {
            $categories = new TestSubcat;
        }
        
        
        $categories->name = $request->subcategory_name;
        if($request->cat_id)
        {
            $categories->cat_id = $request->cat_id;
        }
        
        $categories->save();
        
        \Session::flash('message', 'Sub Category Saved');
        return redirect()->back();
    }
    
    
    public function show_study_mat_subcategory(Request $request)
    {
        $categories = StudyMaterialCat::all();
        $value = StudyMaterialSubcat::all();
        
        return view('admin.pages.show_study_mat_subcategory', compact('value','categories'));
    }
    public function show_test_subcategory(Request $request)
    {
        $categories = TestCat::all();
        $value = TestSubcat::all();
        
        return view('admin.pages.show_test_subcategory', compact('value','categories'));
    }
    
    
    public function study_mat_subcategory_delete(Request $request)
    {
        StudyMaterialSubcat::where('id', $request->study_subcategory)->delete();
        
        \Session::flash('message', 'Sub Category Deleted');
        return redirect()->back();
    }
    
    
    public function studymatCategory(Request $request)
    {
        $data = StudyMaterialSubcat::where('cat_id', $request->cat_id)->get();
        
        echo '<option value="0" >select subcategory</option>';
            foreach($data as $value){
                echo '<option value="'.$value->id.'" >'.$value->name.'</option>';
            }
    }
    
    public function testCategory(Request $request)
    {
        $data = TestSubcat::where('cat_id', $request->cat_id)->get();
        
        echo '<option value="0" >select subcategory</option>';
            foreach($data as $value){
                echo '<option value="'.$value->id.'" >'.$value->name.'</option>';
            }
    }
}