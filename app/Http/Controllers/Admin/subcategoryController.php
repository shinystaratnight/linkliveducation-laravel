<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\subcategory;
use App\sub_subcategory;
use Redirect;
use Session;
use DB;


class subcategoryController extends Controller
{
    public function subcategory(Request $request)
	{
		$value=DB::table('categories')->get();
		return view('admin.pages.subcategory',compact('value'));
	}
	
	public function getsubcategory(Request $request)
	{
	$user = new subcategory;

    $user->subcategory = Input::get('subcategory_name');
    $user->sub_slug = Input::get('sub_slug');
    $user->cat_id = Input::get('cat_id');
    $user->save();
	Session::flash('msg', 'SubCategory Created Successfully !!');
    return Redirect::back();
	
	}
        
        public function sub_subcategory(Request $request)
	{
		$value=DB::table('categories')->get();
		return view('admin.pages.sub-subcategory',compact('value'));
	}
        
        
        public function get_sub_subcategory(Request $request)
	{
	$user = new sub_subcategory;

        $user->cat_id = $request->cat_id;
        $user->sub_cat_id = $request->sub_cat_id;
        $user->sub_sub_category = $request->sub_sub_category_name;
        $user->save();
        
            Session::flash('msg', 'Sub-SubCategory Created Successfully !!');
        return Redirect::back();
	
	}
        
	
}
