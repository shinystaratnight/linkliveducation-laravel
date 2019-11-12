<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\StudyMaterialSubcat;
use App\CourseVideos;
use App\VideoQuestions;
use App\VideoAnswers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Mail;
use Session;

class UsersController extends Controller {

    public function profile() {
        if (!Auth::check()) {
            return redirect('/signin');
        }
        $data['user'] = DB::table('users')->where('id', Auth::user()->id)->first();
        return view('pages.profile', $data);
    }

    public function edit_user_info(Request $request) {
        if (!Auth::check()) {
            return redirect('/signin');
        }
        $edit_user_info = User::where('id', Auth::user()->id)->firstOrFail();
        $edit_user_info->first_name = $request->first_name;
        $edit_user_info->last_name = $request->last_name;
        $edit_user_info->heading = $request->heading;
        $edit_user_info->country = $request->country;
        $edit_user_info->state = $request->state;
        $edit_user_info->city = $request->city;
        $edit_user_info->save();
        return redirect()->back();
    }

    public function states(Request $request) {
        $states = DB::table('states')->where('country_id', $request->country_id)->get();
        foreach ($states as $stat) {
            echo '<option value="' . $stat->id . '" >' . $stat->name . '</option>';
        }
    }

    public function profile_pic(Request $request) {
        if (!Auth::check()) {
            \Session::flash('flash_message', 'Access denied!');
            return redirect('login');
        }
        $user = User::findOrFail(Auth::user()->id);
        $data = \Input::except(array('_token'));
        $rule = array(
            'profile_pic' => 'required|mimes:jpg,jpeg,gif,png'
        );
        $validator = \Validator::make($data, $rule);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->messages());
        }
        $inputs = $request->all();
        $icon = $request->file('profile_pic');
        if ($icon) {
            $tmpFilePath = 'profile_assets/upload/users/';
            $hardPath = str_slug(Auth::user()->first_name, '-') . '-' . md5(time());
            $extension = $icon->getClientOriginalExtension();
            if ($extension == 'jpeg' || $extension == 'Jpeg' || $extension == 'JPEG' || $extension == 'jpg' || $extension == 'JPG') {
                $image = @ImageCreateFromJpeg($icon);
                if (!$image) {
                    $image = @imagecreatefromstring(file_get_contents($icon));
                }
                $img = Image::make($image);
            } else {
                $img = Image::make($icon);
            }
            $img->fit(250, 250)->save($tmpFilePath . $hardPath . '-b.jpg');
            $user->fileUpload1 = $tmpFilePath . $hardPath . '-b.jpg';
            $user->save();
        }
        \Session::flash('flash_message', 'Profile Pic Updated');
        return \Redirect::back();
    }

    public function cover_pic(Request $request) {
        if (!Auth::check()) {
            return redirect('/');
        }
        $user = User::findOrFail(Auth::user()->id);
        $data = \Input::except(array('_token'));
        $rule = array(
        );
        $validator = \Validator::make($data, $rule);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->messages());
        }
        $inputs = $request->all();
        $icon = $request->file('cover_pic');
        if ($icon) {
            $tmpFilePath = 'profile_assets/upload/users/';
            $hardPath = str_slug(Auth::user()->first_name, '-') . '-' . md5(time());
            $extension = $icon->getClientOriginalExtension();
            if ($extension == 'jpeg' || $extension == 'Jpeg' || $extension == 'JPEG' || $extension == 'jpg' || $extension == 'JPG') {
                $image = @ImageCreateFromJpeg($icon);
                if (!$image) {
                    $image = @imagecreatefromstring(file_get_contents($icon));
                }
                $img = Image::make($image);
            } else {
                $img = Image::make($icon);
            }
            $img->fit(1920, 616)->save($tmpFilePath . $hardPath . '-b.jpg');
            $user->cover_pic = $tmpFilePath . $hardPath . '-b.jpg';
            $user->save();
        }
        \Session::flash('flash_message', 'Cover Pic Updated');
        return \Redirect::back();
    }

    public function user_videos() {
        if (!Auth::check()) {
            return redirect('/');
        }
        $subcat = DB::table('orders')->where('user_id', Auth::user()->id)->where('status','Completed')->groupby('subcat')->pluck('subcat');
        $data['subcat'] = StudyMaterialSubcat::whereIn('id',$subcat)->paginate(10);
        return view('pages.user_videos',$data);
    }
    
    public function course_videos(Request $request) {
        if (!Auth::check()) {
            return redirect('/');
        }
        $subcat = DB::table('orders')->where('user_id', Auth::user()->id)->where('subcat',$request->id)->where('status','Completed')->get();
        if(count($subcat)>0){
            $data['video'] = CourseVideos::where('subcat',$request->id)->first();
        }else{
            $data['video'] = '';
        }
        return view('pages.course_videos',$data);
    }
    
    public function watch_videos(Request $request) {
        if (!Auth::check()) {
            return redirect('/');
        }
        $subcat = DB::table('orders')->where('user_id', Auth::user()->id)->where('subcat',$request->id)->where('status','Completed')->get();
        if(count($subcat)>0){
            $data['videos'] = CourseVideos::where('subcat',$request->id)->first();
            $data['questions'] = VideoQuestions::where('subcat',$request->id)->where('video',$request->name)->get();
        }else{
            $data['videos'] = '';
            $data['questions'] = '';
        }
        $data['video'] = $request->name;
        return view('pages.watch_video',$data);
    }
    
    public function video_questions(Request $request) {
        if (!Auth::check()) {
            return redirect('signin');
        }
        $data = \Input::except(array('_token'));
        $inputs = $request->all();

        $rule = array(
            'subcat'=>'required',
            'video'=>'required',
            'question'=>'required'
        );

        $validator = \Validator::make($data, $rule);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->messages());
        }

        $post = new VideoQuestions;
        $post->user_id = Auth::user()->id;
        $post->subcat = $request->subcat;
        $post->video = $request->video;
        $post->question = $request->question;
        $post->save();

        return redirect()->back();
    }
    
    public function post_answer(Request $request) {
        $array = array();
        $created = array();
        
        $post = new VideoAnswers;
        $post->user_id = Auth::user()->id;
        $post->question_id = $request->id;
        $post->answer = $request->answer;
        $post->save();

        $post_comment_count = VideoAnswers::where('question_id', $request->id)->count();
        $post_comment = DB::table('video_answers')->join('users', 'post_comments.user_id', '=', 'users.id')
                        ->select('post_comments.*', 'users.first_name', 'users.last_name', 'users.fileUpload1')
                        ->where('post_comments.post_id', $request->id)->limit(4)->orderBy('post_comments.created_at', 'desc')->get();
        foreach ($post_comment as $post) {
            $date_time = $post->created_at;
            $diff_in_minutes = $this->difference_datetime_with_current($date_time);

            array_push($created, $diff_in_minutes);
        }

        array_push($array, $request->id, $post_comment_count, $post_comment, $created);

        return $array;
    }
}