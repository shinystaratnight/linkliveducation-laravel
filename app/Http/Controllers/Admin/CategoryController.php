<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\User;
use App\Categories;
use App\subcategory;
use App\sub_subcategory;
use App\Http\Requests;
use Illuminate\Http\Request;
use Session; 
use Intervention\Image\Facades\Image; 
use Illuminate\Support\Facades\DB;


class CategoryController extends MainAdminController
{
	public function __construct()
    {
		 $this->middleware('auth');
		  
		parent::__construct(); 	
		  
    }
    public function categories()    { 
        $value=DB::table('category')->get();
              return view('admin.pages.categories',compact('value'));
			  
            
        }
		
		public function add_categories(Request $request)
		{
			$inputs = $request->all();
			
			$categories = new Categories;
        
		
		$categories->cat_parent=$inputs['cat_parent'];
        $categories->category_name = $inputs['category_name'];    
        $categories->category_slug = $inputs['category_slug'];    
           
        
        $categories->save();
		return \Redirect::back();


		}
		
		
		public function showcategory()
		{
			$value=DB::table('categories')->orderByRaw('LENGTH(category_name) asc')->orderBy('category_name', 'asc')->get();
			return view('admin.pages.showcategory',compact('value'));
		}
		
                public function showsubcategory()
		{
			$catvalue=DB::table('categories')->orderByRaw('LENGTH(category_name) asc')->orderBy('category_name', 'asc')->get();
			return view('admin.pages.showsubcategory', compact('catvalue'));
		}
                
                public function show_sub_subcategory()
		{
			$catvalue=DB::table('categories')->orderByRaw('LENGTH(category_name) asc')->orderBy('category_name', 'asc')->get();
			return view('admin.pages.show_sub_subcategory', compact('catvalue'));
		}
	
		public function cat_edit(Request $request)
                {
                                       
                    $cat_edit = Categories::where('cat_id', $request->edit_cat_id)->update(['category_name' => $request->category_name,'cat_order' => $request->cat_order]);
                    
                    
                    return redirect()->back()->with('message', 'Category Updated Successfully ! !');
                    
                    
                }
                
                
                public function cat_delete(Request $request)
                {   //For Deleting Users
                    Categories::where('cat_id', $request->cat_id)->delete();
                    
                    return redirect()->back()->with('message', 'Category Successfully Removed ! !');
                }
                
                
                
                public function sub_cat_edit(Request $request)
                {
                                       
                    $cat_edit = subcategory::where('sid', $request->sub_category_id)->update(['subcategory' => $request->sub_category_name]);
                    
                    
                    return redirect()->back()->with('message', 'Sub Category Updated Successfully ! !');
                    
                    
                }
                
                
                public function sub_sub_cat_edit(Request $request)
                {
                                       
                    $sub_sub_cat_edit = sub_subcategory::where('id', $request->sub_sub_category_id)->update(['sub_sub_category' => $request->sub_sub_category_name]);
                    
                    
                    return redirect()->back()->with('message', 'Sub Sub-Category Updated Successfully ! !');
                    
                    
                }
                
                
                public function sub_cat_delete(Request $request)
                {   //For Deleting Users
                    subcategory::where('sid', $request->videosubcategory)->delete();
                    
                    return redirect()->back()->with('message', 'Sub Category Successfully Removed ! !');
                }
                
                public function sub_sub_cat_delete(Request $request)
                {   //For Deleting Users
                    sub_subcategory::where('id', $request->videosub_subcategory)->delete();
                    
                    return redirect()->back()->with('message', 'Sub Sub-Category Successfully Removed ! !');
                }

 
    
}