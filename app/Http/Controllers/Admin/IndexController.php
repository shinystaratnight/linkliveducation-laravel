<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Http\Requests;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image; 
use Illuminate\Support\Facades\DB;

class IndexController extends MainAdminController
{
	
    public function index()
    {   
    	if (Auth::check()) {
                        
            return redirect('admin/dashboard'); 
        }
 
        return view('admin.index');
    }
	
	/**
     * Do user login
     * @return $this|\Illuminate\Http\RedirectResponse
     */
	 
    public function postLogin(Request $request)
    {
    	
    //echo bcrypt('123456');n
    //exit;	
    	
      $this->validate($request, [
            'email' => 'required|email', 'password' => 'required',
        ]);


        $credentials = $request->only('email', 'password');

		 
		
         if (Auth::attempt($credentials, $request->has('remember'))) {

            if(Auth::user()->usertype=='banned'){
                \Auth::logout();
                return array("errors" => 'You account has been banned!');
            }

            return $this->handleUserWasAuthenticated($request);
        }

       // return array("errors" => 'The email or the password is invalid. Please try again.');
        //return redirect('/admin');
       return redirect('/admin')->withErrors('The email or the password is invalid. Please try again.');
        
    }
    
     /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  bool  $throttles
     * @return \Illuminate\Http\Response
     */
    protected function handleUserWasAuthenticated(Request $request)
    {

        if (method_exists($this, 'authenticated')) {
            return $this->authenticated($request, Auth::user());
        }

        return redirect('admin/dashboard'); 
    }
    
    
    /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        Auth::logout();

        return redirect('admin/');
    }
    	
        public function  company_reports(){
                
            if (Auth::check()) {
                return view('admin.pages.company_report');
            }else{
                return redirect('/login'); 
            }
 
        }
		
	 public function upload_files()
        {
          
          if(Auth::check()){
            return view('admin.pages.upload_file');
               }else 
                {
                   return redirect('/login');
                }
               
        
        }
		public function files_list()
        {
          
          if(Auth::check()){
            return view('admin.pages.uploaded_files_list');
               }else 
                {
                   return redirect('/login');
                }
               
        
        }
		
		public function delete_file(Request $request)
        {
          
          if(Auth::check()){
			
			
			DB::table('file_uploads')->where('id', $request->id)->delete();
             \Session::flash('flash_message', 'successfully deleted');
			 
			 return redirect()->back();
			 

               }else 
                {
                   return redirect('/login');
                }
               
        
        }
		
	 public function post_files(Request $request)
        {
          
          if(Auth::check()){
			  
			 $fileUpload = $request->file('file');
         
        if($fileUpload){
			$extentions= $request->file('file')->getClientOriginalExtension();
			if($extentions=='jpg'||$extentions=='png'||$extentions=='pdf'||$extentions=='doc'||$extentions=='csv'||$extentions=='ppt'||$extentions=='docx'||$extentions=='mp4'||$extentions=='mp3'||$extentions=='3gp')
			{
				
			
     $filename = $fileUpload->getClientOriginalName();
			//$request->file('file')->getClientOriginalExtension();

    $request->file('file')->move( base_path() . '/public/upload/files/', $filename);
	
	DB::table('file_uploads')->insert(
    ['file_name' =>$request['file_name'],'extention'=>$extentions,'file_link'=>'upload/files/'.$filename]
);
	\Session::flash('flash_message', 'successfully uploaded file');
	return redirect()->back();
			}
			else {
				\Session::flash('flash_message', 'please select valid extention');

            return redirect()->back();
			}
             
        }
               }else 
                {
                   return redirect('/login');
                }
               
        
        }
		
		public function mining_calculater(Request $request)
        {
          
          if(Auth::check()){
			  $inputs = $request->all();
			  DB::table('mining_calculater')->where('id' ,$request->id)->update(['type' =>$request['type'],'weekly_persent' =>$request['weekly_persent'] ,'daily_variation_from' =>$request['daily_variation_from'] , 'daily_variation_to' =>$request['daily_variation_to'], 'daily_variation' =>$request['daily_variation']  ]);
          
		
			return redirect()->back();
               }else 
                {
                   return redirect('/login');
                }
               
        
        }

}
