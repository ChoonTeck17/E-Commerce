<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Laravel\Facades\Image;
use App\Models\Category; // Ensure this line is present
use App\Models\Product; // Ensure this line is present
use App\Models\Coupon; // Ensure this line is present

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


    public function store_product(Request $request)
    {
        // \Log::info('Request data:', $request->all());
        // \Log::info('Files:', $request->files->all());
    
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:products,slug',
            'description' => 'required',
            'normal_price' => 'required|numeric',
            'sale_price' => 'nullable|numeric',
            'SKU' => 'required',
            'stock_status' => 'required',
            'quantity' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
            'category_id' => 'required',
            'brand_id' => 'required',
        ]);
    
        $product = new Product();
        $product->name = $request->name;
        $product->slug = Str::slug($request->slug);
        $product->description = $request->description;
        $product->normal_price = $request->normal_price;
        $product->sale_price = $request->sale_price;
        $product->SKU = $request->SKU;
        $product->stock_status = $request->stock_status;
        $product->featured = $request->featured ?? 0;
        $product->quantity = $request->quantity;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
    
        $current_timestamp = Carbon::now()->timestamp;
    
        // Handle primary image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            if (!$image->isValid()) {
                return back()->withErrors(['image' => 'Invalid primary image']);
            }
            $imageName = $current_timestamp . '.' . $image->extension();
            try {
                $this->generateProductThumbnailImage($image, $imageName); // No move needed here
                $product->image = $imageName;
            } catch (\Exception $e) {
                return back()->withErrors(['image' => $e->getMessage()]);
            }
        }
    
        // Handle gallery images
        $gallery_arr = [];
        if ($request->hasFile('images')) {
            $allowedFileExtensions = ['jpg', 'jpeg', 'png', 'webp'];
            $files = $request->file('images');
            $counter = 1;
    
            foreach ($files as $file) {
                if (!$file->isValid()) {
                    // Log::warning('Skipping invalid gallery image: ' . $file->getClientOriginalName());
                    continue;
                }
                $gextension = $file->getClientOriginalExtension();
                if (in_array($gextension, $allowedFileExtensions)) {
                    $gfilename = $current_timestamp . '_' . $counter . '.' . $gextension;
                    try {
                        $this->generateProductThumbnailImage($file, $gfilename);
                        $gallery_arr[] = $gfilename;
                        $counter++;
                    } catch (\Exception $e) {
                        // Log::warning('Gallery image skipped: ' . $e->getMessage());
                        continue; // Skip failing images
                    }
                }
            }
            $product->images = implode(',', $gallery_arr);
        }
    
        $product->save();
        return redirect()->route('admin.products')->with('status', 'Product added successfully!');
    }

    public function generateProductThumbnailImage($image, $imageName)
    {
        $destinationPath = public_path('uploads/products');
        $destinationPathThumbnail = public_path('uploads/products/thumbnail');
    
        // Verify the file exists and is readable
        $realPath = $image->getRealPath();
        if (!file_exists($realPath) || !is_readable($realPath)) {
            throw new \Exception('Image file is missing or unreadable: ' . $realPath);
        }
    
        try {
            // Load the image once
            $img = Image::read($realPath);
    
            // Save original resized image (540x689, maintaining aspect ratio)
            $img->scale(540, 689)->save($destinationPath . '/' . $imageName);
    
            // Create and save thumbnail (124x124, cropped)
            $img->cover(124, 124)->save($destinationPathThumbnail . '/' . $imageName);
        } catch (\Exception $e) {
            // Log::error('Thumbnail generation failed for ' . $imageName . ': ' . $e->getMessage());
            throw new \Exception('Unable to process image: ' . $e->getMessage());
        }
    }

    public function edit_product($id){
        $product = product::find($id);
        $categories = Category::select('id','name')->orderBy('name')->get();
        $brands = Brand::select('id','name')->orderBy('name')->get();
        return view('admin.edit_product', compact('product','categories','brands'));
    }

    public function update_product(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:products,slug,' . $id,
            // 'short_description' => 'required',
            'description' => 'required',
            'normal_price' => 'required|numeric',
            'sale_price' => 'required|numeric',
            'SKU' => 'required',
            'stock_status' => 'required',
            'featured' => 'required',
            'quantity' => 'required|numeric',
            'image' => 'nullable|mimes:png,jpg,jpeg|max:2048',
            'category_id' => 'required',
            'brand_id' => 'required',
        ]);
    
        $product = Product::find($id);
        if (!$product) {
            return back()->withErrors(['id' => 'Product not found']);
        }
    
        $product->name = $request->name;
        $product->slug = Str::slug($request->slug);
        // $product->short_description = $request->short_description;
        $product->description = $request->description;
        $product->normal_price = $request->normal_price;
        $product->sale_price = $request->sale_price;
        $product->SKU = $request->SKU;
        $product->stock_status = $request->stock_status;
        $product->featured = $request->featured;
        $product->quantity = $request->quantity;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
    
        $current_timestamp = Carbon::now()->timestamp;
    
        if ($request->hasFile('image')) {
            if ($product->image && File::exists(public_path('uploads/products/' . $product->image))) {
                File::delete(public_path('uploads/products/' . $product->image));
            }
            if ($product->image && File::exists(public_path('uploads/products/thumbnail/' . $product->image))) {
                File::delete(public_path('uploads/products/thumbnail/' . $product->image));
            }
            $image = $request->file('image');
            $imageName = $current_timestamp . '.' . $image->extension();
            $this->generateProductThumbnailImage($image, $imageName);
            $product->image = $imageName;
        }
    
        $gallery_arr = [];
        if ($request->hasFile('images')) {
            if ($product->images) {
                foreach (explode(',', $product->images) as $ofile) {
                    if (File::exists(public_path('uploads/products/' . $ofile))) {
                        File::delete(public_path('uploads/products/' . $ofile));
                    }
                    if (File::exists(public_path('uploads/products/thumbnail/' . $ofile))) {
                        File::delete(public_path('uploads/products/thumbnail/' . $ofile));
                    }
                }
            }
            $allowedFileExtensions = ['jpg', 'jpeg', 'png', 'webp'];
            $files = $request->file('images');
            $counter = 1;
            foreach ($files as $file) {
                $gextension = $file->getClientOriginalExtension();
                if (in_array($gextension, $allowedFileExtensions)) {
                    $gfilename = $current_timestamp . '_' . $counter . '.' . $gextension;
                    $this->generateProductThumbnailImage($file, $gfilename);
                    $gallery_arr[] = $gfilename;
                    $counter++;
                }
            }
            $product->images = implode(',', $gallery_arr);
        }
    
        $product->save();
        return redirect()->route('admin.products')->with('status', 'Product has been updated successfully!');
    } 

    public function delete_product($id)
    {
        $product = Product::find($id);
    
        // if (!$product) {
        //     return redirect()->route('admin.products')->with('error', 'Product not found!');
        // }
    
        // Delete main image if it exists
        if ($product->image && File::exists(public_path('uploads/products/' . $product->image))) {
            File::delete(public_path('uploads/products/' . $product->image));
        }
        if ($product->image && File::exists(public_path('uploads/products/thumbnail/' . $product->image))) {
            File::delete(public_path('uploads/products/thumbnail/' . $product->image));
        }
    
        // Delete gallery images if they exist
            foreach (explode(',', $product->images) as $ofile) {
                if (File::exists(public_path('uploads/products/' . $ofile))) {
                    File::delete(public_path('uploads/products/' . $ofile));
                }
                if (File::exists(public_path('uploads/products/thumbnail/' . $ofile))) {
                    File::delete(public_path('uploads/products/thumbnail/' . $ofile));
                }
            }

    
        $product->delete(); // Remove the product from the database
        return redirect()->route('admin.products')->with('status', 'Product has been deleted successfully!');
    }
        
    public function coupons(){
        $coupons = Coupon::orderBy('expiry_date','desc')->paginate(12);
        return view('admin.coupons', compact('coupons'));
    }

    public function add_coupon(){
        return view('admin.add_coupon');
    }

    public function store_coupon(request $request){
        $request->validate([
            'code'=> 'required|unique:coupons,code',
            'type'=> 'required',
            'value'=> 'required|numeric',
            'cart_value'=> 'required|numeric',
            'expiry_date'=> 'required|date',
        ]);
        $coupon = new Coupon();
        $coupon->code = $request->code;
        $coupon->type = $request->type;
        $coupon->value = $request->value;
        $coupon->cart_value = $request->cart_value;
        $coupon->expiry_date = $request->expiry_date;
        $coupon->save();

        return redirect()->route('admin.coupons')->with('status','Coupon added successfully!');
    }

    public function edit_coupon($id){
        $coupon = Coupon::find($id);
        return view('admin.edit_coupon', compact('coupon'));
    }

    public function update_coupon(Request $request, $id)
    {
        $request->validate([
            'code' => 'required|unique:coupons,code,',
            'type' => 'required',
            'value' => 'required|numeric',
            'cart_value' => 'required|numeric',
            'expiry_date' => 'required|date',
        ]);

        $coupon = Coupon::find($request->id);
        $coupon->code = $request->code;
        $coupon->type = $request->type;
        $coupon->value = $request->value;
        $coupon->cart_value = $request->cart_value;
        $coupon->expiry_date = $request->expiry_date;
    
        $coupon->save();
    
        return redirect()->route('admin.coupons')->with('status', 'Coupon has been updated successfully!');
    }

    public function delete_coupon($id)
    {
        $coupon = Coupon::find($id);
        $coupon->delete();
        return redirect()->route('admin.coupons')->with('status', 'Coupon has been deleted successfully!');
    }

}




  