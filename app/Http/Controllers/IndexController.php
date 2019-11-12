<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\VLog;
use App\StudyMaterialSubcat;
use App\CourseVideos;
use Session;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Mail;

class IndexController extends Controller {

    public function index() {
        return view('pages.index');
    }

    public function services() {
        return view('pages.services');
    }

    public function about() {
        return view('pages.about');
    }

    public function vlog() {
        $data['vlogs'] = VLog::orderby('id', 'desc')->get();
        return view('pages.vlog', $data);
    }

    public function contact() {
        return view('pages.contact');
    }

    public function faq() {
        return view('pages.faq');
    }
    
    public function partner() {
        return view('pages.partner');
    }

    public function video_courses(Request $request) {
        $data['coursesubcat'] = StudyMaterialSubcat::where('cat_id', $request->id)->get();
        return view('pages.video_courses', $data);
    }

    public function video_courses_subcategory(Request $request) {
        $data['coursesubcat'] = CourseVideos::where('subcat', $request->id)->first();
        $data['subcat'] = StudyMaterialSubcat::where('id', $request->id)->first();
        return view('pages.video_courses_subcategory', $data);
    }

    public function business_development_program() {
        return view('pages.business_development_program');
    }

    public function team_training_program() {
        return view('pages.team_training_program');
    }

    public function contact_us(Request $request) {
        $data = \Input::except(array('_token'));
        $rule = array(
            'uname' => 'required',
            'uemail' => 'required',
            'usubject' => 'required',
            'umessage' => 'required'
        );


        $validator = \Validator::make($data, $rule);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->messages());
        }

        $data = array(
            'uname' => $request->uname,
            'uemail' => $request->uemail,
            'usubject' => $request->usubject,
            'umessage' => $request->umessage
        );

        $subject = $request->usubject;
        $email = $request->uemail;

        \Mail::send('emails.inquiry', $data, function ($message) use ($subject, $email) {
            $message->from(getcong('site_email'), 'LinkLiv Education Support');
            $message->to(getcong('site_email'))->subject($subject);
        });

        \Session::flash('flash_message', 'Thank You. You Message Has Been Sent.');
        return redirect()->back();
    }

    public function postRegister(Request $request) {
        $data = \Input::except(array('_token'));
        $inputs = $request->all();
        $rule = array(
            'first_name' => 'required',
            'last_name' => 'required',
            'username' => 'min:8|required|unique:users,username',
            'email_phone' => 'required|max:75|unique:users,email',
            'mobile' => 'required|max:75|unique:users,mobile',
            'password' => 'required|min:3'
        );
        $validator = \Validator::make($data, $rule);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->messages());
        }
        $user = new User;
        $user->usertype = 'User';
        $user->userrole = 'User';
        $user->username = preg_replace('/\s+/', '', $inputs['username']);
        $user->email = $inputs['email_phone'];
        $user->first_name = $inputs['first_name'];
        $user->last_name = $inputs['last_name'];
        $user->gender = $inputs['gender'];
        $user->mobile = $inputs['mobile'];
        $user->password = bcrypt($inputs['password']);
        $user->show_pass = $inputs['password'];
        $user->status = 'approved';
        $user->save();
        $username = $inputs['username'];
//        $url = url()->current();
//        $rand = md5(mt_rand(10005465, 9999995464));
//        $data = array(
//            'username' => $inputs['username'],
//            'email' => $inputs['email_phone'],
//            'rand' => $rand,
//            'url' => $url
//        );
//        $subject = 'Activate account';
//        $email = $inputs['email_phone'];
//        Mail::send('emails.verify_email', $data, function ($message) use ($subject, $email) {
//            $message->from(getcong('site_email'), 'LinkLiv Support');
//            $message->to($email)->subject($subject);
//        });
        \Session::flash('flash_message', 'Successfully Registered, To Activate your LinkLiv account check your email Inbox or Spam folder.');
        return \Redirect::back();
    }

    public function check_email(Request $request) {
        $count = User::where('email', $request->email)->count();
        if ($count > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    public function check_username(Request $request) {
        $count = User::where('username', $request->username)->count();
        if ($count > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    public function check_phone(Request $request) {
        $count = User::where('mobile', $request->mobile)->count();
        if ($count > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    public function signin() {
        return view('pages.signup');
    }

    public function postLogin(Request $request) {
        $inputs = $request->all();
        $this->validate($request, [
            'username' => 'required', 'password' => 'required',
        ]);
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            if (Auth::user()->status != 'approved') {
                \Auth::logout();
                return redirect('/signin')->withErrors('Please verify account from your email.');
            }
            if (Auth::user()->usertype != 'User') {
                \Auth::logout();
                return redirect('/signin')->withErrors('The specified username does not exist in our system!');
            }
            return $this->handleUserWasAuthenticated($request);
        } elseif (Auth::attempt(['email' => $request->username, 'password' => $request->password])) {
            if (Auth::user()->status != 'approved') {
                \Auth::logout();
                return redirect('/signin')->withErrors('Please verify account from your email.');
            }
            if (Auth::user()->usertype != 'User') {
                \Auth::logout();
                return redirect('/signin')->withErrors('The specified username does not exist in our system!');
            }
            return $this->handleUserWasAuthenticated($request);
        }
        return redirect('/signin')->withErrors('The specified user does not exist in our system!');
    }

    protected function handleUserWasAuthenticated(Request $request) {
        if (method_exists($this, 'authenticated')) {
            return $this->authenticated($request, Auth::user());
        }
        return redirect('profile');
    }

    public function logout() {
        Auth::logout();
        return redirect('/');
    }
}