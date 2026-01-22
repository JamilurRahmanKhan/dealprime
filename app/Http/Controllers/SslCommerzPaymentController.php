<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Order_detail;
use DB;
use Illuminate\Http\Request;
use App\Library\SslCommerz\SslCommerzNotification;
use Illuminate\Support\Facades\Session;
use sms_net_bd\SMS;

class SslCommerzPaymentController extends Controller
{

    public function exampleEasyCheckout()
    {
        return view('exampleEasycheckout');
    }

    public function exampleHostedCheckout()
    {
        return view('exampleHosted');
    }

    public function index(Request $request)
    {
        # Here you have to receive all the order data to initate the payment.
        # Let's say, your oder transaction informations are saving in a table called "orders"
        # In "orders" table, order unique identity is "transaction_id". "status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.
//return $request;

//        if($request->payment_method == 'fullAmount'){
//            $amount = $request->order_total;
//            $dueAmount =0;
//        }
//        elseif ($request->payment_method == 'online') {
//            $amount = $request->advance_payment;
//            $dueAmount = $request->order_total - $request->advance_payment;
//        }


        if($request->advance_payment == 0){
            $amount =$request->order_total;
            $dueAmount =0;
        } else {
            if ($request->payment_method == 'fullAmount'){
                $amount = $request->order_total;
                $dueAmount =0;
            }elseif ($request->payment_method == 'online'){

                $amount = $request->advance_payment;
                $dueAmount = $request->order_total - $request->advance_payment;
            }

//            $amount =$request->advance_payment;
//            $dueAmount = $request->order_total - $request->advance_payment;
        }

        $post_data = array();
        $post_data['total_amount'] = $amount; # You cant not pay less than 10
//        $post_data['due_amount'] = $dueAmount; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = $request->name;
        $post_data['cus_email'] = $request->email;
        $post_data['cus_add1'] = $request->delivery_address;
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = $request->phone;
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";

        $lastOrder = Order::orderBy('id', 'desc')->first();
        if ($lastOrder) {
            $newOrderNumber = intval($lastOrder->order_number) + 1;
        }else {
            $newOrderNumber = 1;
        }
        $formattedOrderNumber = str_pad($newOrderNumber, 5, '0', STR_PAD_LEFT);

        #Before  going to initiate the payment order status need to insert or update as Pending.
        $update_product = DB::table('orders')
            ->where('transaction_id', $post_data['tran_id'])
            ->updateOrInsert([
                'name' => $post_data['cus_name'],
                'email' => $post_data['cus_email'],
                'phone' => $post_data['cus_phone'],
                'amount' => $post_data['total_amount'],
                'status' => 'Pending',
                'address' => $post_data['cus_add1'],
                'transaction_id' => $post_data['tran_id'],
                'currency' => $post_data['currency'],
                'due_amount' => $dueAmount,
                'order_number' => $formattedOrderNumber,
                'customer_id' => $request->customer_id,
                'order_total' => $request->order_total,
                'shipping_address' => $request->delivery_address,
                'shipping_cost' => $request->shipping_cost,
                'payment_method' => $request->payment_method,
                'order_date' => $request->order_date,
                'advance_payment' => $post_data['total_amount'],
            ]);
        Order_detail::newOrderDetail(Order::orderBy('id','desc')->first(),$request);
        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'hosted');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }

    }

    public function payViaAjax(Request $request)
    {

        # Here you have to receive all the order data to initate the payment.
        # Lets your oder trnsaction informations are saving in a table called "orders"
        # In orders table order uniq identity is "transaction_id","status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.

        $post_data = array();
        $post_data['total_amount'] = '10'; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = 'Customer Name';
        $post_data['cus_email'] = 'customer@mail.com';
        $post_data['cus_add1'] = 'Customer Address';
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = '8801XXXXXXXXX';
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";


        #Before  going to initiate the payment order status need to update as Pending.
        $update_product = DB::table('orders')
            ->where('transaction_id', $post_data['tran_id'])
            ->updateOrInsert([
                'name' => $post_data['cus_name'],
                'email' => $post_data['cus_email'],
                'phone' => $post_data['cus_phone'],
                'amount' => $post_data['total_amount'],
                'status' => 'Pending',
                'address' => $post_data['cus_add1'],
                'transaction_id' => $post_data['tran_id'],
                'currency' => $post_data['currency']
            ]);

        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'checkout', 'json');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }

    }

    public function success(Request $request)
    {
        echo "Transaction is Successful";

        $tran_id = $request->input('tran_id');
        $amount = $request->input('amount');
        $currency = $request->input('currency');
        $sslc = new SslCommerzNotification();

        #Check order status in order tabel against the transaction id or order id.
        $order_details = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount','name','advance_payment','order_number','order_total',
            'due_amount','phone')->first();

        if ($order_details->status == 'Pending') {
            $validation = $sslc->orderValidate($request->all(), $tran_id, $amount, $currency);

            if ($validation) {

                /*
                That means IPN did not work or IPN URL was not set in your merchant panel. Here you need to update order status
                in order table as Processing or Complete.
                Here you can also sent sms or email for successfull transaction to customer
                */

                $update_product = DB::table('orders')
                    ->where('transaction_id', $tran_id)
                    ->update(['status' => 'Processing']);

                echo "<br >Transaction is successfully Completed";

                Session::forget('coupon');
                Session::forget('shipping_cost');
                Session::forget('order_total');
                Session::forget('tax');
                Session::forget('grand_total');

                Session::flash('orderSuccess','Order Completed Successfully'); 

                return  redirect()->route('get.confirmation')->with('message','Your order was successfully placed');

            }
        } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
            /*
             That means through IPN Order status already updated. Now you can just show the customer that transaction is completed. No need to udate database.
             */
            echo "Transaction is successfully Completed";
            Session::forget('coupon');
            Session::forget('shipping_cost');
            Session::forget('order_total');
            Session::forget('tax');
            Session::forget('grand_total');

            Session::flash('orderSuccess','Order Completed Successfully');



            return  redirect()->route('get.confirmation')->with('message','Your order was successfully placed');

        } else {
            #That means something wrong happened. You can redirect customer to your product page.
            echo "Invalid Transaction";
            return back()->with('message','Invalid Transaction');
        }


    }

    public function fail(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_details = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_details->status == 'Pending') {
            $update_product = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Failed']);
            echo "Transaction is Falied";
            return redirect()->route('get.cancel')->with('message','Transaction is Falied');
        } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
            echo "Transaction is already Successful";
            return  redirect()->route('get.confirmation')->with('message','Your order was successfully placed');
        } else {
            echo "Transaction is Invalid";
            return redirect()->route('get.cancel')->with('message','Transaction is Invalid');
        }

    }

    public function cancel(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_details = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_details->status == 'Pending') {
            $update_product = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Canceled']);
            echo "Transaction is Cancel";
            return back()->with('message','Transaction is Cancel');
            // return redirect()->route('get.cancel')->with('message','Transaction is Cancel');
        } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
            echo "Transaction is already Successful";
            return  redirect()->route('get.confirmation')->with('message','Your order was successfully placed');
        } else {
            echo "Transaction is Invalid";
            return back()->with('message','Transaction is Invalid');
            // return  redirect()->route('get.cancel')->with('message','Transaction is Invalid');
        }


    }

    public function ipn(Request $request)
    {
        #Received all the payement information from the gateway
        if ($request->input('tran_id')) #Check transation id is posted or not.
        {

            $tran_id = $request->input('tran_id');

            #Check order status in order tabel against the transaction id or order id.
            // $order_details = DB::table('orders')
            //     ->where('transaction_id', $tran_id)
            //     ->select('transaction_id', 'status', 'currency', 'amount')->first();
            $order_details = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount','name','advance_payment','order_number','order_total',
            'due_amount','phone')->first();

            if ($order_details->status == 'Pending') {
                $sslc = new SslCommerzNotification();
                $validation = $sslc->orderValidate($request->all(), $tran_id, $order_details->amount, $order_details->currency);
                if ($validation == TRUE) {
                    /*
                    That means IPN worked. Here you need to update order status
                    in order table as Processing or Complete.
                    Here you can also sent sms or email for successful transaction to customer
                    */
                    $update_product = DB::table('orders')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 'Processing']);
                        $sms = new SMS();
                        try {
                            $sms->sendSMS(
                            //            "Your DealPrime Order number is $order_number",
                                "
Hi ! {$order_details->name}
Order Invoice:
Order ID: {$order_details->order_number}
Total: {$order_details->order_total} TK.
Advanced: {$order_details->advance_payment} TK.
Due: {$order_details->due_amount} TK.

You can find more details on https://dealprime.com.bd

We received your order from DealPrime.Your order is under processing and will be delivered within the next 1 to 7 days.Thanks for being with DealPrime.
                    ",
                                "$order_details->phone"
                            );
                        } catch (Exception $e) {
                            // handle $e->getMessage();
                        }

                    echo "Transaction is successfully Completed";
                }
            } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {

                #That means Order status already updated. No need to udate database.

                echo "Transaction is already successfully Completed";
            } else {
                #That means something wrong happened. You can redirect customer to your product page.

                echo "Invalid Transaction";
                return  redirect()->route('get.cancel')->with('message','Transaction is Invalid');
            }
        } else {
            echo "Invalid Data";
        }
    }

}
