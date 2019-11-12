<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\User;
use App\Plans;
use App\Bonus;
use App\Invoices;
use App\Withdrawals;
use App\Tickets;
use Mail;
use App\Product;
use App\Earnings;
use App\UserPermissions;
use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;
use Session;
use Intervention\Image\Facades\Image; 
use Illuminate\Support\Facades\DB;
 
class UsersController extends MainAdminController
{
	public function __construct()
    {
		 $this->middleware('auth');	
		
		 parent::__construct();
         
    }
    	public function crypto_currency_ticker($currency,$orderamount)
            {
                 $url = 'https://api.coinmarketcap.com/v1/ticker/?convert=USD&limit=10000';
                 $json = file_get_contents($url);
                 $object = json_decode($json);
                 $objectcount = count($object);
                // echo "<pre>";print_r($object);
                 if($currency=='Dash'){
                 $currency='DASH';
                 }else{
                    $currency=$currency; 
                 }
                 $orderamount=$orderamount;
                 for($i=0;$i<$objectcount;$i++):
                     if($object[$i]->symbol==$currency):
                       return $t=round(1/$object[$i]->price_usd*$orderamount,9);
                     endif;
                 endfor;
            }
    public function email_template($array){
		return view('emails.common',compact('array'));
	}
    public function userslist()    { 
         
       
        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');
            
        } 
          
        $allusers = User::where('usertype', '!=', 'Admin')->orderBy('id')->get();
       
         
        return view('admin.pages.users',compact('allusers'));
    } 
       public function assign_users_designation()    { 
         
       
        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');
            
        } 
          
        $allusers = User::where('usertype', '!=', 'Admin')->orderBy('id')->get();
       
         
        return view('admin.pages.assign_user_designation',compact('allusers'));
    }
     public function approved_userslist()    { 
         
       
        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');
            
        } 
          
        $allusers = User::where('usertype', '!=', 'Admin')->where('status','approved')->orderBy('id')->get();
       
         
        return view('admin.pages.users_approved',compact('allusers'));
    }
       public function pending_userslist()    { 
         
       
        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');
            
        } 
          
        $allusers = User::where('usertype', '!=', 'Admin')->where('status','pending')->orderBy('id')->get();
       
         
        return view('admin.pages.users_pending_approval',compact('allusers'));
    }
    public function addeditUser()    { 
        
        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');
            
        }
          
        return view('admin.pages.addeditUser');
    }
  function display_children($parent, $level,$rank) {
            $count = 0;
            $result = DB::table('users')->where('pcode',$parent)->get();
            foreach($result as $rt)
            {
                if($rt->rank==$rank){
                 $count += 1 +$this->display_children($rt->ucode, $level+1,$rt->rank);
                }else{
                    $this->display_children($rt->ucode, $level+1,$rt->rank);
                }
            }
            return $count; // it will return all user_id count under parent_id
        }
       function display_bv($parent, $level) {
            $count = 0;
            $bv=0;
            $result = DB::table('users')->where('pcode',$parent)->get();
            foreach($result as $rt)
            {
              $bv +=DB::table('order')->where('user_id',$rt->id)->sum('product_price');  
            $count += 1 +$this->display_bv($rt->ucode, $level+1);
          
            }
            return $bv; // it will return all user_id count under parent_id
        } 
    public function addnew(Request $request)
    { 
    	
    	$data =  \Input::except(array('_token')) ;
	    
	    $inputs = $request->all();
	    
	    if(!empty($inputs['id']))
	    {
                    $rule=array(
                    'txtfName' => 'required',
                    'txtlName' => 'required',
                    'email' => 'required|email|max:75',    
                    'txtAddress' => 'required',
                    'ddlState' => 'required',
                    'ddlCity' => 'required',
                    'txtPinCode' => 'required|max:6',
                    'mobile' => 'required'	        	        
                             );
			
		}
		else
		{
                    $rule=array(
                    'username' => 'min:6|required|unique:users,ucode',    
                    'email' => 'required|email|max:75|unique:users',    
                    'mobile' => 'required'
                    		        
                             );
		}
		if(!empty($inputs['password']))
		{
			$rule=array(
			'password' => 'required|same:confirm_password'
			);
		}
	    
	    
	    
	   	 $validator = \Validator::make($data,$rule);
 
        if ($validator->fails())
        {
                return redirect()->back()->withErrors($validator->messages());
        } 
	      
		if(!empty($inputs['id'])){
           
            $user = User::findOrFail($inputs['id']);

        }else{

            $user = new User;

        }
		$count=User::where('ucode',$inputs['txtintroid'])->count();
		//User image
                if($count>0){
        $fileUpload1 = $request->file('fileUpload1');
         
        if($fileUpload1){
           // \File::delete(public_path() .'/upload/members/'.$user->image_icon.'-b.jpg');
           // \File::delete(public_path() .'/upload/members/'.$user->image_icon.'-s.jpg');
            $tmpFilePath = 'upload/members/';
            $hardPath =  str_slug($inputs['txtfName'], '-').'-'.md5(time());
            $img = Image::make($fileUpload1);
            $img->fit(250, 250)->save($tmpFilePath.$hardPath.'-b.jpg');
            //$img->fit(80, 80)->save($tmpFilePath.$hardPath. '-s.jpg');
            $user->fileUpload1 = $tmpFilePath.$hardPath.'-b.jpg';
        } 
     
	$user->usertype = 'User';
	if(empty($inputs['id']))
        {
        $user->ucode=$inputs['username'];
        }
       
         $user->country = $inputs['country']; 
         $user->mobile = $inputs['mobile'];
        $user->email = $inputs['email'];
		$user->pcode = $inputs['txtintroid']; 
          if(!empty($inputs['id']))
        {
	$user->first_name = $inputs['txtfName']; 
        $user->middle_name = $inputs['txtmName'];//new
        $user->last_name = $inputs['txtlName'];       
        
        
    
        $user->txtDob = $inputs['txtDob'];
        $user->gender = $inputs['ddlSex'];
       
        $user->txtAddress = $inputs['txtAddress'];
        $user->txtVillagePost = $inputs['txtVillagePost'];
        $user->ddlState = $inputs['ddlState'];
        $user->ddlCity = $inputs['ddlCity'];     
        $user->txtPinCode = $inputs['txtPinCode'];
        $user->txt_country_code= $inputs['txt_country_code'];//new
        $user->txtPhones = $inputs['txtPhones'];

    
       // $user->txt_benificiary_name= $inputs['txt_benificiary_name']; //new
       // $user->DDLBank = $inputs['DDLBank']; 
        //$user->txtBranchName = $inputs['txtBranchName']; 
       // $user->txtAcNo = $inputs['txtAcNo'];
       // $user->TxtIfsc= $inputs['TxtIfsc'];
       // $user->txtbank_country = $inputs['txtbank_country'];//new
        $user->txtbtc = $inputs['txtbtc'];//new
        $user->txteth = $inputs['txteth'];//new
        $user->txtetc= $inputs['txtetc'];//new
        $user->txtzec= $inputs['txtxrp'];//new
        $user->txtxmr= $inputs['txtxrm'];//new
        $user->txtltc= $inputs['txtltc'];//new
        $user->txtdash= $inputs['txtneo'];//new
        $user->txtfacebook= $inputs['txtfacebook'];//new
        $user->txttwitter= $inputs['txttwitter'];//new
        $user->txtsteemit= $inputs['txtsteemit'];//new
        $user->txtskype= $inputs['txtskype'];//new
        }
        if(empty($inputs['id']))
        {
        $user->status= 'pending';
        }
        if(!empty($inputs['password']))
        {
        $user->password= bcrypt($inputs['password']); 
        }
	$user->save();
	
	
	////////////mail//////////////
	
	/*
        $to = $inputs['email'];
        $site_email = getcong("site_email");
$subject = "HTML email";
$rand = md5(mt_rand(1000,999999));
//echo $URI=URL::to('/');
//echo URL::to('/');
$URI =url()->current();
$username=$inputs['username'];

$message = "
<html>
<head>
<title>HTML email</title>
</head>
<body>
<p>Wel come to regestring  .$site_email please varify your email</p>
<table>
<tr>
<th>varify</th>
</tr>
<tr>
<td>$URI/verify/$username/$rand</td>

</tr>
</table>
</body>
</html>
";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <'.$site_email.'>' . "\r\n";

mail($to,$subject,$message,$headers);

*/

if(empty($inputs['id']))
        {
$rand = md5(mt_rand(1000,999999));
      $data = array(
            'name' => $inputs['username'],
            'email' => $inputs['email'],
            'rand' => $rand
           
             );

            $subject= 'Activate account';
            $email= $inputs['email'];

            Mail::send('emails.sign_up', $data, function ($message) use ($subject,$email){

                $message->from(getcong('site_email'), getcong('site_name'));

                $message->to($email)->subject($subject);

            });
            
            
            
            
      $data = array(
            'email' => $inputs['email'],
            'password' => $inputs['password'],
            'name' => $inputs['username'],

             );

            $subject= 'your Email and password';
            $email= $inputs['email'];

            Mail::send('emails.email_password', $data, function ($message) use ($subject,$email){

                $message->from(getcong('site_email'), getcong('site_name'));

                $message->to($email)->subject($subject);

            });
		
        
        ////////////////////////
	
        
 
        }
                }else{
                    \Session::flash('flash_message', 'Invalid Upline Id');
                    return \Redirect::back(); 
                }
	if(!empty($inputs['id'])){
            \Session::flash('flash_message', 'Changes Saved');
            return \Redirect::back();
        }else{
            \Session::flash('flash_message', 'Added');
            return \Redirect::back();
        }		     
        
         
    }     
    public function change_designation(Request $request){
        
         $user = User::findOrFail($request->id);
         $user->rank=$request->designation;
         $user->save();
           \Session::flash('flash_message', 'Changes Saved');
            return \Redirect::back();
    }
    public function editUser($id)    
    {     
    	  if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');
            
        }		
    		     
          $user = User::findOrFail($id);
           
          return view('admin.pages.addeditUser',compact('user'));
        
    }	 
    
    public function delete($id)
    {
    	
    	if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');
            
        }
        $user = User::findOrFail($id);
        \File::delete(public_path() .'/upload/members/'.$user->fileUpload1.'-b.jpg');
        \File::delete(public_path() .'/upload/members/'.$user->fileUpload2.'-b.jpg');
        \File::delete(public_path() .'/upload/members/'.$user->fileUpload3.'-b.jpg');
        $user->delete();
        \Session::flash('flash_message', 'Deleted');

        return redirect()->back();

    }
    
             public function fecth_cities(Request $request) 
    {
        
        $cities=DB::table('city')->where('state_id',$request->state_id)->orderBy("city_name")->get();
         
          return view('admin.pages.ajax_cities',compact('cities'));
    }
   
        public function invoices(Request $request)
        {
           if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');
            
        }
        $invoices=DB::table('invoices')->orderBy("id")->get();
          return view('admin.pages.invoices',compact('invoices'));
        }
        public function single_invoice(Request $request)
        {
           if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');
            
        }
         $invoices= DB::table('users')
		   ->leftJoin('invoices', 'users.id', '=', 'invoices.userid')
		   ->select('users.*','invoices.*')->where('invoices.id',$request->id)->get();
              
          //$invoices=DB::table('invoices')->where('id',$request->id)->orderBy("id")->get();
          return view('admin.pages.view_invoice',compact('invoices'));
        }
        
           public function allstatement(Request $request)
        {
           if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');
            
        }
          $invoices= DB::table('invoices')
		   ->leftJoin('users', 'users.id', '=', 'invoices.userid')
		   ->select('users.*','invoices.*')->where('users.usertype','!=','Admin')->get();
          return view('admin.pages.all_invoices',compact('invoices'));
        }
          public function delete_statement($id)
    {
    	
    	if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');
            
        }
        $Invoices = Invoices::findOrFail($id);
       
        $Invoices->delete();
        \Session::flash('flash_message', 'Deleted');

        return redirect()->back();

    }
    public function all_withdrawal_requests(Request $request)
        {
           if(Auth::User()->usertype!="Admin"){
            \Session::flash('flash_message', 'Access denied!');
            return redirect('dashboard');
            }
            $withdrawal= DB::table('withdrawal_requests')
		   ->leftJoin('users', 'users.id', '=', 'withdrawal_requests.userid')
		   ->select('users.*','withdrawal_requests.*')->where('users.usertype','!=','Admin')->get();
          
          return view('admin.pages.withdrawal_requests',compact('withdrawal'));
        }
        
        public function withdrawal_requests_status(Request $request)
        {
            if(Auth::User()->usertype!="Admin"){
            \Session::flash('flash_message', 'Access denied!');
            return redirect('dashboard');
            }
            $id=$request->id;
            $withdrawal=Withdrawals::findOrFail($id);
            $withdrawal->status=$request->status;
            $order_amount=$withdrawal->amount;
            $userid=$withdrawal->userid;
            $userdata=DB::table('users')->where('id',$userid)->get();
            $wallet_type=$withdrawal->wallet_type;
         
           if($request->status=='canceled'){
               
                $URI = 'arkonix.eu';
		$emailt = 'info@arkonix.eu';
		 $to=$userdata[0]->email; 
		$headers = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: '.$URI.' <' . $emailt. ">\r\n"; // Sender's Email
		$subject ='Your Withdrawal Request has been cancelled.';
		$array ='Dear '.$userdata[0]->ucode.', <br/>
                        Your Withdrawal Request has been cancelled. <br/>
                        Cryptocurrency-'.$wallet_type.' <br/>
                        Amount:-'.$order_amount;
		
		$mailmessage = $this->email_template($array); 
		$msg = wordwrap($mailmessage,500);
		// send email
		 mail($to,$subject,$msg,$headers);
           }
          
            
            if($request->status=='approved'){
               $txnid='w31231i879t890975h'.$userid.$id.'357d74r5463a25534w4535a53l43534';
               if($wallet_type=='Cash'){
                $total=DB::table('users_ewallet')->where('user_id',$userid)->where('remarks','!=','fixed_wallet')->orderBy('id', 'DESC' )->pluck('net_amount');
                if(isset($total[0])&& $order_amount>$total[0])
                {
                     \Session::flash('flash_message', 'Insufficent Balance');
                       return redirect()->back();
                }
                     if(isset($total[0])&& $total[0]!=0){
                     $total= $total[0]-$order_amount;
                     }else{
                        \Session::flash('flash_message', 'Insufficent Balance');
                         return redirect()->back();
                     }
                 DB::table('users_ewallet')->insert(array('currency_type'=>'Withdrawal','user_id'=>$userid, 'txnid'=>$txnid,'pay_drcr'=>'Dr', 'debit'=>$order_amount,'remarks'=>'cash', 'net_amount'=>$total));
                
               }else{
                   $total=DB::table('users_ewallet')->where('user_id',$userid)->where('currency_type',$wallet_type)->where('remarks','fixed_wallet')->orderby('id','DESC')->pluck('mining_amount');
                   $outgoing=$this->crypto_currency_ticker($wallet_type,$order_amount);
                  // die($outgoing);
                    if(isset($total[0])&& $outgoing>$total[0])
                    {
                     \Session::flash('flash_message', 'Insufficent Balance');
                       return redirect()->back();
                    }
                    if(isset($total[0])&& $total[0]!=0){
                     $total= $total[0]-$outgoing;
                     }else{
                        \Session::flash('flash_message', 'Insufficent Balance');
                         return redirect()->back();
                     }
                 DB::table('users_ewallet')->insert(array('currency_type'=>$wallet_type,'user_id'=>$userid, 'txnid'=>$txnid,'pay_drcr'=>'Dr', 'debit'=>$outgoing,'remarks'=>'fixed_wallet', 'mining_amount'=>$total));

               }
               $URI = 'arkonix.eu';
		$emailt = 'info@arkonix.eu';
		 $to=$userdata[0]->email;  
		$headers = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: '.$URI.' <' . $emailt. ">\r\n"; // Sender's Email
		$subject ='Your Withdrawal Request has been Approved';
		$array ='Dear '.$userdata[0]->ucode.', <br/>
                        Your Withdrawal Request has been Approved. <br/>
                        
                        Cryptocurrency-'.$wallet_type.' <br/>
                        Your Funds Transfer in '.$wallet_type.' attached addresss.    
                        Amount:-'.$order_amount;
		
		$mailmessage = $this->email_template($array); 
		$msg = wordwrap($mailmessage,500);
		// send email
		 mail($to,$subject,$msg,$headers);
            }
            $withdrawal->save();
             \Session::flash('flash_message', 'Updated Successfully');
            return redirect()->back();
        }
         public function witdrawal_request_mail(Request $request)
	  {
		//die('do or die');
             $URI = 'arkonix.eu';
		$emailt = 'info@arkonix.eu';
		 $to=$request['toemail']; 
		$headers = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: '.$URI.' <' . $emailt. ">\r\n"; // Sender's Email
		$subject =$request['subject'];
		$array =$request['message'];
		
		$mailmessage = $this->email_template($array); 
		$msg = wordwrap($mailmessage,500);
		// send email
		 mail($to,$subject,$msg,$headers);
 
			\Session::flash('flash_message', 'Email has sent!');
			return redirect()->back();
		 
	  }
         public function tickets(Request $request)
        {
           if(Auth::User()->usertype!="Admin"){
            \Session::flash('flash_message', 'Access denied!');
            return redirect('dashboard');
            }
          $tickets=Tickets::orderBy('id')->get();
          return view('admin.pages.tickets',compact('tickets'));
        }
        
        public function ticket_status(Request $request)
        {
            if(Auth::User()->usertype!="Admin"){
            \Session::flash('flash_message', 'Access denied!');
            return redirect('dashboard');
            }
            
            $id=$request->id;
            $tickets=Tickets::findOrFail($id);
            $tickets->status=$request->status;
            $tickets->save();
             \Session::flash('flash_message', 'Updated Successfully');
            return redirect()->back();
        }
        public function single_level_tree(Request $request)
        {
            $id=$request->id;
            return view('admin.pages.direct_level_tree',compact('id'));
        }
        public function user_earning(Request $request)
        {
            $ucode=$request->ucode;
            $earnings=Earnings::where('ucode',$ucode)->get();
            return view('admin.pages.user_earnings',compact('earnings'));
        }
         public function payout_status(Request $request)
        {
            $id=$request->id;
            $Earnings = Earnings::findOrFail($id);
            $Earnings->payout_issued=$request->status;
            $Earnings->save();
            $txnid='arkq335ds213dsuh3124ffdsyws312tttt'.$request->id;
            if($request->status='yes'){
            $user_detail=DB::table('users')->where('ucode',$request->ucode)->get();
            $earning_detail=DB::table('earning')->where('id',$request->id)->get();
            
           
             if(isset($total[0])){
            $total= $total[0]+$earning_detail[0]->earned;
            $total2= $total[0]+$earning_detail[0]->cash_account;
            }else{
                $total=$earning_detail[0]->earned; 
                $total2=$earning_detail[0]->cash_account; 
            }
             DB::table('users_ewallet')->where('txnid',$txnid)->delete();
            DB::table('users_ewallet')->insert(array('user_id'=>$user_detail[0]->id,'remarks'=>'cash','txnid'=>$txnid,'credit'=>$earning_detail[0]->earned,'net_amount'=>$total));
           $total=DB::table('users_ewallet')->where('user_id',$user_detail[0]->id)->orderBy('created_at', 'desc')->pluck('net_amount');
            if(isset($total[0])){
          
            $total2= $total[0]+$earning_detail[0]->cash_account;
            }else{
             
                $total2=$earning_detail[0]->cash_account; 
            }
            DB::table('users_ewallet')->insert(array('user_id'=>$user_detail[0]->id,'remarks'=>'mining','txnid'=>$txnid,'credit'=>$earning_detail[0]->cash_account,'net_amount'=>$total2));

            }else{   
             
                $earning_detail=DB::table('users_ewallet')->where('txnid',$txnid)->delete();
            }
            \Session::flash('flash_message', 'Status Changed'); 
            return redirect()->back();
        }
          public function pending_payout_reports(Request $request)
        {
           
           $earnings= DB::table('earning')
		   ->leftJoin('users', 'users.ucode', '=', 'earning.ucode')
		   ->select('users.*','earning.*')
                    ->where('earning.payout_issued','no')     
		  ->get();
          return view('admin.pages.pending_payouts',compact('earnings'));
        }
          public function approved_payout_reports(Request $request)
        {
         //$earnings = Earnings::where('payout_issued','yes')->get();
              $earnings= DB::table('earning')
		   ->leftJoin('users', 'users.ucode', '=', 'earning.ucode')
		   ->select('users.*','earning.*')
                    ->where('earning.payout_issued','yes')     
		  ->get();
         return view('admin.pages.approved_payouts',compact('earnings'));
        }
         public function export_approved_payout_reports(Request $request)
        {
        
           return view('admin.pages.export_approved_payout_reports');
             
        }
          public function export_pending_payout_reports(Request $request)
        {
        
           return view('admin.pages.export_pending_payout_reports');
             
        }
          public function export_total_income_reports(Request $request)
        {
        
           return view('admin.pages.export_total_income');
             
        }
         public function  user_status(Request $request)
        {
            $id=$request->id;
           // echo 'come';die;
            $user = User::findOrFail($id);
            $user->status=$request->status;
            $user->save();
//             if($request->status=='approved')
//            {
//            $users=User::where('id',$id)->get();
//            foreach ($users as $user){
//                
//            }
//            $invoices = new Invoices;
//            $pln=$user->plan_name;
//            $amount=Plans::where('plan_name',$pln)->pluck('membership_cost');
//            $cost=Plans::where('plan_name',$pln)->pluck('level_profit');
//            $user_name = $user->first_name.' '.$user->last_name; 
//            $txnid=rand().md5(time());
//            $remarks='Joining as '.$user->plan_name.' Membership';
//            $invoices->userid=$user->id;
//            $invoices->user=$user_name;
//            $invoices->amount=$amount[0];
//            $invoices->txn_id=$txnid;
//            $invoices->remarks=$remarks;
//            $invoices->type='Joining Purchased';
//            $invoices->payment_with='By Cash';
//            $invoices->status='Completed';
//            $invoices->save();
//            }
        \Session::flash('flash_message', 'Status Changed');
         return redirect()->back();
        }
         public function  user_order_print(Request $request)
        {
             $id=$request->id;
              return view('admin.pages.print_order_invoice',  compact('id'));
         }
         public function  user_order_status(Request $request)
        {
			
              
            $id=$request->user_id;
           // echo 'come';die;
            $user = User::findOrFail($id);
            DB::table('order')->where('order_id' ,$request->order_id)->update([ 'payout_issued'=>'approved']);	
            $ordering=DB::table('order')->where('order_id' ,$request->order_id)->get();
            Foreach($ordering as $orders){
            $pln=$orders->product_name;
            $amount=Plans::where('id',$orders->product_id)->pluck('membership_cost');
            if(empty($user->pcode)){
                 \Session::flash('flash_message', ' This is admin order ');
                 return redirect()->back();
            }
            $user_level=User::where('ucode',$user->pcode)->get();
            $level1counts=Bonus::where('plan_name',$pln)->where('type','package_purchase')->count();
           
            if($level1counts==0){
                \Session::flash('flash_message', $pln.' bouns not exist please assign bouns according this plan');
                 return redirect()->back();
            }
            $level1=Bonus::where('plan_name',$pln)->where('type','package_purchase')->pluck('level1');
            $package_buyer_exist=DB::table('order')->where('user_id',$user_level[0]['id'])->orderBy('id','DESC')->where('payout_issued','approved')->count();
            $package_buyer_price=DB::table('order')->where('user_id',$user_level[0]['id'])->orderBy('id','DESC')->where('payout_issued','approved')->pluck('product_price');
         
            if($package_buyer_exist>0 && $package_buyer_price[0]>=50){
            foreach($user_level as $parent)
                {
                $totalamount=$amount[0]*$level1[0]/100; 
                
                $net_amount=$totalamount;
                $earned=$net_amount;
                $earned=$net_amount;
                $earnings=new Earnings;
                $earnings->ucode=$parent->ucode;
                $earnings->pcode=$parent->pcode;
                $earnings->type='Direct(level-1)';
                $earnings->product_id=$orders->product_id;
                $earnings->totalamount=$totalamount;
               
                $earnings->net_amount=$net_amount;
           
                $earnings->earned=$earned*40/100;
                $earnings->cash_account=$earned*60/100;
                $earnings->save();
                  //new code start
                        $order_amount=$earned*40/100;
                        $txnid='c31231a879s890975h'.$parent->id.'357p74m5463i25534n4535i53n43534g';
                        $total=DB::table('users_ewallet')->where('user_id',$parent->id)->where('remarks','!=','fixed_wallet')->orderBy('id', 'DESC' )->pluck('net_amount');
                             if(isset($total[0]) && $total[0]!=0){
                             $total= $total[0]+$order_amount;
                             }else{
                                 $total=$order_amount; 
                             }
                         DB::table('users_ewallet')->insert(array('currency_type'=>'levelincome','user_id'=>$parent->id, 'txnid'=>$txnid,'pay_drcr'=>'Cr', 'credit'=>$order_amount,'remarks'=>'mining', 'net_amount'=>$total));
                         $order_amount=$earned*60/100;
                        $total=DB::table('users_ewallet')->where('user_id',$parent->id)->where('remarks','!=','fixed_wallet')->orderBy('id', 'DESC' )->pluck('net_amount');
                             if(isset($total[0])&& $total[0]!=0){
                             $total= $total[0]+$order_amount;
                             }else{
                                 $total=$order_amount; 
                             }
                         DB::table('users_ewallet')->insert(array('currency_type'=>'levelincome','user_id'=>$parent->id, 'txnid'=>$txnid,'pay_drcr'=>'Cr', 'credit'=>$order_amount,'remarks'=>'cash', 'net_amount'=>$total));
                        //new code end
                    $user_level1=User::where('ucode',$parent->pcode)->get();
                    $level2=Bonus::where('plan_name',$pln)->where('type','package_purchase')->pluck('level2');
                    foreach($user_level1 as $parent1)
                    {
                    $package_buyer_exist1=DB::table('order')->where('user_id',$parent1->id)->orderBy('id','DESC')->where('payout_issued','approved')->count();
                    $package_buyer_price1=DB::table('order')->where('user_id',$parent1->id)->orderBy('id','DESC')->where('payout_issued','approved')->pluck('product_price');
                    if($package_buyer_exist1>0 && $package_buyer_price1[0]>=100){
                    $totalamount1=$amount[0]*$level2[0]/100; 
                    $net_amount1=$totalamount1;
                    $earned1=$net_amount1;
                    $earned1=$net_amount1;
                    $earnings=new Earnings;
                    $earnings->ucode=$parent1->ucode;
                    $earnings->pcode=$parent1->pcode;
                    $earnings->type='InDirect(level-2)';
                    $earnings->product_id=$orders->product_id;
                    $earnings->totalamount=$totalamount1;
                
                    $earnings->net_amount=$net_amount1;
           
                    $earnings->earned=$earned1*40/100;
                    $earnings->cash_account=$earned1*60/100;
                    $earnings->save();
                      //new code start
                            $order_amount=$earned1*40/100;
                            $txnid='c31231a879s890975h'.$parent1->id.'357p74m5463i25534n4535i53n43534g';
                            $total=DB::table('users_ewallet')->where('user_id',$parent1->id)->where('remarks','!=','fixed_wallet')->orderBy('id', 'DESC' )->pluck('net_amount');
                                 if(isset($total[0])&& $total[0]!=0){
                                 $total= $total[0]+$order_amount;
                                 }else{
                                     $total=$order_amount; 
                                 }
                             DB::table('users_ewallet')->insert(array('currency_type'=>'levelincome','user_id'=>$parent1->id, 'txnid'=>$txnid,'pay_drcr'=>'Cr', 'credit'=>$order_amount,'remarks'=>'mining', 'net_amount'=>$total));
                             $order_amount=$earned1*60/100;
                            $total=DB::table('users_ewallet')->where('user_id',$parent1->id)->where('remarks','!=','fixed_wallet')->orderBy('id', 'DESC' )->pluck('net_amount');
                                 if(isset($total[0])&& $total[0]!=0){
                                 $total= $total[0]+$order_amount;
                                 }else{
                                     $total=$order_amount; 
                                 }
                             DB::table('users_ewallet')->insert(array('currency_type'=>'levelincome','user_id'=>$parent1->id, 'txnid'=>$txnid,'pay_drcr'=>'Cr', 'credit'=>$order_amount,'remarks'=>'cash', 'net_amount'=>$total));
                            //new code end
                            $user_level2=User::where('ucode',$parent1->pcode)->get();
                            $level3=Bonus::where('plan_name',$pln)->where('type','package_purchase')->pluck('level3');
                            foreach($user_level2 as $parent2)
                            {
                            $package_buyer_exist2=DB::table('order')->where('user_id',$parent2->id)->where('payout_issued','approved')->count();
                             $package_buyer_price2=DB::table('order')->where('user_id',$parent2->id)->orderBy('id','DESC')->where('payout_issued','approved')->pluck('product_price');
                          if($package_buyer_exist2>0 && $package_buyer_price2[0]>=100){
                        
                            $totalamount2=$amount[0]*$level3[0]/100; 
                            $net_amount2=$totalamount2;
                            $earned2=$net_amount2;
                            $earned2=$net_amount2;
                            $earnings=new Earnings;
                            $earnings->ucode=$parent2->ucode;
                            $earnings->pcode=$parent2->pcode;
                            $earnings->type='InDirect(level-3)';
                            $earnings->product_id=$orders->product_id;
                            $earnings->totalamount=$totalamount2;
                            $earnings->net_amount=$net_amount2;
                            $earnings->earned=$earned2*40/100;
                           $earnings->cash_account=$earned2*60/100;
                            $earnings->save();
                              //new code start
                                    $order_amount=$earned2*40/100;
                                    $txnid='c31231a879s890975h'.$parent2->id.'357p74m5463i25534n4535i53n43534g';
                                    $total=DB::table('users_ewallet')->where('user_id',$parent2->id)->where('remarks','!=','fixed_wallet')->orderBy('id', 'DESC' )->pluck('net_amount');
                                         if(isset($total[0])&& $total[0]!=0){
                                         $total= $total[0]+$order_amount;
                                         }else{
                                             $total=$order_amount; 
                                         }
                                     DB::table('users_ewallet')->insert(array('currency_type'=>'levelincome','user_id'=>$parent2->id, 'txnid'=>$txnid,'pay_drcr'=>'Cr', 'credit'=>$order_amount,'remarks'=>'mining', 'net_amount'=>$total));
                                     $order_amount=$earned2*60/100;
                                    $total=DB::table('users_ewallet')->where('user_id',$parent2->id)->where('remarks','!=','fixed_wallet')->orderBy('id', 'DESC' )->pluck('net_amount');
                                         if(isset($total[0])&& $total[0]!=0){
                                         $total= $total[0]+$order_amount;
                                         }else{
                                             $total=$order_amount; 
                                         }
                                     DB::table('users_ewallet')->insert(array('currency_type'=>'levelincome','user_id'=>$parent2->id, 'txnid'=>$txnid,'pay_drcr'=>'Cr', 'credit'=>$order_amount,'remarks'=>'cash', 'net_amount'=>$total));
                                    //new code end
                                    $user_level3=User::where('ucode',$parent2->pcode)->get();
                                    $level4=Bonus::where('plan_name',$pln)->where('type','package_purchase')->pluck('level4');
                                    foreach($user_level3 as $parent3)
                                    {
                                    $package_buyer_exist3=DB::table('order')->where('user_id',$parent3->id)->where('payout_issued','approved')->count();
                                     $package_buyer_price3=DB::table('order')->where('user_id',$parent3->id)->orderBy('id','DESC')->where('payout_issued','approved')->pluck('product_price');
                                    if($package_buyer_exist3>0 && $package_buyer_price3[0]>=250){
                                    $totalamount3=$amount[0]*$level4[0]/100; 
                                    $net_amount3=$totalamount3;
                                    $earned3=$net_amount3;
                                    $earned3=$net_amount3;
                                    $earnings=new Earnings;
                                    $earnings->ucode=$parent3->ucode;
                                    $earnings->pcode=$parent3->pcode;
                                    $earnings->type='InDirect(level-4)';
                                    $earnings->product_id=$orders->product_id;
                                    $earnings->totalamount=$totalamount3;
                                    $earnings->net_amount=$net_amount3;
                                    $earnings->earned=$earned3*40/100;
                                    $earnings->cash_account=$earned3*60/100;
                                    $earnings->save();
                                      //new code start
                                                                   $order_amount=$earned3*40/100;
                                                                   $txnid='c31231a879s890975h'.$parent3->id.'357p74m5463i25534n4535i53n43534g';
                                                                   $total=DB::table('users_ewallet')->where('user_id',$parent3->id)->where('remarks','!=','fixed_wallet')->orderBy('id', 'DESC' )->pluck('net_amount');
                                                                        if(isset($total[0])&& $total[0]!=0){
                                                                        $total= $total[0]+$order_amount;
                                                                        }else{
                                                                            $total=$order_amount; 
                                                                        }
                                                                    DB::table('users_ewallet')->insert(array('currency_type'=>'levelincome','user_id'=>$parent3->id, 'txnid'=>$txnid,'pay_drcr'=>'Cr', 'credit'=>$order_amount,'remarks'=>'mining', 'net_amount'=>$total));
                                                                    $order_amount=$earned3*60/100;
                                                                   $total=DB::table('users_ewallet')->where('user_id',$parent3->id)->where('remarks','!=','fixed_wallet')->orderBy('id', 'DESC' )->pluck('net_amount');
                                                                        if(isset($total[0])&& $total[0]!=0){
                                                                        $total= $total[0]+$order_amount;
                                                                        }else{
                                                                            $total=$order_amount; 
                                                                        }
                                                                    DB::table('users_ewallet')->insert(array('currency_type'=>'levelincome','user_id'=>$parent3->id, 'txnid'=>$txnid,'pay_drcr'=>'Cr', 'credit'=>$order_amount,'remarks'=>'cash', 'net_amount'=>$total));
                                                                   //new code end
                                              $user_level4=User::where('ucode',$parent3->pcode)->get();
                                              $level5=Bonus::where('plan_name',$pln)->where('type','package_purchase')->pluck('level5');
                                              foreach($user_level4 as $parent4)
                                              {
                                              $package_buyer_exist4=DB::table('order')->where('user_id',$parent4->id)->where('payout_issued','approved')->count();
                                           $package_buyer_price4=DB::table('order')->where('user_id',$parent4->id)->orderBy('id','DESC')->where('payout_issued','approved')->pluck('product_price');
                                            if($package_buyer_exist4>0 && $package_buyer_price4[0]>=250){
                                              $totalamount4=$amount[0]*$level5[0]/100; 
                                              $net_amount4=$totalamount4;
                                              $earned4=$net_amount4;
                                              $earned4=$net_amount4;
                                              $earnings=new Earnings;
                                              $earnings->ucode=$parent4->ucode;
                                              $earnings->pcode=$parent4->pcode;
                                              $earnings->type='InDirect(level-5)';
                                              $earnings->product_id=$orders->product_id;
                                              $earnings->totalamount=$totalamount4;
                                              $earnings->net_amount=$net_amount4;
                                              $earnings->earned=$earned4*40/100;
                                              $earnings->cash_account=$earned4*60/100;
                                              $earnings->save();
                                                //new code start
                                                                   $order_amount=$earned4*40/100;
                                                                   $txnid='c31231a879s890975h'.$parent4->id.'357p74m5463i25534n4535i53n43534g';
                                                                   $total=DB::table('users_ewallet')->where('user_id',$parent4->id)->where('remarks','!=','fixed_wallet')->orderBy('id', 'DESC' )->pluck('net_amount');
                                                                        if(isset($total[0])&& $total[0]!=0){
                                                                        $total= $total[0]+$order_amount;
                                                                        }else{
                                                                            $total=$order_amount; 
                                                                        }
                                                                    DB::table('users_ewallet')->insert(array('currency_type'=>'levelincome','user_id'=>$parent4->id, 'txnid'=>$txnid,'pay_drcr'=>'Cr', 'credit'=>$order_amount,'remarks'=>'mining', 'net_amount'=>$total));
                                                                    $order_amount=$earned4*60/100;
                                                                   $total=DB::table('users_ewallet')->where('user_id',$parent4->id)->where('remarks','!=','fixed_wallet')->orderBy('id', 'DESC' )->pluck('net_amount');
                                                                        if(isset($total[0])&& $total[0]!=0){
                                                                        $total= $total[0]+$order_amount;
                                                                        }else{
                                                                            $total=$order_amount; 
                                                                        }
                                                                    DB::table('users_ewallet')->insert(array('currency_type'=>'levelincome','user_id'=>$parent4->id, 'txnid'=>$txnid,'pay_drcr'=>'Cr', 'credit'=>$order_amount,'remarks'=>'cash', 'net_amount'=>$total));
                                                                   //new code end
                                                   $user_level5=User::where('ucode',$parent4->pcode)->get();
                                                    $level6=Bonus::where('plan_name',$pln)->where('type','package_purchase')->pluck('level6');
                                                    foreach($user_level5 as $parent5)
                                                    {
                                                    $package_buyer_exist5=DB::table('order')->where('user_id',$parent5->id)->where('payout_issued','approved')->count();
                                                     $package_buyer_price5=DB::table('order')->where('user_id',$parent5->id)->orderBy('id','DESC')->where('payout_issued','approved')->pluck('product_price');
                                                    if($package_buyer_exist5>0 && $package_buyer_price5[0]>=500){
                                                    $totalamount5=$amount[0]*$level6[0]/100; 
                                                    $net_amount5=$totalamount5;
                                                    $earned5=$net_amount5;
                                                    $earned5=$net_amount5;
                                                    $earnings=new Earnings;
                                                    $earnings->ucode=$parent5->ucode;
                                                    $earnings->pcode=$parent5->pcode;
                                                    $earnings->type='InDirect(level-6)';
                                                    $earnings->product_id=$orders->product_id;
                                                    $earnings->totalamount=$totalamount5;
                                                    $earnings->net_amount=$net_amount5;
                                                    $earnings->earned=$earned5*40/100;
                                                    $earnings->cash_account=$earned5*60/100;
                                                    $earnings->save();
                                                      //new code start
                                                                   $order_amount=$earned5*40/100;
                                                                   $txnid='c31231a879s890975h'.$parent5->id.'357p74m5463i25534n4535i53n43534g';
                                                                   $total=DB::table('users_ewallet')->where('user_id',$parent5->id)->where('remarks','!=','fixed_wallet')->orderBy('id', 'DESC' )->pluck('net_amount');
                                                                        if(isset($total[0])&& $total[0]!=0){
                                                                        $total= $total[0]+$order_amount;
                                                                        }else{
                                                                            $total=$order_amount; 
                                                                        }
                                                                    DB::table('users_ewallet')->insert(array('currency_type'=>'levelincome','user_id'=>$parent5->id, 'txnid'=>$txnid,'pay_drcr'=>'Cr', 'credit'=>$order_amount,'remarks'=>'mining', 'net_amount'=>$total));
                                                                    $order_amount=$earned5*60/100;
                                                                   $total=DB::table('users_ewallet')->where('user_id',$parent5->id)->where('remarks','!=','fixed_wallet')->orderBy('id', 'DESC' )->pluck('net_amount');
                                                                        if(isset($total[0])&& $total[0]!=0){
                                                                        $total= $total[0]+$order_amount;
                                                                        }else{
                                                                            $total=$order_amount; 
                                                                        }
                                                                    DB::table('users_ewallet')->insert(array('currency_type'=>'levelincome','user_id'=>$parent5->id, 'txnid'=>$txnid,'pay_drcr'=>'Cr', 'credit'=>$order_amount,'remarks'=>'cash', 'net_amount'=>$total));
                                                                   //new code end
                                                       $user_level6=User::where('ucode',$parent5->pcode)->get();
                                                        $level7=Bonus::where('plan_name',$pln)->where('type','package_purchase')->pluck('level7');
                                                        foreach($user_level6 as $parent6)
                                                        {
                                                         $package_buyer_exist6=DB::table('order')->where('user_id',$parent6->id)->where('payout_issued','approved')->count();
                                                        $package_buyer_price6=DB::table('order')->where('user_id',$parent6->id)->orderBy('id','DESC')->where('payout_issued','approved')->pluck('product_price');
                                                         if($package_buyer_exist6>0 && $package_buyer_price6[0]>=500){
                                                        $totalamount6=$amount[0]*$level7[0]/100; 
                                                       $net_amount6=$totalamount6;
                                                        $earned6=$net_amount6;
                                                        $earned6=$net_amount6;
                                                        $earnings=new Earnings;
                                                        $earnings->ucode=$parent6->ucode;
                                                        $earnings->pcode=$parent6->pcode;
                                                        $earnings->type='InDirect(level-7)';
                                                        $earnings->product_id=$orders->product_id;
                                                        $earnings->totalamount=$totalamount6;
                                                        $earnings->net_amount=$net_amount6;
                                                        $earnings->earned=$earned6*40/100;
                                                        $earnings->cash_account=$earned6*60/100;
                                                        $earnings->save();
                                                          //new code start
                                                                   $order_amount=$earned6*40/100;
                                                                   $txnid='c31231a879s890975h'.$parent6->id.'357p74m5463i25534n4535i53n43534g';
                                                                   $total=DB::table('users_ewallet')->where('user_id',$parent6->id)->where('remarks','!=','fixed_wallet')->orderBy('id', 'DESC' )->pluck('net_amount');
                                                                        if(isset($total[0])&& $total[0]!=0){
                                                                        $total= $total[0]+$order_amount;
                                                                        }else{
                                                                            $total=$order_amount; 
                                                                        }
                                                                    DB::table('users_ewallet')->insert(array('currency_type'=>'levelincome','user_id'=>$parent6->id, 'txnid'=>$txnid,'pay_drcr'=>'Cr', 'credit'=>$order_amount,'remarks'=>'mining', 'net_amount'=>$total));
                                                                    $order_amount=$earned6*60/100;
                                                                   $total=DB::table('users_ewallet')->where('user_id',$parent6->id)->where('remarks','!=','fixed_wallet')->orderBy('id', 'DESC' )->pluck('net_amount');
                                                                        if(isset($total[0])&& $total[0]!=0){
                                                                        $total= $total[0]+$order_amount;
                                                                        }else{
                                                                            $total=$order_amount; 
                                                                        }
                                                                    DB::table('users_ewallet')->insert(array('currency_type'=>'levelincome','user_id'=>$parent6->id, 'txnid'=>$txnid,'pay_drcr'=>'Cr', 'credit'=>$order_amount,'remarks'=>'cash', 'net_amount'=>$total));
                                                                   //new code end
                                                            $user_level7=User::where('ucode',$parent6->pcode)->get();
                                                            $level8=Bonus::where('plan_name',$pln)->where('type','package_purchase')->pluck('level8');
                                                            foreach($user_level7 as $parent7)
                                                            {
                                                            $package_buyer_exist7=DB::table('order')->where('user_id',$parent7->id)->where('payout_issued','approved')->count();
                                                             $package_buyer_price7=DB::table('order')->where('user_id',$parent7->id)->orderBy('id','DESC')->where('payout_issued','approved')->pluck('product_price');
                                                           if($package_buyer_exist7>0 && $package_buyer_price7[0]>=1000){
                                                            $totalamount7=$amount[0]*$level8[0]/100; 
                                                            $net_amount7=$totalamount7;
                                                            $earned7=$net_amount7;
                                                            $earned7=$net_amount7;
                                                            $earnings=new Earnings;
                                                            $earnings->ucode=$parent7->ucode;
                                                            $earnings->pcode=$parent7->pcode;
                                                            $earnings->type='InDirect(level-8)';
                                                            $earnings->product_id=$orders->product_id;
                                                            $earnings->totalamount=$totalamount7;
                                                            $earnings->net_amount=$net_amount7;
                                                            $earnings->earned=$earned7*40/100;
                                                            $earnings->cash_account=$earned7*60/100;
                                                            $earnings->save();
                                                              //new code start
                                                                   $order_amount=$earned7*40/100;
                                                                   $txnid='c31231a879s890975h'.$parent7->id.'357p74m5463i25534n4535i53n43534g';
                                                                   $total=DB::table('users_ewallet')->where('user_id',$parent7->id)->where('remarks','!=','fixed_wallet')->orderBy('id', 'DESC' )->pluck('net_amount');
                                                                        if(isset($total[0])&& $total[0]!=0){
                                                                        $total= $total[0]+$order_amount;
                                                                        }else{
                                                                            $total=$order_amount; 
                                                                        }
                                                                    DB::table('users_ewallet')->insert(array('currency_type'=>'levelincome','user_id'=>$parent7->id, 'txnid'=>$txnid,'pay_drcr'=>'Cr', 'credit'=>$order_amount,'remarks'=>'mining', 'net_amount'=>$total));
                                                                    $order_amount=$earned7*60/100;
                                                                   $total=DB::table('users_ewallet')->where('user_id',$parent7->id)->where('remarks','!=','fixed_wallet')->orderBy('id', 'DESC' )->pluck('net_amount');
                                                                        if(isset($total[0])&& $total[0]!=0){
                                                                        $total= $total[0]+$order_amount;
                                                                        }else{
                                                                            $total=$order_amount; 
                                                                        }
                                                                    DB::table('users_ewallet')->insert(array('currency_type'=>'levelincome','user_id'=>$parent7->id, 'txnid'=>$txnid,'pay_drcr'=>'Cr', 'credit'=>$order_amount,'remarks'=>'cash', 'net_amount'=>$total));
                                                                   //new code end
                                                                $user_level8=User::where('ucode',$parent7->pcode)->get();
                                                                $level9=Bonus::where('plan_name',$pln)->where('type','package_purchase')->pluck('level9');
                                                                foreach($user_level8 as $parent8)
                                                                {
                                                                $package_buyer_exist8=DB::table('order')->where('user_id',$parent8->id)->where('payout_issued','approved')->count();
                                                                 $package_buyer_price8=DB::table('order')->where('user_id',$parent8->id)->orderBy('id','DESC')->where('payout_issued','approved')->pluck('product_price');
                                                                if($package_buyer_exist8>0 && $package_buyer_price8[0]>=1000){
                                                                $totalamount8=$amount[0]*$level9[0]/100; 
                                                                $net_amount8=$totalamount8;
                                                                $earned8=$net_amount8;
                                                                $earned8=$net_amount8;
                                                                $earnings=new Earnings;
                                                                $earnings->ucode=$parent8->ucode;
                                                                $earnings->pcode=$parent8->pcode;
                                                                $earnings->type='InDirect(level-9)';
                                                                $earnings->product_id=$orders->product_id;
                                                                $earnings->totalamount=$totalamount8;
                                                                $earnings->net_amount=$net_amount8;
                                                                $earnings->earned=$earned8*40/100;
                                                                $earnings->cash_account=$earned8*60/100;
                                                                $earnings->save();
                                                                  //new code start
                                                                   $order_amount=$earned8*40/100;
                                                                   $txnid='c31231a879s890975h'.$parent8->id.'357p74m5463i25534n4535i53n43534g';
                                                                   $total=DB::table('users_ewallet')->where('user_id',$parent8->id)->where('remarks','!=','fixed_wallet')->orderBy('id', 'DESC' )->pluck('net_amount');
                                                                        if(isset($total[0])&& $total[0]!=0){
                                                                        $total= $total[0]+$order_amount;
                                                                        }else{
                                                                            $total=$order_amount; 
                                                                        }
                                                                    DB::table('users_ewallet')->insert(array('currency_type'=>'levelincome','user_id'=>$parent8->id, 'txnid'=>$txnid,'pay_drcr'=>'Cr', 'credit'=>$order_amount,'remarks'=>'mining', 'net_amount'=>$total));
                                                                    $order_amount=$earned8*60/100;
                                                                   $total=DB::table('users_ewallet')->where('user_id',$parent8->id)->where('remarks','!=','fixed_wallet')->orderBy('id', 'DESC' )->pluck('net_amount');
                                                                        if(isset($total[0])&& $total[0]!=0){
                                                                        $total= $total[0]+$order_amount;
                                                                        }else{
                                                                            $total=$order_amount; 
                                                                        }
                                                                    DB::table('users_ewallet')->insert(array('currency_type'=>'levelincome','user_id'=>$parent8->id, 'txnid'=>$txnid,'pay_drcr'=>'Cr', 'credit'=>$order_amount,'remarks'=>'cash', 'net_amount'=>$total));
                                                                   //new code end
                                                                   $user_level9=User::where('ucode',$parent8->pcode)->get();
                                                                    $level10=Bonus::where('plan_name',$pln)->where('type','package_purchase')->pluck('level10');
                                                                    foreach($user_level9 as $parent9)
                                                                    {
                                                                    $package_buyer_exist9=DB::table('order')->where('user_id',$parent9->id)->where('payout_issued','approved')->count();
                                                                    $package_buyer_price9=DB::table('order')->where('user_id',$parent9->id)->orderBy('id','DESC')->where('payout_issued','approved')->pluck('product_price');
                                                                    if($package_buyer_exist9>0 && $package_buyer_price9[0]>=2500){
                                                                    $totalamount9=$amount[0]*$level10[0]/100; 
                                                                    $net_amount9=$totalamount9;
                                                                    $earned9=$net_amount9;
                                                                    $earned9=$net_amount9;
                                                                    $earnings=new Earnings;
                                                                    $earnings->ucode=$parent9->ucode;
                                                                    $earnings->pcode=$parent9->pcode;
                                                                    $earnings->type='InDirect(level-10)';
                                                                    $earnings->product_id=$orders->product_id;
                                                                    $earnings->totalamount=$totalamount9;
                                                                    $earnings->net_amount=$net_amount9;
                                                                    $earnings->earned=$earned9*40/100;
                                                                    $earnings->cash_account=$earned9*60/100;
                                                                    $earnings->save();
                                                                      //new code start
                                                                   $order_amount=$earned9*40/100;
                                                                   $txnid='c31231a879s890975h'.$parent9->id.'357p74m5463i25534n4535i53n43534g';
                                                                   $total=DB::table('users_ewallet')->where('user_id',$parent9->id)->where('remarks','!=','fixed_wallet')->orderBy('id', 'DESC' )->pluck('net_amount');
                                                                        if(isset($total[0])&& $total[0]!=0){
                                                                        $total= $total[0]+$order_amount;
                                                                        }else{
                                                                            $total=$order_amount; 
                                                                        }
                                                                    DB::table('users_ewallet')->insert(array('currency_type'=>'levelincome','user_id'=>$parent9->id, 'txnid'=>$txnid,'pay_drcr'=>'Cr', 'credit'=>$order_amount,'remarks'=>'mining', 'net_amount'=>$total));
                                                                    $order_amount=$earned9*60/100;
                                                                   $total=DB::table('users_ewallet')->where('user_id',$parent9->id)->where('remarks','!=','fixed_wallet')->orderBy('id', 'DESC' )->pluck('net_amount');
                                                                        if(isset($total[0])&& $total[0]!=0){
                                                                        $total= $total[0]+$order_amount;
                                                                        }else{
                                                                            $total=$order_amount; 
                                                                        }
                                                                    DB::table('users_ewallet')->insert(array('currency_type'=>'levelincome','user_id'=>$parent9->id, 'txnid'=>$txnid,'pay_drcr'=>'Cr', 'credit'=>$order_amount,'remarks'=>'cash', 'net_amount'=>$total));
                                                                   //new code end
                                                                      $user_level10=User::where('ucode',$parent9->pcode)->get();
                                                                    $level11=Bonus::where('plan_name',$pln)->where('type','package_purchase')->pluck('level11');
                                                                    foreach($user_level10 as $parent10)
                                                                    {
                                                                    $package_buyer_exist10=DB::table('order')->where('user_id',$parent10->id)->where('payout_issued','approved')->count();
                                                                    $package_buyer_price10=DB::table('order')->where('user_id',$parent10->id)->orderBy('id','DESC')->where('payout_issued','approved')->pluck('product_price');
                                                                    if($package_buyer_exist10>0 && $package_buyer_price10[0]>=2500){
                                                                    $totalamount10=$amount[0]*$level11[0]/100; 
                                                                    $net_amount10=$totalamount10;
                                                                    $earned10=$net_amount10;
                                                                    $earned10=$net_amount10;
                                                                    $earnings=new Earnings;
                                                                    $earnings->ucode=$parent10->ucode;
                                                                    $earnings->pcode=$parent10->pcode;
                                                                    $earnings->type='InDirect(level-11)';
                                                                    $earnings->product_id=$orders->product_id;
                                                                    $earnings->totalamount=$totalamount10;
                                                                    $earnings->net_amount=$net_amount10;
                                                                    $earnings->earned=$earned10*40/100;
                                                                    $earnings->cash_account=$earned10*60/100;
                                                                    $earnings->save();
                                                                    //new code start
                                                                   $order_amount=$earned10*40/100;
                                                                   $txnid='c31231a879s890975h'.$parent10->id.'357p74m5463i25534n4535i53n43534g';
                                                                   $total=DB::table('users_ewallet')->where('user_id',$parent10->id)->where('remarks','!=','fixed_wallet')->orderBy('id', 'DESC' )->pluck('net_amount');
                                                                        if(isset($total[0])&& $total[0]!=0){
                                                                        $total= $total[0]+$order_amount;
                                                                        }else{
                                                                            $total=$order_amount; 
                                                                        }
                                                                    DB::table('users_ewallet')->insert(array('currency_type'=>'levelincome','user_id'=>$parent10->id, 'txnid'=>$txnid,'pay_drcr'=>'Cr', 'credit'=>$order_amount,'remarks'=>'mining', 'net_amount'=>$total));
                                                                    $order_amount=$earned10*60/100;
                                                                   $total=DB::table('users_ewallet')->where('user_id',$parent10->id)->where('remarks','!=','fixed_wallet')->orderBy('id', 'DESC' )->pluck('net_amount');
                                                                        if(isset($total[0])&& $total[0]!=0){
                                                                        $total= $total[0]+$order_amount;
                                                                        }else{
                                                                            $total=$order_amount; 
                                                                        }
                                                                    DB::table('users_ewallet')->insert(array('currency_type'=>'levelincome','user_id'=>$parent10->id, 'txnid'=>$txnid,'pay_drcr'=>'Cr', 'credit'=>$order_amount,'remarks'=>'cash', 'net_amount'=>$total));
                                                                   //new code end
                                                                    }
                                                                    }
                                                                    }
                                                                    }
                                                                 }
                                                                }
                                                             }
                                                            }
                                                          }
                                                        }
                                                      }
                                                    }
                                                 }
                                              }
                                        }      
                                    }
                                }
                            }
                        }
                    }
                }
              }
            }
        \Session::flash('flash_message', 'Status Changed');
         return redirect()->back();
        }
        
        
        ////////////////////////sub admin//////////////
        
        public function addnewsubadmin(Request $request)
    { 
     if(Auth::User()->usertype!="Admin"){
            \Session::flash('flash_message', 'Access denied!');
            return redirect('dashboard');
            }
     $data =  \Input::except(array('_token')) ;
     
     $inputs = $request->all();
     
     if(!empty($inputs['id']))
     {
   $rule=array(
          'first_name' => 'required',
          'email' => 'required|email|max:200',
        );
   
  }
  else
  {
   $rule=array(
          'first_name' => 'required',
          'email' => 'required|email|max:75|unique:users',
          'password' => 'required|min:3|max:50',
        );
  }
  $validator = \Validator::make($data,$rule);
        if ($validator->fails())
        {
                return redirect()->back()->withErrors($validator->messages());
        } 
       
  if(!empty($inputs['id'])){
           
            $user = User::findOrFail($inputs['id']);

        }else{

            $user = new User;

        }
  //User image
        $user_image = $request->file('image_icon');
         
        if($user_image){
            
           // \File::delete(public_path() .'/upload/members/'.$user->image_icon.'-b.jpg');
           // \File::delete(public_path() .'/upload/members/'.$user->image_icon.'-s.jpg');
            
            $tmpFilePath = 'upload/members/';

            $hardPath =  str_slug($inputs['first_name'], '-').'-'.md5(time());
            
            $img = Image::make($user_image);

            $img->fit(250, 250)->save($tmpFilePath.$hardPath.'-b.jpg');
            //$img->fit(80, 80)->save($tmpFilePath.$hardPath. '-s.jpg');

            $user->fileUpload1 = $tmpFilePath.$hardPath.'-b.jpg';
             
        } 
				$user->usertype = 'Admin';
                $user->userrole = 'subadmin';
				$user->first_name = $inputs['first_name']; 
                $user->email = $inputs['email'];
                $user->mobile = $inputs['mobile'];
			

                 
                if($inputs['password'])
  {
  $user->password= bcrypt($inputs['password']); 
  }
          $user->save();
                $user_permissions=new UserPermissions;
                $delete=UserPermissions::where('user_id',$user->id)->delete();
                $user_permissions->user_id=$user->id;
                if(!empty($inputs['plans']))
                {
                $user_permissions->plans	= $inputs['plans'];
                }else {
                  $user_permissions->plans	='off'; 
                }
               
                 if(!empty($inputs['users']))
                {
               $user_permissions->users= $inputs['users'];
                }else {
                    $user->users='off';
                }
                if(!empty($inputs['billing']))
                {
                $user_permissions->billing= $inputs['billing'];
                }else {
                  $user_permissions->billing='off'; 
                }
				if(!empty($inputs['transactions']))
                {
                $user_permissions->transactions= $inputs['transactions'];
                }else {
                  $user_permissions->transactions='off'; 
                }
				if(!empty($inputs['payouts']))
                {
                $user_permissions->payouts= $inputs['payouts'];
                }else {
                  $user_permissions->payouts='off'; 
                }
				if(!empty($inputs['tickets']))
                {
                $user_permissions->tickets= $inputs['tickets'];
                }else {
                  $user_permissions->tickets='off'; 
                }
				if(!empty($inputs['news']))
                {
                $user_permissions->news= $inputs['news'];
                }else {
                  $user_permissions->news='off'; 
                }
				
				if(!empty($inputs['blogs']))
                {
                $user_permissions->blogs= $inputs['blogs'];
                }else {
                  $user_permissions->blogs='off'; 
                }
				if(!empty($inputs['twitter']))
                {
                $user_permissions->twitter= $inputs['twitter'];
                }else {
                  $user_permissions->twitter='off'; 
                }
				if(!empty($inputs['files']))
                {
                $user_permissions->files= $inputs['files'];
                }else {
                  $user_permissions->files='off'; 
                }
				
				
				
				if(!empty($inputs['settings']))
                {
                $user_permissions->settings= $inputs['settings'];
                }else {
                  $user_permissions->settings='off'; 
                }
			
               
                
  $user_permissions->save();
  
  if(!empty($inputs['id'])){

            \Session::flash('flash_message', 'Changes Saved');

            return \Redirect::back();
        }else{

            \Session::flash('flash_message', 'Added');

            return \Redirect::back();

        }       
        
         
    }  
     public function editsubadminUser($id)    
    {     
       if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');
            
        }  
           
          $user = User::findOrFail($id);
		  $user_per= DB::table('user_permissions')->where('user_id',$id)->get();
           
          return view('admin.pages.addeditsubadminUser',compact('user','user_per'));
        
    }
     public function reply_on_tickets(Request $request)    
    {    
        // die('kjllkjl');
       if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');
            
        }  
           
           $to_user = $request->userid;
           $from_user=Auth::User()->id;
                    // the message
           $msg = $request->reply;
          DB::table('ticket_reply_thread')->insert(array('ticket_id'=>$request->id,'touser'=>$to_user,'fromuser'=>$from_user,'msg'=>$msg));

            
            // use wordwrap() if lines are longer than 70 characters
            $msg = wordwrap($msg,700);
            // send email
            mail($request->email,$request->subject,$msg);
           
         return \Redirect::back(); 
        
    }
    public function ticket_reply_thread(Request $request) {
        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');
            
        }  
         $id = $request->id;
          return view('admin.pages.ticket_reply_thread',compact('id'));
    }
        ///////////////end/////////////////
        
        
         public function verify_user(Request $request)
         {
            $username=$request->id;
            
           // $results=DB::table('users')->where('ucode', '=', $username)->get();
            
            DB::table('users')
            ->where('ucode', $username)
            ->update(['status' =>'approved']);
            return redirect('/login');
             
             
         }
 
		 
		 public function  users_order_status(Request $request)
        {
			                    $orderid=$request->order_id;
			DB::table('order')->where('order_id' ,$request->order_id)->update(['payment_status'=>$request->status]);
                        if($request->status=='approved'){
                        //**************startnew code
                       
                        $order_detail=DB::table('order')->where('order_id',$orderid)->get();
                        foreach($order_detail as $orderdata){
                        $userdata=DB::table('users')->where('id',$orderdata->user_id)->get();
                        if($orderdata->payment_type=='Bitcoin' || $orderdata->payment_type=='Swisscoin'){
                          $txnid='c31231a879s890975h357'.$orderid.'74a5463c25534c4535o53u43534n4546t';
                          
                        $currency_type=DB::table('plans')->where('id',$orderdata->product_id)->pluck('category');
                        $outgoing=$this->crypto_currency_ticker($currency_type[0],$orderdata->product_price);
                        
                        DB::table('order')->where('order_id' ,$request->order_id)->update(['process_type'=>'processed']);
                         DB::table('users_ewallet')->where('order_id' ,$request->order_id)->delete();
                        $total=DB::table('users_ewallet')->where('user_id',$orderdata->user_id)->where('currency_type',$currency_type[0])->where('remarks','fixed_wallet')->orderBy('id', 'DESC' )->pluck('net_amount');
                        if(isset($total[0])){
                        $total= $total[0]+$outgoing;
                        }else{
                            $total=$outgoing; 
                        }
                        DB::table('users_ewallet')->insert(array('order_id'=>$orderid,'user_id'=>$orderdata->user_id,'currency_type'=>$currency_type[0], 'txnid'=>$txnid, 'credit'=>$outgoing, 'net_amount'=>$total,'pay_status'=>'Approved'));
                           $order_amount=$orderdata->product_price;
                           
                          //Shoot the email start
                                $URI = 'arkonix.eu';
                                $emailt = 'info@arkonix.eu';
                                 $to=$userdata[0]->email;  
                                $headers = 'MIME-Version: 1.0' . "\r\n";
                                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                                $headers .= 'From: '.$URI.' <' . $emailt. ">\r\n"; // Sender's Email
                                $subject ='Your Withdrawal Request has been Approved';
                                $array ='Dear '.$userdata[0]->ucode.', <br/>
                                        Your order for Buy HashRate with Arkonix has approved successfully.
                                        Order Number-  '.$orderid.'
                                        Package –'.$currency_type[0].$order_amount.'
                                        Amount- $'.$order_amount.'
                                        Payment Method - '.$orderdata->payment_type.' <br/>';

                                $mailmessage = $this->email_template($array); 
                                $msg = wordwrap($mailmessage,500);
                                // send email
                                 mail($to,$subject,$msg,$headers);
                    //Shoot the email start
                        
                        }
                        
                        }
                        //**************endnew code
                        }else{
                          DB::table('users_ewallet')->where('order_id' ,$request->order_id)->delete();  
                        }
			return redirect()->back();
			
		}
       
}
 