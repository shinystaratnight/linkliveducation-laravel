<?php
namespace App\Http\Controllers\Admin;
use Auth;
use App\Product;
use App\Categories;
use App\SubCategories;
use App\ListingGallery;
use App\Http\Requests;
use Illuminate\Http\Request;
use Session;
use Intervention\Image\Facades\Image; 
use Illuminate\Support\Facades\DB;
class ProductController extends MainAdminController
{
	public function __construct()
    {
		 $this->middleware('auth');
		  
		parent::__construct(); 	
		  
    }
        public function subcate_featured_listing($listing_id,$status)
    {
        if(Auth::User()->usertype=="Admin")
        {
            
            $product= Product::findOrFail($listing_id);
 
            
            $product->featured_products = $status;
			$product->save();
            \Session::flash('flash_message', 'Save changed');

            return redirect()->back();
        }
        else
        {
            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');
             
        }
    }
	
	 public function top_offers($listing_id,$status)
    {


        if(Auth::User()->usertype=="Admin")
        {
            
            $product= Product::findOrFail($listing_id);
 
            
            $product->top_offers = $status;
			$product->save();
            \Session::flash('flash_message', 'Save changed');

            return redirect()->back();
        }
        else
        {
            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');
             
        }
    }
	
	 public function new_arrivals($listing_id,$status)
    {


        if(Auth::User()->usertype=="Admin")
        {
            
            $product= Product::findOrFail($listing_id);
 
            
            $product->new_arrivals = $status;
			$product->save();
            \Session::flash('flash_message', 'Save changed');

            return redirect()->back();
        }
        else
        {
            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');
             
        }
    }
	
	 public function recommended_products($listing_id,$status)
    {


        if(Auth::User()->usertype=="Admin")
        {
            
            $product= Product::findOrFail($listing_id);
 
            
            $product->recommended_products 	 = $status;
			$product->save();
            \Session::flash('flash_message', 'Save changed');

            return redirect()->back();
        }
        else
        {
            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');
             
        }
    }
    public function product()    { 
        
              
        $subcategories = Product::orderBy('id')->get();

       
        
        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');
            
        }
         
        return view('admin.pages.product',compact('subcategories'));
    }

    public function addeditproduct()    { 
         
        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');
            
        }
        $categories = SubCategories::get();
      
        return view('admin.pages.addeditproduct',compact('categories'));
    }
    
    public function addnew(Request $request)
    {  
    	
    	$data =  \Input::except(array('_token')) ;
	    
	    $rule=array(
		        'product_name' => 'required',
                        'category'=> 'required',
                        'MRP'=> 'required',
                        'Manufacturing_Price'=> 'required'
		   		 );
	    
	   	 $validator = \Validator::make($data,$rule);
 
        if ($validator->fails())
        {
                return redirect()->back()->withErrors($validator->messages());
        } 
	    $inputs = $request->all();
		//echo "<pre>" ;
		//print_r($inputs); die;
        
		if(!empty($inputs['id'])){
           
            $subcat_obj = product::findOrFail($inputs['id']);

        }else{

            $subcat_obj = new Product;
		
        }
		
		$listing_slug = str_slug($inputs['product_name'], "-");
		//$subcat_obj->cat_id = $inputs['category']; 
		$subcat_obj->name = $inputs['product_name']; 
		//$subcat_obj->sub_cat_id = $inputs['category'];
		$subcat_obj->description = $inputs['description'];
	        $subcat_obj->distributor = $inputs['distributor'];
		
                ////---------------------new fields-------------------------/////////
                $product_type=$inputs['product_type'];
                if($product_type=='Simple Product'){
                $subcat_obj->product_type= $inputs['product_type'];
                $subcat_obj->detail = $inputs['detail'];
	        $subcat_obj->price =$inputs['Manufacturing_Price'];
		$subcat_obj->discount_price = $inputs['MRP'];
		$subcat_obj->brand = $inputs['brand_name'];
		 if(!empty($inputs['stock'])):
		$subcat_obj->stock = $inputs['stock'];
                 endif;
                $subcat_obj->sku= $inputs['sku'];
                if(!empty($inputs['manage_stock'])):
                $subcat_obj->manage_stock= $inputs['manage_stock'];
                endif;
                $subcat_obj->Quantity= $inputs['Quantity'];
                $subcat_obj->Company_Profit= $inputs['Company_Profit'];
                $subcat_obj->Dealer_Profit= $inputs['Dealer_Profit'];  
                $subcat_obj->register_user_profit= $inputs['register_user_profit'];
                $subcat_obj->for_extra_rewards= $inputs['for_extra_rewards'];
                $subcat_obj->Level_Profit= $inputs['Level_Profit'];         
              
                }
                ///--------------------------------------------------------//////////
		$image = $request->file('image');
		if($image)
			{
		  \File::delete(public_path() .'/site_assets/product/'.$subcat_obj->image.'-b.jpg');
		  \File::delete(public_path() .'/site_assets/product/'.$subcat_obj->image.'-s.jpg');
		  $tmpFilePath = 'site_assets/product/';          
		  $hardPath = substr('image',0,100).'_'.time();
		  $img = Image::make($image);
		  //$img->save($tmpFilePath.$hardPath.'-b.jpg');
		  $img->save($tmpFilePath.$hardPath. '-s.jpg');
		  $subcat_obj->image = $hardPath. '-s.jpg';
		  }
	        $subcat_obj->save();
              //News Gallery image
        $listing_gallery_files = $request->file('gallery_file');
        $file_count = count($listing_gallery_files);
        if($request->hasFile('gallery_file'))
        {

            if(!empty($inputs['id']))
            {
                foreach($listing_gallery_files as $file) {
                    $listing_gallery_obj = new ListingGallery;
                    $tmpFilePath = 'upload/gallery/';           
                    $hardPath = substr($listing_slug,0,100).'_'.rand(0,9999).'-b.jpg';
                    $g_img = Image::make($file);
                    $g_img->save($tmpFilePath.$hardPath);
                    $listing_gallery_obj->listing_id = $inputs['id'];
                    $listing_gallery_obj->image_name = $hardPath;
                    $listing_gallery_obj->save();
                }
            }
            else
            {   
                foreach($listing_gallery_files as $file) {
                    
                    $listing_gallery_obj = new ListingGallery;
                    $tmpFilePath = 'upload/gallery/';           
                    $hardPath = substr($listing_slug,0,100).'_'.rand(0,9999).'-b.jpg';
                    $g_img = Image::make($file);
                    $g_img->save($tmpFilePath.$hardPath);
                    $listing_gallery_obj->listing_id = $subcat_obj->id;
                    $listing_gallery_obj->image_name = $hardPath;
                    $listing_gallery_obj->save();
                }
            }
        }
         DB::table('product_categories')->where('product_id',$subcat_obj->id)->delete();
        foreach($inputs['category'] as $cate){
          //  echo $subcat_obj->id;die;
                DB::table('product_categories')->insertGetId(['sub_cat_id' => $cate,'product_id' =>$subcat_obj->id]);
            
        }
	     if(!empty($inputs['id'])){
            \Session::flash('flash_message', 'Changes Saved');
            return \Redirect::back();
        }else{
            \Session::flash('flash_message', 'Added');
            return \Redirect::back();
        }		     
        
         
    }     
    
    public function editproduct($id)    
    {     
    
    	  if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');
            
        }
        
         $categories = DB::table('sub_categories')->get(); 
		$product= DB::table('product')->where('id',$id)->get();
         
           $listing_gallery_images=ListingGallery::where('listing_id',$id)->orderBy('image_name')->get();
          return view('admin.pages.addeditproduct',compact('categories','product','listing_gallery_images'));
        
    }	 
    
    public function delete($id)
    {
    	if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', 'Access denied!');

            return redirect('admin/dashboard');
            
        }
        	
        DB::table('product')->where('id',$id)->delete();

        \Session::flash('flash_message', 'Deleted');

        return redirect()->back();

    }
    public function save_attribuites(Request $request){
       
      $objectcount=count($request->attri_name);
      for($i=0;$i<$objectcount;$i++){
       $request->attri_name[$i];
       $request->attribuite[$i];
       $count=DB::table('attribuites')->where('name',$request->attri_name[$i])->count();
       if($count>0){
        DB::table('attribuites')->where('name',$request->attri_name[$i])->update(['options' =>$request->attribuite[$i]]);
       }else{
         DB::table('attribuites')->insertGetId(['name' =>$request->attri_name[$i],'options' =>$request->attribuite[$i]]);
        }
      }
      die;
  
    }
     public function remove_attribuites($id){
       
      DB::table('product_attribuites')->where('id',$id)->delete();
        \Session::flash('flash_message', 'Attribuites Deleted');

        return redirect()->back();
  
    }
    	
}
