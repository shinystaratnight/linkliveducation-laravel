<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\User;
use App\Designations;
use App\Http\Requests;
use Illuminate\Http\Request;
use Session;
use Intervention\Image\Facades\Image; 


class DesignationsController extends MainAdminController
{
	public function __construct()
    {
		 $this->middleware('auth');
		  
		parent::__construct(); 	
		  
    }
    public function designations()    { 
        
              
        $designation = Designations::orderBy('id')->get();
        
        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');
            
        }
 
         
        return view('admin.pages.designations',compact('designation'));
    }
    
    public function addeditdesignation()    { 
         
        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');
            
        }

        

        return view('admin.pages.addeditdesignation');
    }
    
    public function addnew(Request $request)
    { 
        
        $data =  \Input::except(array('_token')) ;
        
        $rule=array(
                'designation' => 'required'
                 );
        
         $validator = \Validator::make($data,$rule);
 
        if ($validator->fails())
        {
                return redirect()->back()->withErrors($validator->messages());
        } 
        $inputs = $request->all();
        
        if(!empty($inputs['id'])){
           
            $designations = Designations::findOrFail($inputs['id']);

        }else{

            $designations = new Designations;

        }
       
        $designations->designation = $inputs['designation']; 
        $designations->bv= $inputs['bv']; 
        $designations->bonuses= $inputs['bonuses']; 
        $designations->qualifying_terms= $inputs['qualifying_terms']; 
        $designations->save();
        
        if(!empty($inputs['id'])){

            \Session::flash('flash_message', 'Changes Saved');

            return \Redirect::back();
        }else{

            \Session::flash('flash_message', 'Added');

            return \Redirect::back();

        }            
        
         
    }     
   
    
    public function editdesignation($plan_id)    
    {     
    
    	  if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');
            
        }
        	     
          $desg = Designations::findOrFail($plan_id);
          
           

          return view('admin.pages.addeditdesignation',compact('desg'));
        
    }	 
    
    public function delete($plan_id)
    {
    	if(Auth::User()->usertype=="Admin")
        {
        	
        $designations = Designations::findOrFail($plan_id);
       
        $designations->delete();

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
