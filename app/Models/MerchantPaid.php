<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MerchantPaid extends Model
{

    public static  $merchant;
    public static function newMerchantPaid($request,$total_paid_amount )
    {

        self::$merchant  = new MerchantPaid();

        self::$merchant->merchant_id = $request->merchant_id;
//        self::$merchant->total_order_amount = $request->total_order_amount;
        self::$merchant->paid_amount = $request->paid_amount;
        self::$merchant->due_amount = ($request->total_order_amount-($request->paid_amount+$total_paid_amount));
        self::$merchant->paid_date = $request->paid_date;
        if(self::$merchant->due_amount == 0 || self::$merchant->due_amount >= $request->paid_amount){
            self::$merchant->status = 'paid';
        }


        self::$merchant ->save();

        return self::$merchant ;
    }


}
