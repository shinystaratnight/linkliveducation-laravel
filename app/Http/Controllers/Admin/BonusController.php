<?php

namespace App\Http\Controllers\Admin;
use Auth;
use App\User;
use App\Plans;
use App\Bonus;
use App\Http\Requests;
use Illuminate\Http\Request;
use Session;
use Intervention\Image\Facades\Image; 


class BonusController extends MainAdminController
{
	public function __construct()
    {
		 $this->middleware('auth');
		  
		parent::__construct(); 	
		  
    }
    public function bonus()    { 
        
        $bonus = Bonus::orderBy('id')->get();
        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');
            
        }
 
        return view('admin.pages.bonus',compact('bonus'));
    }
    
    public function addeditbonus()    { 
         
        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');
            
        }

        return view('admin.pages.addeditbonus');
    }
    
    public function addnew(Request $request)
    { 
        $data =  \Input::except(array('_token')) ;
        $rule=array(
                'plan_name' => 'required'               
                 );
        $validator = \Validator::make($data,$rule);
        if ($validator->fails())
        {
                return redirect()->back()->withErrors($validator->messages());
        } 
        $inputs = $request->all();
        
        if(!empty($inputs['id'])){
           
            $bonus = Bonus::findOrFail($inputs['id']);

        }else{
            $bonus = new Bonus;
        }
        $bonus->plan_name = $inputs['plan_name']; 
         $bonus->type = $inputs['type']; 
        $bonus->level1 =$inputs['level1'];
        $bonus->level2 = $inputs['level2']; 
        $bonus->level3 =$inputs['level3'];
        $bonus->level4 = $inputs['level4']; 
        $bonus->level5 =$inputs['level5'];
        $bonus->level6 =$inputs['level6'];
        $bonus->level7 = $inputs['level7']; 
        $bonus->level8 =$inputs['level8'];
        $bonus->level9 = $inputs['level9']; 
        $bonus->level10 =$inputs['level10'];
         $bonus->level11 =$inputs['level11'];
        $bonus->save();
        
        if(!empty($inputs['id'])){

            \Session::flash('flash_message', 'Changes Saved');

            return \Redirect::back();
        }else{

            \Session::flash('flash_message', 'Added');

            return \Redirect::back();
        }            
    }     
   
    public function editbonus($plan_id)    
    {     
    
    	  if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');
            
        }
        	     
          $bonus = Bonus::findOrFail($plan_id);
          
           

          return view('admin.pages.addeditbonus',compact('bonus'));
        
    }	 
    
    public function delete($plan_id)
    {
    	if(Auth::User()->usertype=="Admin" or Auth::User()->usertype=="Owner")
        {
        	
        $bonus = Bonus::findOrFail($plan_id);
         \File::delete('site_assets/slider/'.$bonus->image);
        $bonus->delete();

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
