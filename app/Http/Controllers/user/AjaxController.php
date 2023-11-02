<?php

namespace App\Http\Controllers\user;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    // ajax list
    public function pizzaList(Request $request)
    {
        // logger($request->status);
        if($request->status == 'desc')
        {
            $data = Product::orderBy('created_at','desc')->get();
        }else{
            $data = Product::orderBy('created_at','asc')->get();
        }
        logger($data);
        return $data;
    }

    // pizza Add to cart
    public function pizzaAddToCart(Request $request)
    {
        $data = $this->getOrderData($request);
        Cart::create($data);
        // logger($data);
        $response = [
            'message' => 'Add to cart complete',
            'status' =>'success',
        ];
        return response()->json($response,200);
    }

    // post order
    public function order(Request $request)
    {
        // logger($request);
        $totalPrice = 0;
        foreach($request->all() as $data)
        {
            $totalPrice += $data['total'];
            logger($data);
            OrderList::create($data);
        }
        Cart::where('user_id',Auth::user()->id)->delete();
        Order::create([
            'user_id' => Auth::user()->id,
            'order_code' => $request[0]['order_code'],
            'total_price' => $totalPrice+10,
            'status' => 0,
        ]);
        return response()->json(['message' => 'order complete','status' => 'success'],200);
    }

    // get order data to cart
    private function getOrderData($request)
    {
         return [
            'user_id' => $request['userId'],
            'product_id' => $request['pizzaId'],
            'qty' => $request['pizzaCount'],
        ];
    }

    //for view count
    public function pizzaViewCount(Request $request)
    {
        $count = Product::select('view_count')->where('id',$request->pizzaId)->first();
        Product::where('id',$request->pizzaId)->update([
            'view_count' => $count->view_count+1,
        ]);
        return response()->json(['status' => 'success'],200);
    }
}
