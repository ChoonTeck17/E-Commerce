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
}

  