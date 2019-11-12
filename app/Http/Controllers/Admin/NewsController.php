<?php
namespace App\Http\Controllers\Admin;

use Auth;
use App\User;
use Session;
use App\News;
use App\Influencers;
use App\InfluencerCat;
use Mail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use File;


class NewsController extends MainAdminController
{
    public function news()
    {
        if(Auth::User()->usertype!="Admin")
        {
            \Session::flash('flash_message', 'Access denied!');
            return redirect('admin/dashboard');
        }
        else
        {
        return view('admin.pages.news');
        }
    }
    
    // to change news status
    
    public function  news_status(Request $request)
        {
            $id=$request->id;
           
            $news = News::findOrFail($id);
            $news->status=$request->status;
            $news->save();

        \Session::flash('flash_message', 'Status Changed');
         return redirect()->back();
        }
       
        // to delete a news
        
    public function news_delete($id)
    {
        if(!Auth::check())
       { 
            return redirect('/');
       }
       
            $news = News::findOrFail($id);
            $news->delete();

        \Session::flash('flash_message', 'Status Changed');
         return redirect()->back();
    }
    
    public function addeditNews(Request $request)
    {
        if(Auth::User()->usertype!="Admin")
       {
            \Session::flash('flash_message', 'Access denied!');
            return redirect('admin/dashboard');
       }
       
       return view('admin.pages.addeditNews');
               
    }
    
    // to add and edit news
    
    public function add_news(Request $request)
    {
        if(Auth::User()->usertype!="Admin")
       { 
            return redirect('/');
       }
       
       
	    
	    $inputs = $request->all();
            
        if(!empty($inputs['id']))
        {
           
            $news = News::findOrFail($inputs['id']);
            
            
            
            $news->title = $inputs['news_title'];
            $news->slug = $inputs['news_slug'];
            $news->link = $inputs['news_link'];
            $news->body = $inputs['news_body'];
            
            $news_img = $request->file('news_img');
             
            if($news_img)
            {
                // to delete image from directory
                File::delete(public_path() .'/upload/news/'.$news->image);
                
                $news_img = $request->file('news_img')->getPathname();
				$imgName = uniqid().$request->file('news_img')->getClientOriginalName();
				$path = base_path() . '/public/upload/news/';
				$request->file('news_img')->move($path , $imgName);
			
		$news->image = $imgName;
            }
            
            $news->save();
            
            \Session::flash('flash_message', 'News Successfully Updated');
            return redirect()->back();
            
            
           
        }else
            {
            
            $data =  \Input::except(array('_token')) ;
            
            $rule=array(
                        
                        );
             
        $validator = \Validator::make($data,$rule);
        if ($validator->fails())
        {
                return redirect()->back()->withErrors($validator->messages());
        }

            $news = new News;
            
            $news->author_id = Auth::user()->id;
            $news->title = $inputs['news_title'];
            $news->slug = str_slug($inputs['news_title']);
            $news->link = $inputs['news_link'];
            $news->body = $inputs['news_body'];
            $news->status = 'Live';
            
            $news_img = $request->file('news_img');
            
            if($news_img)
            {
                $news_img = $request->file('news_img')->getPathname();
		$imgName = uniqid().$request->file('news_img')->getClientOriginalName();
		$path = base_path() . '/public/upload/news/';
		$request->file('news_img')->move($path , $imgName);
			
		$news->image = $imgName;
            }
            
            $news->save();
            
            \Session::flash('flash_message', 'News Successfully Added');
            return redirect()->back();
            

        }
    }
    
    public function edit_news($id)
    {
        if(Auth::User()->usertype!="Admin")
        {
            \Session::flash('flash_message', 'Access denied!');
            return redirect()->back();
        }   
            $news = News::findOrFail($id);
            
            return view('admin.pages.addeditNews',compact('news'));
    }
    
     
    public function influencers(Request $request)
    {
        if(Auth::User()->usertype!="Admin")
        {
            \Session::flash('flash_message', 'Access denied!');
            return redirect()->back();
        }   
        
        if($request->cat)
        {
            $influencers = DB::table('influencers')->where('category', $request->cat)->where('status','pending')->orderBy('followers','desc')->get();
            
            $categories = InfluencerCat::all();
            
            $category = $request->cat;
            
            return view('admin.pages.influencers',compact('influencers','categories','category'));
        }
        else
        {
            $categories = InfluencerCat::all();
            
            return view('admin.pages.influencers',compact('categories'));
        }
             
    }
    
    public function approvedinfluencers(Request $request)
    {
        if(Auth::User()->usertype!="Admin")
        {
            \Session::flash('flash_message', 'Access denied!');
            return redirect()->back();
        }   
        
        if($request->cat)
        {
            $influencers = DB::table('influencers')->where('category', $request->cat)->where('status','approved')->orderBy('followers','desc')->get();

            $categories = InfluencerCat::all();
            
            $category = $request->cat;
            
            return view('admin.pages.approvedinfluencers',compact('influencers','categories','category'));
        }
        else
        {
            $categories = InfluencerCat::all();
            
            return view('admin.pages.approvedinfluencers',compact('categories'));
        }
             
    }
    
    
    public function influencer_approve(Request $request)
    {
        if(Auth::User()->usertype!="Admin")
        {
            \Session::flash('flash_message', 'Access denied!');
            return redirect()->back();
        }   
        
         
            $influencer_status = Influencers::where('id', $request->id)->firstOrFail();
            
            $influencer_status->status = 'approved';
            $influencer_status->save();
             
            
            \Session::flash('flash_message', 'Influencer Approved');
            return redirect()->back();
    }
    
    public function influencer_pending(Request $request)
    {
        if(Auth::User()->usertype!="Admin")
        {
            \Session::flash('flash_message', 'Access denied!');
            return redirect()->back();
        }   
        
         
            $influencer_status = Influencers::where('id', $request->id)->firstOrFail();
            
            $influencer_status->status = 'pending';
            $influencer_status->save();
             
            
            \Session::flash('flash_message', 'Influencer Pending');
            return redirect()->back();
    }
    
    public function influencer_delete(Request $request)
    {
        if(Auth::User()->usertype!="Admin")
        {
            \Session::flash('flash_message', 'Access denied!');
            return redirect()->back();
        }   
        
            Influencers::where('id', $request->id)->delete();
            
            \Session::flash('flash_message', 'Influencer Removed');
            return redirect()->back();
    }
    
    public function influencerscat(Request $request)
    {
        if(Auth::User()->usertype!="Admin")
        {
            \Session::flash('flash_message', 'Access denied!');
            return redirect()->back();
        }   
            $categories = InfluencerCat::all();
            
            return view('admin.pages.all_influencer_cat',compact('categories'));
    }
    
    public function influencer_cat(Request $request)
    {
        if(Auth::User()->usertype!="Admin")
        {
            \Session::flash('flash_message', 'Access denied!');
            return redirect()->back();
        }   
            if($request->id)
            {
                $influencer_cat = InfluencerCat::where('id', $request->id)->get();
                
                return view('admin.pages.add_edit_influencer_cat', compact('influencer_cat'));
            }
            else
            {
                return view('admin.pages.add_edit_influencer_cat');
            }
            
            
    }
    
    public function add_edit_influencer_cat(Request $request)
    {
        if(Auth::User()->usertype!="Admin")
        {
            \Session::flash('flash_message', 'Access denied!');
            return redirect()->back();
        }   
            
            if($request->cat_id)
            {
                $add_edit_influencer_cat = InfluencerCat::where('id', $request->cat_id)->firstOrFail();
            }
            else
            {
                $add_edit_influencer_cat = new InfluencerCat;
            }
            
            $add_edit_influencer_cat->name = $request->category_name;
            $add_edit_influencer_cat->save();
            
            \Session::flash('flash_message', 'Category Saved');
            return redirect()->back();
    }
    
    public function influencer_cat_delete(Request $request)
    {
        if(Auth::User()->usertype!="Admin")
        {
            \Session::flash('flash_message', 'Access denied!');
            return redirect()->back();
        }   
            
            InfluencerCat::where('id', $request->id)->delete();

            \Session::flash('flash_message', 'Category Removed');
            return redirect()->back();
    }
    
    public function newsletter(Request $request)
    {
        return view('admin.pages.newsletter');
    }
        
        
    public function newsletter_send(Request $request)
    {
        if($request->all)
        {
            $all_to = User::where('usertype','User')->where('status','approved')->orderBy('id')->get();
            foreach($all_to as $all)
            {
                $URI = 'Scholera';
                $emailt = getcong('site_email');
                //$to=implode(',',$request['to']);
                $headers = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                $headers .= 'From: '.$URI.' <' . $emailt. ">\r\n"; // Sender's Email
                $headers .= 'BCC: '. $all->email . "\r\n";
                $subject =$request['subject'];
                $array =$request['message'];

                $mailmessage = $array;
                //$msg = wordwrap($mailmessage,500);
                // send email
                mail(null,$subject,$mailmessage,$headers);
            }
            
        }
        else
        {
            $URI = 'Scholera';
            $emailt = getcong('site_email');
            //$to=implode(',',$request['to']);
            $headers = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headers .= 'From: '.$URI.' <' . $emailt. ">\r\n"; // Sender's Email
            $headers .= 'BCC: '. implode(",", $request['to']) . "\r\n";
            $subject =$request['subject'];
            $array =$request['message'];

            $mailmessage = $array;
            //$msg = wordwrap($mailmessage,500);
            // send email
            mail(null,$subject,$mailmessage,$headers);
        }

        
  
        \Session::flash('flash_message', 'Email has sent!');
        return redirect()->back();
    }
}