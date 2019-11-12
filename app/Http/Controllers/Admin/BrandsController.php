<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Brands;
use App\Categories;

use App\Http\Requests;
use Illuminate\Http\Request;
use Session;
use Intervention\Image\Facades\Image; 
use Illuminate\Support\Facades\DB;

class BrandsController extends MainAdminController
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
    public function brands()    { 
        
              
        $subcategories = Brands::orderBy('id')->get();

       
        
        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');
            
        }
         
        return view('admin.pages.brands',compact('subcategories'));
    }

    public function addeditbrands()    { 
         
        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');
            
        }
        $categories = Categories::orderBy('category_name','ASC')->get();
        
        return view('admin.pages.addeditbrands',compact('categories'));
    }
    
    public function addnew(Request $request)
    {  
    	
    	$data =  \Input::except(array('_token')) ;
	    
	    $rule=array(
		        'brands_name' => 'required',
                'brands_slug' => 'required'		         
		   		 );
	    
	   	 $validator = \Validator::make($data,$rule);
 
        if ($validator->fails())
        {
                return redirect()->back()->withErrors($validator->messages());
        } 
	    $inputs = $request->all();
		//echo "<pre>" ;
		//print_r($inputs); die;
		if(!empty($inputs['id'])){
           
            $subcat_obj = Brands::findOrFail($inputs['id']);

        }else{

            $subcat_obj = new Brands;
		
        }
		
		
		
		
		//$subcat_obj->cat_id = $inputs['category']; 
		$subcat_obj->name = $inputs['brands_name']; 
		$subcat_obj->brand_slug = $inputs['brands_slug'];
		$sub_category_slug = $inputs['brands_slug'];
		$image = $request->file('image');
		if($image)
			{
		  \File::delete(public_path() .'/site_assets/brands/'.$subcat_obj->image.'-b.jpg');
		  \File::delete(public_path() .'/site_assets/brands/'.$subcat_obj->image.'-s.jpg');
		  $tmpFilePath = 'site_assets/brands/';          
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
    
    public function editbrands($id)    
    {     
    
    	  if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');
            
        }
        $data =  DB::table('brands')->where('id',$id)->get();
		
           
          return view('admin.pages.addeditbrands',compact('data'));
        
    }	 
    
    public function delete($id)
    {
    	if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');
            
        }
        	
       DB::table('brands')->where('id',$id)->delete();

        \Session::flash('flash_message', 'Deleted');

        return redirect()->back();

    }
     
    	
}
