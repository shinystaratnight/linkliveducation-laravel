<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\User;
use App\Pincode;

use App\Http\Requests;
use Illuminate\Http\Request;
use Session;
use DB;
use Intervention\Image\Facades\Image; 


class PincodeController extends MainAdminController
{
	public function __construct()
    {
		 $this->middleware('auth');
		  
		parent::__construct(); 	
		  
    }
    public function pincode()    { 
        
              
        $locations = DB::table('pin')->get();
        
        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');
            
        }
 
         
        return view('admin.pages.pincode',compact('locations'));
    }
    
    public function addeditpincode()    { 
         
        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');
            
        }

        

        return view('admin.pages.addeditpincode');
    }
    
    public function addnew(Request $request)
    { 
        
        $data =  \Input::except(array('_token')) ;
        
        $rule=array(
                'name' => 'required'                
                 );
        
         $validator = \Validator::make($data,$rule);
 
        if ($validator->fails())
        {
                return redirect()->back()->withErrors($validator->messages());
        } 
        $inputs = $request->all();
        
        if(!empty($inputs['id'])){
           
            $pincode = Pincode::findOrFail($inputs['id']);

        }else{

            $pincode = new Pincode;

        }
        
      
        $pincode->place_name = $inputs['name']; 
        $pincode->pincode = $inputs['pincode']; 
         
        
         
        $pincode->save();
        
        if(!empty($inputs['id'])){

            \Session::flash('flash_message', 'Changes Saved');

            return \Redirect::back();
        }else{

            \Session::flash('flash_message', 'Added');

            return \Redirect::back();

        }            
        
         
    }     
   
    
    public function editpincode($id)    
    {     
    
    	  if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');
            
        }
        	     
      $locations =   DB::table('pin')->where('id',$id)->get();
          
           

          return view('admin.pages.addeditpincode',compact('locations'));
        
    }	 
    
    public function delete($id)
    {
    	if(Auth::User()->usertype=="Admin" or Auth::User()->usertype=="Owner")
        {
        	
       DB::table('pin')->where('id',$id)->delete();

        \Session::flash('flash_message', 'Deleted');

        return redirect()->back();
        }
        else
        {
            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');
            
        
        }
    }

     
     
    	
}
