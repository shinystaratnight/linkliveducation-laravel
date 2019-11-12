<?php namespace App\Http\Controllers\Admin;
use Auth;
use App\Posts;
use App\Blogs;
use App\Faq;
use App\Twitter;
use App\User;
use App\Post;
use Redirect;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Intervention\Image\Facades\Image; 
use Illuminate\Http\Request;

// note: use true and false for active posts in postgresql database
// here '0' and '1' are used for active posts because of mysql database

class PostController extends Controller {

    public function maxpostlikes()
    {
        return view('admin.pages.maxpostlikes');
    }

    public function select_maxpost_cat(Request $request)
    {
        $maxpost = Post::where('post_type','=','post')
                ->where('post_type_img_vid',$request->cat)
                ->where('page_id',null)
                ->where('group_id',null)
                ->whereBetween('created_at',[$request->from_date, $request->to_date])
                ->orderBy('total_likes','desc')
                ->limit(500)
                ->get();
        $category = $request->cat;
        $from = $request->from_date;
        $to = $request->to_date;
        return view('admin.pages.maxpostlikes',compact('maxpost','category','from','to'));
    }
    
//    public function select_maxpost_dates(Request $request)
//    {
//        $dates=$request->posts;
//        
//        $maxpost = Post::whereIn('id',$dates->id)
//                ->count();
//        echo $maxpost; die;
//        return view('admin.pages.maxpostlikes',compact('maxpost','category'));
//    }
}