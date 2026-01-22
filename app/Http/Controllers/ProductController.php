<?php

namespace App\Http\Controllers;

use App\Models\ProductComperison;
use App\Models\Tag;
use App\Models\Size;
use App\Models\Unit;
use App\Models\User;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductTag;
use App\Models\ProductSize;
use App\Models\SubCategory;
use App\Models\ProductColor;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Models\SubSubCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{

    private $product,$subCategories;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(!userCan('products.index'),403);
        // ini_set('max_file_uploads','50');
        // $max_file_uploads = ini_get('max_file_uploads');
    
        // // Output the current value
        // dd( "Current max_file_uploads is: " . $max_file_uploads);
    
        
        if (Auth::user()->role == 'Admin') {
            $products = Product::latest()->get();
        } elseif (Auth::user()->role == 'Merchant') {
            $products = Product::where('merchant_id', Auth::user()->id)->latest()->get();
        }
        return view('admin.product.index',[
            'products'=>$products,
            'categories'=>Category::where('status',1)->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(!userCan('products.create'),403);
        return view('admin.product.create',[
            'categories'=>Category::where('status',1)->get(),
            'SubCategories'=>SubCategory::where('status',1)->get(),
            'brands'=>Brand::where('status',1)->get(),
            'units'=>Unit::where('status',1)->get(),
            'colors'=>Color::where('status',1)->get(),
            'sizes'=>Size::where('status',1)->get(),
            'tags'=>Tag::where('status',1)->get(),
            'SubSubcategories'=>SubSubCategory::where('status',1)->get(),
            'merchants'=>User::where('role','Merchant')->where('status',1)->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request->all();
        // dd($request->all());
        abort_if(!userCan('products.create'),403);
        $request->validate([
            'merchant_id'=>'required',
            'category_id'=>'required',
            'sub_category_id'=>'required',
            'sub_subcategory_id'=>'required',
            'brand_id'=>'required',
            'unit_id'=>'required',
            'size'=>'required',
            'color'=>'required',
            'name'=>'required',
            'code'=>'required',
            'type'=>'required',
            'short_description'=>'required',
            'long_description'=>'required',
            'regular_price'=>'required',
            'stock_amount'=>'required',
            'tag'=>'required',

            'image' => ['required', 'image','mimes:jpeg,png,jpg,gif','max:2048', // Max file size 2MB
                function ($attribute, $value, $fail) {
                    if ($value) {
                        // Validate file size
                        if ($value->getSize() > 2 * 1024 * 1024) { // 2MB in bytes
                            $fail('The ' . $attribute . ' must not exceed 2MB in size.');
                        }
                        // Validate dimensions
                        $image = getimagesize($value);
                        if ($image) {
                            $width = $image[0];
                            $height = $image[1];
                            if ($width != 300 || $height != 300) {
                                $fail('The ' . $attribute . ' must be exactly 300x300 pixels.');
                            }
                        } else {
                            $fail('The uploaded file is not a valid image.');
                        }
                    }
                },
            ],
            'other_image' => ['required', 'array'],
            'other_image.*' => [
                'image',
                'mimes:jpeg,png,jpg,gif',
                'max:2048', // Maximum size in KB (2MB)
                function ($attribute, $value, $fail) {
                    if ($value) {
                        $image = getimagesize($value);
                        if ($image[0] > 500 || $image[1] > 500) {
                            $fail('Each image must not exceed 500x500 pixels.');
                        }
                    }
                },
            ],

        ],[
            'merchant_id.required'=>'Merchant Name is required',
            'category_id.required'=>'Category is required',
            'sub_category_id.required'=>'Subcategory is required',
            'sub_subcategory_id.required'=>'Sub sub-category is required',
            'brand_id.required'=>'Brand is required',
            'unit_id.required'=>'Unit is required',
            'color.required'=>'Color is required',
            'size.required'=>'Size is required',
            'tag.required'=>'Tag is required',
            'name.required'=>'Product name is required',
            'code.required'=>'Code is required',
            'type.required'=>'Type  is required',
            'regular_price.required'=>'Regular price  is required',
            'stock_amount.required'=>'Stock amount  is required',
            'short_description.required'=>'Short description  is required',
            'long_description.required'=>'Long description  is required',
        ]
    );

        $this->product = Product::newProduct($request);
        ProductColor::newProductColor($request->color , $this->product->id);
        ProductSize::newProductSize($request->size, $this->product->id);
        ProductImage::newProductImage($request->other_image,$this->product->id);
        ProductTag::newProductTag($request->tag, $this->product->id);
        $key_names = $request->key_name;
        if (is_array($key_names)) {
            $length = count($key_names);
            if($length > 0 ){
                ProductComperison::newproductComperison($request, $this->product->id);
            }
        }else{
            $length = 0;
        }

        Session::flash('success','Product added successfully');
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        abort_if(!userCan('products.show'),403);
        return view('admin.product.show',[
            'product' => $product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        abort_if(!userCan('products.edit'),403);
        return view('admin.product.edit',[
            'product'=>Product::find($id),
            'categories'=>Category::where('status',1)->get(),
            'SubCategories'=>SubCategory::where('status',1)->get(),
            'brands'=>Brand::where('status',1)->get(),
            'units'=>Unit::where('status',1)->get(),
            'colors'=>Color::where('status',1)->get(),
            'sizes'=>Size::where('status',1)->get(),
            'tags'=>Tag::where('status',1)->get(),
            'productCompare'=>ProductComperison::where('status',1)->get(),
            'SubSubcategories'=>SubSubCategory::where('status',1)->get(),
            'merchants'=>User::where('role','Merchant')->where('status',1)->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,product $product)
    {
        $request->validate([
            'merchant_id'=>'required',
            'category_id'=>'required',
            'sub_category_id'=>'required',
            'sub_subcategory_id'=>'required',
            'brand_id'=>'required',
            'unit_id'=>'required',
            'size'=>'required',
            'color'=>'required',
            'name'=>'required',
            'code'=>'required',
            'type'=>'required',
            'short_description'=>'required',
            'long_description'=>'required',
            'regular_price'=>'required',
            'stock_amount'=>'required',
            'tag'=>'required',
            'image' => ['nullable', 'image','mimes:jpeg,png,jpg,gif','max:2048', // Max file size 2MB
                function ($attribute, $value, $fail) {
                    if ($value) {
                        // Validate file size
                        if ($value->getSize() > 2 * 1024 * 1024) { // 2MB in bytes
                            $fail('The ' . $attribute . ' must not exceed 2MB in size.');
                        }
                        // Validate dimensions
                        $image = getimagesize($value);
                        if ($image) {
                            $width = $image[0];
                            $height = $image[1];
                            if ($width != 300 || $height != 300) {
                                $fail('The ' . $attribute . ' must be exactly 300x300 pixels.');
                            }
                        } else {
                            $fail('The uploaded file is not a valid image.');
                        }
                    }
                },
            ],
            'other_image' => ['nullable', 'array'],
            'other_image.*' => [
                'image',
                'mimes:jpeg,png,jpg,gif',
                'max:2048', // Maximum size in KB (2MB)
                function ($attribute, $value, $fail) {
                    if ($value) {
                        $image = getimagesize($value);
                        if ($image[0] > 500 || $image[1] > 500) {
                            $fail('Each image must not exceed 500x500 pixels.');
                        }
                    }
                },
            ],
    ],[
        'merchant_id.required'=>'Merchant Name is required',
        'category_id.required'=>'Category is required',
        'sub_category_id.required'=>'Subcategory is required',
        'sub_subcategory_id.required'=>'Sub sub-category is required',
        'brand_id.required'=>'Brand is required',
        'unit_id.required'=>'Unit is required',
        'color.required'=>'Color is required',
        'size.required'=>'Size is required',
        'tag.required'=>'Tag is required',
        'name.required'=>'Product name is required',
        'code.required'=>'Code is required',
        'type.required'=>'Type  is required',
        'regular_price.required'=>'Regular price  is required',
        'stock_amount.required'=>'Stock amount  is required',
        'short_description.required'=>'Short description  is required',
        'long_description.required'=>'Long description  is required',
    ]
    );
        abort_if(!userCan('products.edit'),403);
        Product::updateProduct($request,$product);
        ProductColor::updateProductColor($request->color,$product->id);
        ProductSize::updateProductSize($request->size,$product->id);
        ProductTag::updateProductTag($request->tag,$product->id);
        if ($request->other_image){
            ProductImage::updateProductImage($request->other_image,$product->id);
        }
        $key_names = $request->key_name;
        if (is_array($key_names)) {
            $length = count($key_names);
            if($length > 0 ){
                ProductComperison::updateProductComperison($request, $product->id);
            }
        }else{
            $length = 0;
        }
        Session::flash('success','Product info Updated Successfully');
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        abort_if(!userCan('products.destroy'),403);
        Product::deleteProduct($product);
        return back()->with('success', 'Delete Product Successfully');
    }

    public function productStatus($id){
        abort_if(!userCan('products.edit'),403);
        Product::checkStatus($id);
        return back()->with('message','Status is updated');
    }

    //Nayem Start
    public function getColors($categoryId)
    {
        $colors = Color::where('category_id', $categoryId)->get();

        return response()->json([
            'colors' => $colors,
        ]);
    }

    public function sortByCategory(Request $request)
    {
        // $categoryId = $request->get('category_id');

        // if ($categoryId === 'allCategory') {
        //     $products = Product::with('category')->get();
        // } else {
        //     $products = Product::with('category')
        //         ->where('category_id', $categoryId)
        //         ->get();
        // }

        // return response()->json([
        //     'products' => $products,
        // ]);

         // Retrieve the category ID from the request

    $categoryId = $request->input('category_id');

    // Retrieve the authenticated user
    $user = Auth::user();

    if ($user->role === 'Admin') {
        if ($categoryId === 'allCategory') {
            $products = Product::with('category')->get();
        } else {
            $products = Product::with('category')
                ->where('category_id', $categoryId)
                ->get();
        }
    } elseif ($user->role === 'Merchant') {
        if ($categoryId === 'allCategory') {
            $products = Product::with('category')
                ->where('merchant_id', $user->id)
                ->get();
        } else {
            $products = Product::with('category')
                ->where('merchant_id', $user->id)
                ->where('category_id', $categoryId)
                ->get();
        }
    } else {
        // If the role is neither Admin nor Merchant, deny access
        return response()->json([
            'message' => 'Unauthorized access.',
        ], 403);
    }

    // Return the filtered products as JSON
    return response()->json([
        'products' => $products,
    ]);
    }

    public function productCompareEdit($id){
         return response()->json([
             'productCompare'=>ProductComperison::where('product_id',$id)->get()
         ]);
    }


    //Nayem End

}