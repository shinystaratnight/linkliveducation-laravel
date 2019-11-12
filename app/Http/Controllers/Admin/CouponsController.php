<?php

namespace App\Http\Controllers\Admin;
use Auth;
use App\User;
use App\UserShortlists;
use App\UserTeam;
use App\UserOffers;
use App\UserSearch;
use App\UserConversations;
use App\UserInvites;
use App\Coupons;
use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;
use Session;
use Intervention\Image\Facades\Image; 
use Illuminate\Support\Facades\DB;

class CouponsController extends MainAdminController
{
    
      public function coupons(Request $request)
        { 
            if(!Auth::check())
           {
                \Session::flash('flash_message', 'Access denied!');
                return redirect('login');
            }
           $coupons=Coupons::orderBy('id')->paginate('10');
           return view('admin.pages.coupons',  compact('coupons'));
        } 
        public function coupons_status($id,$status)
        { 
           if(Auth::User()->usertype=="Admin")
        {
            
            $coupons=Coupons::findOrFail($id);
 
            
            $coupons->status = $status;
 
            $coupons->save();
         
            \Session::flash('flash_message', 'Status changed');

           return redirect('admin/coupons');
        }
        else
        {
            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');
             
        }
           
        }
        public function coupon_delete($id)
    {
        if(Auth::User()->usertype=="Admin" )
        {
            
         $coupons=Coupons::findOrFail($id);
 
         $coupons->delete();

        \Session::flash('flash_message', 'Deleted');

          return redirect('admin/coupons');
        }
        else
        {
            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');
            
        
        }
    }
    public function add_coupon(Request $request)
    { 
         if(Auth::User()->usertype=="Admin" )
        {
        $data =  \Input::except(array('_token')) ;
        
        $rule=array(
                'product_id' => 'required' ,
                'coupon_code' => 'required' ,
                'percentage_off' => 'required',
                'expired_date'=> 'required',
                 );
        
         $validator = \Validator::make($data,$rule);
 
        if ($validator->fails())
        {
                return redirect()->back()->withErrors($validator->messages());
        } 
        $inputs = $request->all();
        
        if(!empty($inputs['id'])){
           
            $coupon = Coupons::findOrFail($inputs['id']);

        }else{
            $coupon = new Coupons;
        }
        $coupon->coupon_code= $inputs['coupon_code']; 
        $coupon->product_id= $inputs['product_id']; 
        $coupon->cate_id= $inputs['cate_id']; 
        $coupon->percentage_off= $inputs['percentage_off']; 
        $coupon->expired_date= $inputs['expired_date'];
        $coupon->status= 'Active'; 
        $coupon->save();
        if(!empty($inputs['id'])){

            \Session::flash('flash_message', 'Changes Saved');

          return redirect('admin/coupons');
        }else{

            \Session::flash('flash_message', 'Added');

       return redirect('admin/coupons');

        }            
          }
        else
        {
            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');
            
        
        }
         
    }   
        
}
 