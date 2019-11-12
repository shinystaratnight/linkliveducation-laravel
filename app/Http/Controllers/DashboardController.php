<?php
namespace App\Http\Controllers;
use Auth;
use App\User;
use App\Http\Requests;
use Illuminate\Http\Request;


class DashboardController extends Controller
{
   
    public function index()
    { 
    	
        if(Auth::check())	
        {  
            $users = User::where('usertype', 'User')->count();
            return view('pages.dashboard',compact('users'));
	}else{
	    return redirect('/');
	    }
   
    }
		
}
