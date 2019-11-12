<?php namespace App\Http\Controllers\Admin;
use Auth;
use App\Checkoutdata;
use App\Bookingdetails;
use Redirect;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;

// note: use true and false for active Pages in postgresql database
// here '0' and '1' are used for active Pages because of mysql database

class OrderController extends MainAdminController {
public function __construct()
    {
		 $this->middleware('auth');	
         parent::__construct();
    }
public function order()
		{

		return view('admin.pages.orderlist');
		}

public function cash_account()
		{

		return view('admin.pages.order_cash_account');
		}

	public function cash_mining()
		{

		return view('admin.pages.order_cash_mining');
		}

	public function swisscoin()
		{

		return view('admin.pages.order_swisscoin');
		}

	public function alt_coin()
		{

		return view('admin.pages.order_altcoin');
		}

	public function order_bitcoin()
		{

		return view('admin.pages.order_bitcoin');
		}

		
		
 public function order_delete($order_id)
    { 
        
        DB::table('order')->where('order_id',$order_id)->delete();
        DB::table('booking_details')->where('order_id', $order_id)->delete();
        \Session::flash('flash_message', 'Deleted');

        return redirect()->back();
        }
        
  public function order_update($order_id,$id){
 return view('admin.pages.order_update',compact('order_id','id'));
 }
  
  public function post_order_update(request $request){
            $Bookingdetails = new Bookingdetails;
            $inputs = $request->all();
    DB::table('order')->where('order_id',$request->id)->update(array('product_name'=>$inputs['product_name'],'product_price'=>$inputs['product_price']));
    Bookingdetails::where('order_id',$request->id)->update(array('billing_name'=>$inputs['billing_name'],'address'=>$inputs['address'],'billing_city'=>$inputs['billing_city'],'billing_zip'=>$inputs['billing_zip'],'billing_tel'=>$inputs['billing_tel'],'billing_email'=>$inputs['billing_email']));
	 \Session::flash('flash_message', 'Updated');	 
	return redirect()->back();	
		 }
       
   public function order_cancel($order_id)
   {
 
  $update = DB::table('order')
            ->where('order_id', $order_id)
            ->update(array('status' => 'Cancelled'));
       
            
    \Session::flash('flash_message', 'Cancelled');	 
	return redirect()->back();	
   } 
   public function order_delivered($order_id)
   {
 
  $update = DB::table('order')
            ->where('id', $order_id)
            ->update(array('status' => 'Delivered'));
       
            
    \Session::flash('flash_message', 'Delivered');	 
	return redirect()->back();	
   }
   public function order_processing($order_id)
   {
 
  $update = DB::table('order')
            ->where('id', $order_id)
            ->update(array('status' => 'Processing'));
       
            
    \Session::flash('flash_message', 'Processing');	 
	return redirect()->back();	
   }
   
     public function oldorder()
   {
     return view('admin.pages.oldorder');
    }
  
  }
	

