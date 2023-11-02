<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // order list
    public function list()
    {
        $data = Order::select('orders.*','users.name')
                ->join('users','users.id','orders.user_id')
                ->orderBy('created_at','desc')
                ->get();
        // dd($data->toarray());
        return view('admin.order.list',compact('data'));
    }

    //detail
    public function detail($code)
    {
        $data = OrderList::select('order_lists.*','products.*','orders.total_price as totalAmount','users.name as userName')
        ->join('products','products.id','order_lists.product_id')
        ->join('orders','orders.order_code','order_lists.order_code')
        ->join('users','users.id','orders.user_id')
        ->where('order_lists.order_code',$code)
        ->paginate(3);
        // dd($data->toarray());
        return view('admin.order.detail',compact('data'));
        // dd('detail');
    }

    //sorting
    public function sorting(Request $request)
    {
        $select = $request['select'];
        $data = Order::select('orders.*','users.name')
                ->join('users','users.id','orders.user_id')
                ->orderBy('created_at','desc');
        if($select == 'all'){
            return response($data->get(),200) ;
        }else{
            return response($data->orWhere('orders.status',$select)->get(),200);
        }
    }

    //change status
    public function changeStatus(Request $request)
    {
        logger($request);
        Order::where('id',$request['orderId'])->update(['status' => $request['status']]);
        return response(['status'=> 'success'],200);
    }
}
