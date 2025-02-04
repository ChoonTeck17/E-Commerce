<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use illuminate\Support\Str;
use Carbon\Carbon;
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
            'slug'=> 'required|unique:brands,slug',
            'image'=> 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $brand = new Brand();
        $brand->name = $request->name;
        $brand->slug = Str::slug($request->name);
        $image = $request->file('image');
        $file_extension = $request->file('image')->extension();
        $file_name = Carbon::now()->timestamp.'.'.$file_extension;
        $this->GeneraraThumbnail($image, $file_name);
        $brand->image = $file_name;
        $brand->save();

        return redirect()->route('admin.brands')->with('status','Brand added successfully!');
    }

    public function GenerateThumbnail($image, $imageName){
        $destinationPath = public_path('/uploads/brands');
        $img = Image::read($image->path);
        $img->cover(124,124,"top");
        $img->(124,124,function($constraint){
        $constraint->aspectRatio();
        })->save($destinationPath.'/'.$imageName);
    }
}

