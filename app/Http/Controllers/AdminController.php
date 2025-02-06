<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Support\Str;
use Carbon\Carbon;
// use Faker\Core\File;
use Illuminate\Support\Facades\File;
use Intervention\Image\Laravel\Facades\Image;
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
            'slug'=> 'required|unique:brands,slug,'.$request->id,
            'image'=> 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
        ]);

        // $brand = new Brand();
        $brand = Brand::find($request->id);
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

    public function GenerateThumbnail($image, $imageName){
        $destinationPath = public_path('/uploads/brands');
        $img = Image::read($image->path());
        $img->cover(124,124,"top");
        // $img->resize(124, 124, function ($constraint) {
        //     $constraint->aspectRatio();
        $img->save($destinationPath . '/' . $imageName);
    }

    public function edit_brand($id){
        $brand = Brand::find($id);
        return view('admin.edit_brand', compact('brand'));
    }

    public function update_brand(Request $request){
        $request->validate([
            'name'=> 'required',
            'slug'=> 'required|unique:brands,slug',
            'image'=> 'mimes:jpeg,png,jpg,gif,svg|max:5120',
        ]);

        $brand = Brand::find($request->id);
        $brand->name = $request->name;
        $brand->slug = Str::slug($request->name);
        if($request->hasFile('image')){
            if(File::exists(public_path('uploads/brands/'.$brand->image)))
            {
                File::delete(public_path('uploads/brands/'.$brand->image));
            }
            $image = $request->file('image');
            $file_extension = $request->file('image')->extension();
            $file_name = Carbon::now()->timestamp.'.'.$file_extension;
            $this->GenerateThumbnail($image, $file_name);
            $brand->image = $file_name;
         }
        
        $brand->save();
        return redirect()->route('admin.brands')->with('status','brand edited successfully!'); 

    }
}

