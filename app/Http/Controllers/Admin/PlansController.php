<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\User;
use App\Plans;
use App\Http\Requests;
use Illuminate\Http\Request;
use Session;
use Intervention\Image\Facades\Image; 


class PlansController extends MainAdminController
{
	public function __construct()
    {
		 $this->middleware('auth');
		  
		parent::__construct(); 	
		  
    }
    public function plans()    { 
        
              
        $plans = Plans::orderBy('plan_name')->get();
        
        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');
            
        }
 
         
        return view('admin.pages.plans',compact('plans'));
    }
    
    public function addeditplan()    { 
         
        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');
            
        }

        

        return view('admin.pages.addeditplan');
    }
    
    public function addnew(Request $request)
    { 
        
        $data =  \Input::except(array('_token')) ;
        
        $rule=array(
                'plan_name' => 'required',
                 'tds' => 'required'
                 );
        
         $validator = \Validator::make($data,$rule);
 
        if ($validator->fails())
        {
                return redirect()->back()->withErrors($validator->messages());
        } 
        $inputs = $request->all();
        
        if(!empty($inputs['id'])){
           
            $plans = Plans::findOrFail($inputs['id']);

        }else{

            $plans = new Plans;

        }
          $image = $request->file('image');
         
        if($image){
            
            \File::delete(public_path() .'/site_assets/slider/'.$plans->image.'-b.jpg');
            
            
            $tmpFilePath = 'site_assets/slider/';

            $hardPath =  str_slug($inputs['plan_name'], '-').'-'.md5(time());
            
            $img = Image::make($image);

            $img->fit(250, 250)->save($tmpFilePath.$hardPath.'-b.jpg');
     

            $plans->image = $tmpFilePath.$hardPath.'-b.jpg';
             
        } 
        $plans->plan_name = $inputs['plan_name']; 
        $plans->description=$inputs['description'];
        $plans->category=$inputs['category'];
        $plans->days_of_membership =$inputs['days_of_membership'];
        $plans->membership_cost = $inputs['membership_cost']; 
        $plans->level_profit= $inputs['level_profit'];
        $plans->capping_amount = $inputs['capping_amount']; 
        $plans->hashpower =$inputs['hashpower'];
        $plans->tds =$inputs['tds'];
        $plans->bv =$inputs['bv'];
        $plans->Algorithm=$inputs['Algorithm'];
        $plans->estimated_roi =$inputs['estimated_roi'];
        $plans->save();
        
        if(!empty($inputs['id'])){

            \Session::flash('flash_message', 'Changes Saved');

            return \Redirect::back();
        }else{

            \Session::flash('flash_message', 'Added');

            return \Redirect::back();

        }            
        
         
    }     
   
    
    public function editplan($plan_id)    
    {     
    
    	  if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');
            
        }
        	     
          $plan = Plans::findOrFail($plan_id);
          
           

          return view('admin.pages.addeditplan',compact('plan'));
        
    }	 
    
    public function delete($plan_id)
    {
    	if(Auth::User()->usertype=="Admin" or Auth::User()->usertype=="Owner")
        {
        	
        $plans = Plans::findOrFail($plan_id);
         \File::delete('site_assets/slider/'.$plans->image);
        $plans->delete();

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
