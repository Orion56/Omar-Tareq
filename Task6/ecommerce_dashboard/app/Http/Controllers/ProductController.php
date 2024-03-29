<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Services\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $products = DB::table('products')->get();
        return view('products\index', compact('products'));
    }

    public function create()
    {
        $brands = DB::table('brands')->select('id', 'name_en')->orderBy('name_en')->get();
        $subcategories = DB::table('subcategories')->select('id', 'name_en')->orderBy('name_en')->get();
        return view('products\create', compact('brands', 'subcategories'));
    }

    public function edit($id)
    {
        $product = DB::table('products')->where('id', $id)->first();
        $brands = DB::table('brands')->select('id', 'name_en')->orderBy('name_en')->get();
        $subcategories = DB::table('subcategories')->select('id', 'name_en')->orderBy('name_en')->get();
        return view('products.edit', compact('product', 'brands', 'subcategories'));
    }

    public function store(Request $request)
    {
        // validation
        $request->validate([
            'name_en' => ['required', 'string', 'max:255'],
            'name_ar' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'between:1,999999.99'],
            'quantity' => ['nullable', 'integer', 'between:1,999'],
            'code' => ['required', 'integer', 'between:1,999999', 'unique:products'],
            'status' => ['required', 'in:0,1'],
            'brand_id' => ['nullable', 'integer', 'exists:brands,id'],
            'subcategory_id' => ['required', 'integer', 'exists:subcategories,id'],
            'details_en' => ['required', 'string'],
            'details_ar' => ['required', 'string'],
            'image' => ['required', 'max:1000', 'mimetypes:image/png,image/jpeg'] // use mimes or mimetypes[may give more restriction on files]
        ]);
        // image upload
        $newImageName = Media::upload($request->file('image'), public_path('images\products'));

        $data = $request->except('image', '_token');
        $data['image'] =   $newImageName;
        if (DB::table('products')->insert($data)) {
            return redirect()->route('dash.products')->with('success', 'Product Created Successfully');
        } else {
            return redirect()->back()->with('error', 'Something Went Wrong');
        }
    }

    public function update(request $request, Product $product)
    {
        //$id=$this->product->id;
        $request->validate([
            'name_en' => ['required', 'string', 'max:255'],
            'name_ar' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'between:1,999999.99'],
            'quantity' => ['nullable', 'integer', 'between:1,999'],
            'code' => ['required', 'integer', 'between:1,999999', 'unique:products,code,' . $id],
            'status' => ['required', 'in:0,1'],
            'brand_id' => ['nullable', 'integer', 'exists:brands,id'],
            'subcategory_id' => ['required', 'integer', 'exists:subcategories,id'],
            'details_en' => ['required', 'string'],
            'details_ar' => ['required', 'string'],
            'image' => ['required', 'max:1000', 'mimetypes:image/png,image/jpeg'] // use mimes or mimetypes[may give more restriction on files]
        ]);
        $data = $request->except('image', '_token', '_method');
        if ($request->hasFile('image')) {
            $newImageName = Media::upload($request->file('image'), public_path('images\products'));
            $data['image'] =   $newImageName;
            Media::delete(public_path("images\products\\{$product->image}"));
        }
        return $this->redirectBack(DB::table('products')->where('id', $product->id)->update($data));
    }
}
