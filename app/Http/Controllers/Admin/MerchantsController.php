<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Brands;
use App\Merchants;
use App\Categories;

use App\Http\Requests;
use Illuminate\Http\Request;
use Session;
use Intervention\Image\Facades\Image; 
use Illuminate\Support\Facades\DB;

class MerchantsController extends MainAdminController
{
	public function __construct()
    {
		 $this->middleware('auth');
		  
		parent::__construct(); 	
		  
    }
       
    public function merchants()    { 
        
              
        $subcategories = Merchants::orderBy('id')->get();

       
        
        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');
            
        }
         
        return view('admin.pages.merchants',compact('subcategories'));
    }

    public function addeditmerchants()    { 
         
        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');
            
        }
        $categories = Categories::orderBy('category_name','ASC')->get();
        
        return view('admin.pages.addeditmerchants',compact('categories'));
    }
    
    public function addnew(Request $request)
    {  
    	
    	$data =  \Input::except(array('_token')) ;
	    
	    $rule=array(
		        'name' => 'required',
                	         
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
           
            $subcat_obj = Merchants::findOrFail($inputs['id']);

        }else{

            $subcat_obj = new Merchants;
		
        }
		
		
		
		
		$subcat_obj->slug = $inputs['slug']; 
		$subcat_obj->name = $inputs['name']; 
		
		$image = $request->file('image');
		if($image)
			{
		  \File::delete(public_path() .'/site_assets/brands/'.$subcat_obj->image.'-b.jpg');
		  \File::delete(public_path() .'/site_assets/brands/'.$subcat_obj->image.'-s.jpg');
		  $tmpFilePath = 'site_assets/brands/';          
		  $hardPath = substr('merchants',0,100).'_'.time();
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
    
    public function editmerchants($id)    
    {     
    
    	  if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');
            
        }
        $data =  DB::table('merchants')->where('id',$id)->get();
		
           
          return view('admin.pages.addeditmerchants',compact('data'));
        
    }	 
    
    public function delete($id)
    {
    	if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');
            
        }
        	
       DB::table('merchants')->where('id',$id)->delete();

        \Session::flash('flash_message', 'Deleted');

        return redirect()->back();

    }
  	
}
