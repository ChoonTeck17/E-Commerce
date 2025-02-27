<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Intervention\Image\Laravel\Facades\Image;
use App\Models\Category; // Ensure this line is present
use App\Models\Product; // Ensure this line is present

// use Illuminate\Support\Facades\Str;
// use Intervention\Image\Facades\Image;

// use Faker\Core\File;



class AdminController extends Controller
{
    public function index()
    {
        return view(view: 'admin.index');
    }

    public function brands(){
        $brands = Brand::orderBy('id','desc')->paginate(10);    
        return view('admin.brands', compact('brands'));
    }

    public function add_brand(){
        return view('admin.add_brand');
    }

    public function store_brand(request $request){
        $request->validate([
            'name'=> 'required',
            'slug'=> 'required|unique:brands,slug',
            'image'=> 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
        ]);

        $brand = new Brand();
        // $brand = Brand::findOrNew($request->id);
        $brand->name = $request->name;
        $brand->slug = Str::slug($request->name);
        $image = $request->file('image');
        $file_extension = $request->file('image')->extension();
        $file_name = Carbon::now()->timestamp.'.'.$file_extension;
        $this->GenerateThumbnail($image, $file_name);
        $brand->image = $file_name;
        $brand->save();

        return redirect()->route('admin.brands')->with('status','Brand added successfully!');
    }



    public function edit_brand($id){
        $brand = Brand::find($id);
        return view('admin.edit_brand', compact('brand'));
    }

    public function update_brand(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:brands,slug,'.$request->id,
            'image' => 'mimes:png,jpg,jpeg|max:2048'
        ]);
        $brand = Brand::find($request->id);
        $brand->name = $request->name;
        $brand->slug = $request->slug;
        if($request->hasFile('image'))
        {            
            if (File::exists(public_path('uploads/brands').'/'.$brand->image)) {
                File::delete(public_path('uploads/brands').'/'.$brand->image);
            }
            $image = $request->file('image');
            $file_extention = $request->file('image')->extension();
            $file_name = Carbon::now()->timestamp . '.' . $file_extention;
            $this->GenerateThumbnail($image,$file_name);
            $brand->image = $file_name;
        }        
        $brand->save();        
        return redirect()->route('admin.brands')->with('status','Record has been updated successfully !');
    }

    public function GenerateThumbnail($image, $imageName)
    {
        $destinationPath = public_path('/uploads/brands');
        $img = Image::read($image->path());
        $img->cover(124,124,"top");
        // $img->resize(124, 124, function ($constraint) {
        //     $constraint->aspectRatio();
        $img->save($destinationPath . '/' . $imageName);
    }

    public function delete_brand($id)
    {
        $brand = Brand::find($id);
        if (File::exists(public_path('uploads/brands') . '/' . $brand->image)) {
            File::delete(public_path('uploads/brands') . '/' . $brand->image);
        }
        $brand->delete();
        return redirect()->route('admin.brands')->with('status', 'This brand has been deleted successfully !');
    }

    public function categories(){
        $categories = Category::orderBy('id','desc')->paginate(10);
        return view('admin.categories', compact('categories'));
    }
    
    public function add_category(){
        return view('admin.add_category');
    }

    public function store_category(request $request){
        $request->validate([
            'name'=> 'required',
            'slug'=> 'required|unique:brands,slug',
            'image'=> 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
        ]);
        $category = new Category();
        // $category =$category::findOrNew($request->id);
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $image = $request->file('image');
        $file_extension = $request->file('image')->extension();
        $file_name = Carbon::now()->timestamp.'.'.$file_extension;
        $this->GenerateCategoryThumbnail($image, $file_name);
        $category->image = $file_name;
        $category->save();

        return redirect()->route('admin.categories')->with('status','Category added successfully!');
    }

    public function GenerateCategoryThumbnail($image, $imageName)
    {
        $destinationPath = public_path('/uploads/categories');
        $img = Image::read($image->path());
        $img->cover(124,124,"top");
        // $img->resize(124, 124, function ($constraint) {
        //     $constraint->aspectRatio();
        $img->save($destinationPath . '/' . $imageName);
    }
    
    public function edit_category($id){
        $category = Category::find($id);
        // dd ($category);
        return view('admin.edit_category', compact('category'));
    }

    public function update_category(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:categories,slug,'.$request->id,
            'image' => 'mimes:png,jpg,jpeg|max:2048'
        ]);
        $category = Category::find($request->id);
        $category->name = $request->name;
        $category->slug = $request->slug;
        if($request->hasFile('image'))
        {            
            if (File::exists(public_path('uploads/categories').'/'.$category->image)) {
                File::delete(public_path('uploads/categories').'/'.$category->image);
            }
            $image = $request->file('image');
            $file_extention = $request->file('image')->extension();
            $file_name = Carbon::now()->timestamp . '.' . $file_extention;
            $this->GenerateCategoryThumbnail($image,$file_name);
            $category->image = $file_name;
        }        
        $category->save();        
        return redirect()->route('admin.categories')->with('status','Record has been updated successfully !');
    }

    public function delete_category($id)
    {
        $category = Category::find($id);
        if (File::exists(public_path('uploads/categories') . '/' . $category->image)) {
            File::delete(public_path('uploads/categories') . '/' . $category->image);
        }
        $category->delete();
        return redirect()->route('admin.categories')->with('status', 'This category has been deleted successfully !');
    }

    public function products(){
        $products = Product::orderBy('id','desc')->paginate(10);
        return view('admin.products', compact('products'));
    }

    public function add_product(){
        $categories = Category::select('id','name')->orderBy('name','asc')->get();
        $brands = Brand::select('id','name')->orderBy('name','asc')->get();
        return view('admin.add_product', compact('categories','brands'));
    }

    public function store_product(request $request){
        $request->validate([
            'name'=> 'required',
            'slug'=> 'required|unique:products,slug',
            'description'=> 'required',
            'normal_price'=> 'required|numeric',
            'sale_price'=> 'nullable|numeric',
            'SKU'=> 'required',
            'stock_status'=> 'required',
            'quantity'=> 'required|numeric',
            'image'=> 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'category_id'=> 'required',
            'brand_id'=> 'required',
        ]);
        $product = new Product();
        // $product = Product::findOrNew($request->id);
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->description = $request->description;
        $product->normal_price = $request->normal_price;
        $product->sale_price = $request->sale_price;
        $product->SKU = $request->SKU;
        $product->stock_status = $request->stock_status;
        $product->quantity = $request->quantity;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;

        $current_timestamp = Carbon::now()->timestamp();

        if($request->hasFile('image'))
        {            
            $image = $request->file('image');
            $imageName = $current_timestamp.'.'.$image->extension();
            $this->generateProductThumbnailImage($image, $imageName);
            $product->image =$imageName;

            $gallery_arr = array();
            $gallery_images = "";
            $counter =1;

            if($request->hasFile('images')){
                $allowedFileExtion ='jpg,jpeg,png';
                $files = $request->file('images');
                foreach($files as $file){
                    $gextension = $file->getClientOriginalExtension();
                    $gcheck = in_array($gextension, $allowedFileExtion);
                    if($gcheck){
                        $gfilename = $current_timestamp.'_'.$counter.'.'.$gextension();
                        $this->generateProductThumbnailImage($file, $gfilename);
                        array_push($gallery_arr, $gfilename);
                        $counter= $counter+1;
                    }
                }
                $gallery_images = implode(',',$gallery_arr);
            }
            $product->images = $gallery_images;
            $product->save();
            return redirect()->route('admin.products')->with('status','Product added successfully!');
        }
    }

    public function generateProductThumbnailImage($image, $imageName){
        $destinationPathThumbnail = public_path('/uploads/products/thumbnail');
        $destinationPath = public_path('/uploads/products');
        $img = Image::read($image->path());
        $img->cover(124,124,"top");
        $img->resize(540,689, function($constraint){
            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$imageName);

        $img->resize(104,104, function($constraint){
            $constraint->aspectRatio();
        })->save($destinationPathThumbnail.'/'.$imageName);

    }
}

  