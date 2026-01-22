<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Banner;
use App\Models\Faq;
use App\Models\Order;
use App\Models\Policy;
use App\Models\PopUp;
use App\Models\ProductComperison;
use App\Models\Setting;
use App\Models\Tag;
use App\Models\Blog;
use App\Models\Size;
use App\Models\Term;
use App\Models\User;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Rating;
use App\Models\BlogTag;
use App\Models\Product;
use App\Models\Carousel;
use App\Models\Category;
use App\Models\Wishlist;
use App\Models\ProductTag;
use App\Models\ProductSize;
use App\Models\BlogCategory;
use App\Models\ComboProduct;
use App\Models\ComboProductDetail;
use App\Models\ProductColor;
use App\Models\ProductImage;
use App\Models\ProductOffer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;
use DB;


class HomeController extends Controller
{
    private $product;
    public function home() {

        // session(['url.intended' => url()->current()]);
//        return PopUp::where('status',1)->latest()->first();
        return view('website.home.home',[
            'popUp'=>PopUp::where('status',1)->latest()->first(),
            'heroContents'=>Carousel::where('status',1)->get(),
            'banners'=>Banner::where('status',1)->get(),
            'products'=>Product::where('status',1)->get(),
//            'latest_products'=>Product::where('status',1)->where('type',2)->take(12)->latest()->get(),
            'categories' => Category::withCount([
                'products' => function ($query) {$query->where('status', 1);}]
            )->where('status', 1)->get(),
            'tags'=>Tag::where('status',1)->get(),
            'brands'=>Brand::where('status',1)->get(),
            'blogs'=>Blog::where('status',1)->latest()->get(),
            'combo_products'=>ComboProduct::where('status',1)->latest()->get(),
            'policys'=>Policy::latest()->get(),
        ]);
    }
    public function about() {

        session(['url.intended' => url()->current()]);
        return view('website.about.about',[
            'about' => About::where('status', 1)->first()

        ]);
    }
    public function faq() {
        session(['url.intended' => url()->current()]);
        return view('website.faq.faq',[
            'faqs'=>Faq::where('status',1)->get(),
        ]);
    }
    public function contact() {
        session(['url.intended' => url()->current()]);
        return view('website.contact.contact',[
            'setting'=>Setting::first(),
        ]);
    }

    public function ShopProductList($id, $type = null){


        session(['url.intended' => url()->current()]);
        // dd(session('url.intended'));
         $minPrice = Product::where('status', 1)->min('selling_price');
         $maxPrice = Product::where('status', 1)->max('selling_price');

        if ($id == 'all_product') {
            $products = Product::where('status', 1)->whereNot('flash_sale')->paginate(16);
        } elseif ($type == 'category') {
            $products = Product::where('status', 1)->where('category_id', $id)->whereNot('flash_sale')->paginate(16);
        } elseif ($type == 'subcategory') {
            $products = Product::where('status', 1)->where('sub_category_id', $id)->whereNot('flash_sale')->paginate(16);
        } elseif ($type == 'sub_subcategory') {
            $products = Product::where('status', 1)->where('sub_subcategory_id', $id)->whereNot('flash_sale')->paginate(16);
        }elseif($id =='discount_product'){
             $products = Product::where('flash_sale', 1)->where('status', 1)->paginate(16);
        } elseif($id == 'combo_product'){
            $products = ComboProduct::where('status', 1)->paginate(16);
        }elseif( $type == 'merchant'){
           $products = Product::where('status', 1)->where('merchant_id', $id)->whereNot('flash_sale')->paginate(10);
        }else {
            $products = collect();
        }
//        session(['url.intended' => url()->current()]);
        return view('website.shop-product.product_list',[
            'products' => $products,
            'categories'=>Category::where('status',1)->get(),
            'colors'=>Color::where('status',1)->get(),
            'brands'=>Brand::where('status',1)->get(),
            'sizes'=>Size::where('status',1)->get(),
            'minPrice'=>$minPrice,
            'maxPrice'=>$maxPrice,
        ]);
    }
    public function productItemDetails($id,$category_id=null){

        session(['url.intended' => url()->current()]);
//        dd(session('url.intended'));
        // return ProductImage::where('product_id',$id)->orderby('id','asc')->get();
        $ratings = Rating::where('status', 1)->where('product_id', $id)->get();
        $averageRating = $ratings->avg('rating');
        return view('website.shop-product.product_details',[
            'product'=>Product::find($id),
            'product_colors'=>ProductColor::where('product_id',$id)->get(),
            'product_sizes'=>ProductSize::where('product_id',$id)->get(),
            'product_tags'=>ProductTag::where('product_id',$id)->get(),
            'product_Image'=>ProductImage::where('product_id',$id)->orderby('id','asc')->get(),
            'productComperisons'=>ProductComperison::where('product_id',$id)->get(),

            'category_product'=>Product::where('category_id',$category_id)->where('status',1)->get(),

            'ratings'=>Rating::where('product_type',1)->where('status',1)->paginate(12),
            'ratingCount'=>Rating::where('product_id',$id)->where('status',1)->count(),
            'averageRating'=>$averageRating,

        ]);
    }

    public function termsAndCondition(){

        session(['url.intended' => url()->current()]);
        return view('website.terms_and_condition.terms',[
            'terms_and_condition'=>Term::first(),
        ]);
    }
    public function termsType($terms_type,$user_type)
    {
        // return $terms_type;
        session(['url.intended' => url()->current()]);
        return view('website.terms_and_condition.terms',[
            'terms_and_condition'=>Term::where('terms_type',$terms_type)->where('user_type',$user_type)->first(),
        ]);
    }
    public function storeList() {

        session(['url.intended' => url()->current()]);
        return view('website.store_list.store_list',[
            'storeLists'=>User::where('role','Merchant')->where('status',1)->get(),
        ]);
   }

    public function comboProductDetails($id){

        session(['url.intended' => url()->current()]);
        $ratings = Rating::where('status', 1)->where('product_type', 2)->where('product_id', $id)->get();
        $averageRating = $ratings->avg('rating');
        return view('website.combo-product.combo_product',[
            'combo_product'=>ComboProduct::find($id),
            'combo_products'=>ComboProduct::where('status',1)->get(),
            'ratings'=>Rating::where('status',1)->where('product_type',2)->paginate(12),
            'ratingCount'=>Rating::where('product_id',$id)->where('product_type', 2)->where('status',1)->count(),
            'averageRating'=>$averageRating,
        ]);
    }

    public function  getSearchProductList()
    {

        session(['url.intended' => url()->current()]);
        $searchTerm = $_GET['user_input'];
        $keywords = explode(' ', $searchTerm);

//        $conditions = [];
//        foreach ($keywords as $keyword) {
//            $conditions[] = "LOWER(name) LIKE '%" . $keyword . "%'";
//        }
//        $sql = "SELECT * FROM products WHERE " . implode(' AND ', $conditions);
//        $products = DB::select($sql); // Use Laravel's DB facade to execute the query


         $products = DB::table('products')
            ->where(function ($query) use ($keywords) {
                foreach ($keywords as $keyword) {
                    $query->whereRaw('LOWER(name) LIKE ?', ['%' . $keyword . '%']);
                }
            })
            ->get();
        // })->paginate(1);
        
        foreach ($products as $product)
        {
            $product->image = asset($product->image);
        }
        return response()->json( [
            'products' => $products,
            // 'pagination' => $products->links('pagination::bootstrap-4')->toHtml()
            ],200 );
    }

    public function  searchProductByPrice(Request $request)
    {
        session(['url.intended' => url()->current()]);
         $minPrice =   $request->min_price;
         $maxPrice =  $request->max_price;
          $products =  Product::where('regular_price', '>=', $minPrice)
            ->where('regular_price', '<=', $maxPrice)
            ->paginate(Product::count());

        $prominPrice = Product::where('status', 1)->min('selling_price');
        $promaxPrice = Product::where('status', 1)->max('selling_price');
        return view('website.shop-product.product_list',[
            'products' => $products,
            'categories'=>Category::where('status',1)->get(),
            'colors'=>Color::where('status',1)->get(),
            'brands'=>Brand::where('status',1)->get(),
            'sizes'=>Size::where('status',1)->get(),
            'minPrice'=>$prominPrice,
            'maxPrice'=>$promaxPrice,
        ]);
//        return response()->json( ['products' => $products],200 );
    }



    public function blog($id=null) {
        if ($id == 'all_blog') {
            $blog = Blog::where('status', 1)->paginate(6);
        } elseif ($id == $id) {
            $blog = Blog::where('status', 1)->where('blog_category_id', $id)->paginate(6);
        }
        return view('website.blog.blog',[
            'blogs'=>$blog,
            'blogCategories'=>BlogCategory::where('status',1)->get(),
            'blogTags'=>BlogTag::where('status',1)->get(),
            'recentBlogs'=>Blog::where('status',1)->latest()->take(5)->get(),
        ]);

    }
    public function blogDetails($id) {
        return view('website.blog.blog-details',[
            'blogDetail'=>Blog::find($id),
            'blogCategories'=>BlogCategory::where('status',1)->get(),
            'blogTags'=>BlogTag::where('status',1)->get(),
            'recentBlogs'=>Blog::where('status',1)->latest()->take(5)->get(),
        ]);
    }
    public function orderTrack() {
        return view('website.order_track.order_track');
    }
    public function searchOrderTracking(){
        $order_no = $_GET['orderNumber'];

        $products = Order::where('order_number', $order_no)
            ->where('customer_id', Auth::guard('customer')->user()->id)
            ->pluck('order_status');
        return response()->json( ['orderStatus' => $products],200 );
    }
}
