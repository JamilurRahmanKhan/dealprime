<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'sub_category_id',
        'brand_id',
        'unit_id',
        // Other fillable fields
    ];

    private static $product, $image,$imageName,$extension, $directory,$imageUrl;

    private static function getImageUrl($request)
    {
        self::$image = $request->file('image');
        self::$extension = self::$image->getClientOriginalExtension();
        self::$imageName = time() . '.' . self::$extension;
        self::$directory = "adminAsset/img/product-img/";
        self::$image->move(self::$directory, self::$imageName);
//        self::$imageUrl     = self::$directory.self::$imageName;
        return self::$directory . self::$imageName;
    }

    public static function newProduct($request)
    {
        //ini_set('max_file_uploads','50');
        if ($request->file('image')) {
            self::$imageUrl = self::getImageUrl($request);
        } else {
            self::$imageUrl = 'adminAsset/img/product.png';
        }

        self::$product = new Product();

        self::$product->merchant_id = $request->merchant_id;
        self::$product->category_id = $request->category_id;
        self::$product->sub_category_id = $request->sub_category_id;
        self::$product->sub_subcategory_id = $request->sub_subcategory_id;
        self::$product->brand_id = $request->brand_id;
        self::$product->unit_id = $request->unit_id;
        self::$product->name = $request->name;
        self::$product->code = $request->code;
        self::$product->type = $request->type;

        self::$product->short_description = $request->short_description;
        self::$product->long_description = $request->long_description;

        self::$product->image = self::$imageUrl;

        //Nayem Start
        if($request->image_one){
            // self::$product->image_one = imageUpload($request->image_one, 'adminAsset/img/other/', 'other-img');
            self::$product->image_one =imageUpload($request->file('image_one'), 'adminAsset/img/other/', 'other-img-one');

        }
        if($request->image_two){
            // self::$product->image_two = imageUpload($request->image_two, 'adminAsset/img/other/', 'other-img');
            self::$product->image_two = imageUpload($request->file('image_two'), 'adminAsset/img/other/', 'other-img-two');
        }
        if($request->image_three){
            // self::$product->image_three = imageUpload($request->image_three, 'adminAsset/img/other/', 'other-img');
            self::$product->image_three = imageUpload($request->file('image_three'), 'adminAsset/img/other/', 'other-img-three');

        }
        if($request->image_four){
            self::$product->image_four = imageUpload($request->file('image_four'), 'adminAsset/img/other/', 'other-img-four');
            // self::$product->image_four = imageUpload($request->image_four, 'adminAsset/img/other/', 'other-img');
        }
        //Nayem End

        self::$product->regular_price = $request->regular_price;
        self::$product->discount_type = $request->discount_type;
        self::$product->discount_amount = $request->discount_amount;
        if($request->discount_type=='percentage'){
            self::$product->selling_price = ($request->regular_price - ($request->regular_price * $request->discount_amount/100));
        }elseif($request->discount_type=='flat'){
            self::$product->selling_price = ($request->regular_price - $request->discount_amount);
        }elseif($request->discount_type == '0'){
            self::$product->discount_type = '';
            self::$product->selling_price = $request->regular_price;
        }else{
            self::$product->selling_price = $request->regular_price;
        }
        self::$product->stock_amount = $request->stock_amount;
        
        self::$product->advance_pay = $request->advance_pay;
        self::$product->advance_pay_amount = $request->advance_pay_amount;
        self::$product->flash_sale = $request->flash_sale;
        
        self::$product->status = $request->status;
         
        self::$product->save();

        return self::$product;
    }



    public static function updateProduct( $request, $product )
    {
        // dd($request->all());
        ini_set('max_file_uploads','50');
        if ($request->file('image')) {
            if (file_exists($product->image)) {
                unlink($product->image);
            }
            self::$imageUrl = self::getImageUrl($request);
        }
        else {
            self::$imageUrl = $product->image;
        }

        $product->merchant_id = $request->merchant_id;
        $product->category_id = $request->category_id;
        $product->sub_category_id = $request->sub_category_id;
        $product->sub_subcategory_id = $request->sub_subcategory_id;
        $product->brand_id = $request->brand_id;
        $product->unit_id = $request->unit_id;
        $product->name = $request->name;
        $product->code = $request->code;
        $product->type = $request->type;

        $product->short_description = $request->short_description;
        $product->long_description = $request->long_description;
        $product->image = self::$imageUrl;
        //Nayem Start
        if ($request->file('image_one')) {
            if (file_exists($product->image_one)) {
                unlink($product->image_one);
            }
            $product->image_one =imageUpload($request->file('image_one'), 'adminAsset/img/other/', 'other-img');
        }
        if ($request->file('image_two')) {
            if (file_exists($product->image_two)) {
                unlink($product->image_two);
            }
            $product->image_two = imageUpload($request->file('image_two'), 'adminAsset/img/other/', 'other-img');
        }
        if ($request->file('image_three')) {
            if (file_exists($product->image_three)) {
                unlink($product->image_three);
            }
            $product->image_three = imageUpload($request->file('image_three'), 'adminAsset/img/other/', 'other-img');
        }
        if ($request->file('image_four')) {
            if (file_exists($product->image_four)) {
                unlink($product->image_four);
            }
            $product->image_four = imageUpload($request->file('image_four'), 'adminAsset/img/other/', 'other-img');
        }
        //Nayem end
        $product->regular_price = $request->regular_price;
        $product->discount_type = $request->discount_type;
        $product->discount_amount = $request->discount_amount;
        if ($request->discount_type == 'percentage') {
            $product->selling_price = ($request->regular_price - ($request->regular_price * $request->discount_amount / 100));
        } elseif ($request->discount_type == 'flat') {
            $product->selling_price = ($request->regular_price - $request->discount_amount);
        }elseif($request->discount_type == '0'){
            $product->discount_type = '';
            $product->selling_price = $request->regular_price;
        } else {
            $product->selling_price = $request->regular_price;
        }
        $product->stock_amount = $request->stock_amount;
        $product->advance_pay = $request->advance_pay;
        $product->advance_pay_amount = $request->advance_pay_amount;
        $product->flash_sale = $request->flash_sale; 
        $product->status = $request->status;
        $product->save();
    }



    public static  function deleteProduct($product){
    // Delete product images
    $productImages = ProductImage::where('product_id', $product->id)->get();
    foreach ($productImages as $productImage) {
        if (file_exists($productImage->image)) {
            unlink($productImage->image);
        }
        $productImage->delete();
    }

    // Delete related entries from other tables
    ProductSize::where('product_id', $product->id)->delete();
    ProductColor::where('product_id', $product->id)->delete();
    ProductTag::where('product_id', $product->id)->delete();

    // Delete product comparison entries
    ProductComperison::where('product_id', $product->id)->delete();

    // Check and delete product images if they exist
    if (file_exists($product->image)) {
        unlink($product->image);
    }
    if (file_exists($product->image_one)) {
        unlink($product->image_one);
    }
    if (file_exists($product->image_two)) {
        unlink($product->image_two);
    }
    if (file_exists($product->image_three)) {
        unlink($product->image_three);
    }
    if (file_exists($product->image_four)) {
        unlink($product->image_four);
    }

    // Finally, delete the product
    $product->delete();
    }



    public static function checkStatus($id)
    {
        self::$product= self::find($id);
        if (self::$product->status == 1){
            self::$product->status = 0;
        }
        else if(self::$product->status == 0){
            self::$product->status = 1;
        }
        self::$product->save();

    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
    public function colors()
    {
        return $this->hasMany(ProductColor::class);
    }
    public function sizes(){
        return $this->hasMany(ProductSize::class);
    }
    public function tag(){
        return $this->hasMany(ProductTag::class);
    }

    public function productImages(){
        return $this->hasMany(ProductImage::class);
    }

    public function sub_subcategory(){
        return $this->belongsTo(SubSubCategory::class);
    }
    public function user(){
        return $this->belongsTo(User::class, 'merchant_id', 'id');
    }

    public function productOffer(){
        return $this->hasOne(ProductOffer::class)->where('status', 1);
    }

    public function comboDetails(){
        return $this->hasMany(ComboProductDetail::class);
    }

    public function productComperison(){
        return $this->hasOne(ProductComperison::class);
    }



}
