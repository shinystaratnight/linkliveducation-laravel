<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\CourseVideos;
use App\StudyMaterialCat;
use App\StudyMaterialSubcat;
use App\VLog;
use App\Order;
use App\Session;
use DB;


class VideoController extends MainAdminController
{
	public function video()
	{
            $data['category']=StudyMaterialCat::get();
            $data['subcategory']=StudyMaterialSubcat::get();
            return view('admin.pages.video',$data);
	}
	public function vlog()
	{
            return view('admin.pages.vlog');
	}

        public function allvideo(Request $request)
        {
            $allvideo = CourseVideos::orderBy('id','desc')->get();
            return view('admin.pages.allvideos',compact('allvideo'));
        }
        public function allvlog(Request $request)
        {
            $data['vlog']=VLog::get();
            return view('admin.pages.allvlog',$data);
        }

	public function getvideo(Request $request) {
            $x = $request->all();
            if (!empty($x['id'])) {
                $data = CourseVideos::where('id',$x['id'])->firstOrFail();
            }else{
                $data = new CourseVideos;
            }
            
            if (!empty($request->file('videos'))) {
                $allvideos=array();
                $videos = $request->file('videos');
                foreach($videos as $video){
                    $file = $video;
                    $filename = rand().'_'.time().'_'.$file->getClientOriginalName();
                    $path = public_path() . '/upload/course/videos/';
                    $file->move($path, $filename);
                    $allvideos[] = $filename;
                }
            }
            if (!empty($request->file('featured_image'))) {
                $featured_image = $request->file('featured_image');
                $filename1 = rand().'_'.time().'_'.$featured_image->getClientOriginalName();
                $path1 = public_path() . '/upload/course/images/';
                $featured_image->move($path1, $filename1);
                $data->image = $filename1;
            }
            $datavid = array();
            $data->cat = $x['videocategory'];
            $data->subcat = $x['videosubcategory'];
            $data->description = $x['description'];
            $data->content = $x['content'];
            $data->price = $x['price'];
            $data->benifit = $x['benifit'];
            $data->position = $x['position'];
            if(!empty($allvideos)){
                if(!empty($data->videos)){
                    $datavideos = json_decode($data->videos);
                    foreach($datavideos as $datavideo){
                        $datavid[] = $datavideo;
                    }
                }
                $mergevideos = array_merge($datavid,$allvideos);
                //print_r($mergevideos); die;
                $data->videos = json_encode($mergevideos);
            }
            $data->save();
            return redirect()->back()->with('message', 'Added successfully !!');
        }
	public function getvlog(Request $request) {
            $x = $request->all();
            if (!empty($x['id'])) {
                $data = VLog::where('id',$x['id'])->firstOrFail();
            }else{
                $data = new VLog;
            }
            
            $data->title = $x['title'];
            $data->name = $x['name'];
            $data->save();
            return redirect()->back()->with('message', 'Added successfully !!');
    }

    public function selectcat(Request $request)
        {
          
            $selectcat = DB::table('study_material_subcat')->where('cat_id', $request->cat_id)->get();
            foreach($selectcat as $cat){
                echo '<option value="'.$cat->id.'" >'.$cat->name.'</option>';
            }
          
        }
        
        public function selectsubcat(Request $request)
        {
          
            $selectsubcat = DB::table('sub_subcategory')->where('sub_cat_id', $request->sub_cat_id)->get();
           echo'<option value="0" >Select Sub-Subcategory</option>';
            foreach($selectsubcat as $selectsub){
                echo 
                '<option value="'.$selectsub->id.'" >'.$selectsub->sub_sub_category.'</option>';
                
            }
          
        }
        
        public function deletevlog(Request $request)
        {
            VLog::where('id',$request->id)->delete();
            
            return redirect()->back()->with('message', 'Removed successfully !!');
        }
        
        public function deletevideo(Request $request)
        {
            $deletevideo = CourseVideos::where('id',$request->id)->firstOrFail();
            $allvideos=json_decode($deletevideo->videos);
            foreach($allvideos as $allvideo){
                if(!empty($allvideo))
                {
                // to delete image from directory
                unlink(public_path().'/upload/course/videos/'.$allvideo);
                }
            }
            if(!empty($deletevideo->image))
            {
            // to delete image from directory
            unlink(public_path().'/upload/course/images/'.$deletevideo->image);
            }
            
            $deletevideo->delete();
            
            return redirect()->back();
        }
        public function delete_video(Request $request)
        {
            $allvideos1 = array();
            $deletevideo = CourseVideos::where('id',$request->id)->firstOrFail();
            //echo '<pre>';
            //print_r($deletevideo); die;
            $allvideos=json_decode($deletevideo->videos);
            //echo '<pre>';
            //print_r($allvideos); die;
            $pos = array_search($request->allvideo, $allvideos);
            //echo $pos; die;
            unset($allvideos[$pos]);
            //echo '<pre>';
            //print_r($allvideos); die;
            if(!empty($request->allvideo))
            {
            // to delete image from directory
                if(!empty(public_path().'/upload/course/videos/'.$request->allvideo)){
                    unlink(public_path().'/upload/course/videos/'.$request->allvideo);
                }
            }
            foreach($allvideos as $video){
                $allvideos1[] = $video;
            }
            if(!empty($allvideos)){
                $deletevideo->videos = json_encode($allvideos1);
            }else{
                $deletevideo->videos = '';
            }
            $deletevideo->save();
            
            return redirect()->back();
        }

	public function editvideo(Request $request)
	{
            $data['video'] = DB::table('course_videos')->where('id',$request->id)->first();
            $data['category']=StudyMaterialCat::get();
            $data['subcategory']=StudyMaterialSubcat::where('cat_id',$data['video']->cat)->get();
            return view('admin.pages.video', $data);
        }
	public function editvlog(Request $request)
	{
            $data['vlog']=VLog::where('id',$request->id)->first();
            return view('admin.pages.vlog', $data);
        }
	public function orders(Request $request)
	{
            $data['orders']=Order::get();
            return view('admin.pages.orders', $data);
        }
}