<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class WishlistController extends Controller
{

//     public function wishlist()  {
//         return view('web.wishlist.wishlist',[
//             'wishlists'=>Wishlist::latest()->get(),
//         ]);
//    }


public function wishlist() {
    // Get all wishlist items
    $wishlists = Wishlist::latest()->get();

    // Get product IDs from wishlist
    $wishlistProductIds = $wishlists->pluck('product_id')->toArray();

    // Get all products in the same category but from different brands
    $wishlistRelatedProducts = Product::whereIn('category_id', function($query) use ($wishlistProductIds) {
        $query->select('category_id')
              ->from('products')
              ->whereIn('id', $wishlistProductIds);
    })
    ->whereNotIn('brand_id', function($query) use ($wishlistProductIds) {
        $query->select('brand_id')
              ->from('products')
              ->whereIn('id', $wishlistProductIds);
    })
    ->whereNotIn('id', $wishlistProductIds) // Exclude products already in the wishlist
    ->get();

    return view('website.wishlist.wishlist', [
        'wishlists' => $wishlists,
        'wishlistRelatedProducts' => $wishlistRelatedProducts
    ]);
}


    public function wishlistAdd($customer_id,$product_id)  {
        $existingWishlist = WishList::where('customer_id', $customer_id)
            ->where('product_id', $product_id)
            ->first();

        if ($existingWishlist) {
            Session::flash('danger', 'Product already stored ');
            return back();
        }else{
            $wishlist = new WishList();
            $wishlist->customer_id = $customer_id;
            $wishlist->product_id = $product_id;
            $wishlist->save();

            Session::flash('success','Wishlist product Added Successfully');
            return back();
        }
   }
    public function wishlistDelete( $id)  {
        Wishlist::wishlistDelete($id);
        Session::flash('success','Wishlist product Delete Successfully');
        return back();
   }



   public function deleteMultiple(Request $request)
   {
       $wishlistIds = $request->wishlistIds;
       if (!empty($wishlistIds)) {
           Wishlist::whereIn('id', $wishlistIds)->delete();
           Session::flash('success', 'Selected wishlist items have been deleted successfully.');
           return response()->json(['success' => true]);
       }
       session()->flash('error', 'No items selected for deletion.');

       return response()->json(['success' => true]);
   }


}
