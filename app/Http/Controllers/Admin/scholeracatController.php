<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Categories;
use App\Http\Requests;
use DB;
class scholeracatController extends MainAdminController
{
	public function category()
	{
		
		return view('admin.pages.category');
	}
	
	public function getcategory(Request $request)
	{
		//$data=Categories::orderBy('cat_id')->get();
		//echo 'Cat ID'.$request->cat_id.'<br/>';
		//echo 'Cat Name'.$request->category_name;
		//echo"<pre>";
		//print_r($data);
		//echo"</pre>";
		// Categories::create($request->all());
		
		$this->validate($request,[
		
		'category_name'=>'required'
		],[
		'category_name.required'=>'Please fill the category'
		
		]);
		
		 Categories::create($request->all());
		 return redirect()->back()->with('message', 'insert successfully ! !');
		
	}
	
	
	
}
