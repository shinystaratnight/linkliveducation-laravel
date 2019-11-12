<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\VLog;
use App\StudyMaterialSubcat;
use App\CourseVideos;
use App\Order;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Tzsk\Payu\Facade\Payment;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Mail;
use Session;

class PaymentController extends Controller {

    public function success() {
        return view('pages.success');
    }

    public function failure() {
        return view('pages.failure');
    }

    public function buy_course(Request $request) {
        if (!Auth::check()) {
            return redirect('signin');
        }

        $info = CourseVideos::where('subcat', $request->subcat)->first();

        $purchase = new Order;
        $purchase->user_id = Auth::user()->id;
        $purchase->subcat = $info->subcat;
        $purchase->course_id = $info->id;
        $purchase->price = $info->price;
        $purchase->status = 'pending';
        $purchase->payment_gateway = 'PayUMoney';
        $purchase->save();
        /* All Required Parameters by your Gateway */
        if (Session::has('orderid')) {
            Session::forget('orderid');
        }
        Session::put('orderid', $purchase->id);

        $attributes = [
            'txnid' => strtoupper(str_random(8)), # Transaction ID.
            'amount' => $info->price, # Amount to be charged.
            'productinfo' => $info->description,
            'firstname' => Auth::user()->first_name, # Payee Name.
            'email' => Auth::user()->email, # Payee Email Address.
            'phone' => Auth::user()->mobile, # Payee Phone Number.
            'surl' => '{{URL::to("success")}}', # Success Page.
            'furl' => '{{URL::to("failure")}}' # Failure Page.
        ];

        return Payment::make($attributes, function ($then) {
                    $then->redirectTo('payment/status');
                });
    }

    public function status(Request $request) {
        $payment = Payment::capture();

        if ($payment['status'] == 'Completed') {
            Order::where('id', Session::get('orderid'))->update(['txnid' => $payment['txnid'], 'status' => 'Completed']);
            //DB::table('payu_payments')->where('txnid', $payment['txnid'])->update(['order_id' => Session::get('orderid')]);

            $details = Order::where('id', Session::get('orderid'))->first();

            Session::forget('orderid');
            // Get the payment status.
            //$payment->isCaptured();
            return view('pages.success', compact('details'));
        } elseif ($payment['status'] == 'Failed') {
            Order::where('id', Session::get('orderid'))->update(['txnid' => $payment['txnid'], 'status' => 'Failed']);
            Session::forget('orderid');
            //$payment->isCaptured();
            return redirect('failure');
        }
    }

}
