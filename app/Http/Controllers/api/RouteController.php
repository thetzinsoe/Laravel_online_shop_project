<?php

namespace App\Http\Controllers\api;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class RouteController extends Controller
{
    //for get all pizza
    public function pizzaList()
    {
        $pizza = Product::orderBy('created_at','desc')->get();
        return response()->json($pizza,200);
    }

    // for categories
    public function categoryList()
    {
        $category =  Category::orderBy('created_at','desc')->get();
        return response()->json($category,200);
    }

    // to see message
    public function messageList()
    {
        $message = Contact::orderBy('created_at','desc')->get();
        return response()->json($message,200);
    }
    //for orders
    public function orderList()
    {
        $order = Order::get();
        return response()->json($order,200);
    }

    // to create Category
    public function createCategory(Request $request)
    {
        $data = [
            'name' => $request->name,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        Category::create($data);
    }

    // category update
    public function categoryUpdate(Request $request)
    {
        // dd($request->toArray());
        // Validator::make($request->all,[
        //     'id' => 'required',
        //     'name' => 'required',
        //     ])->validate();
        $data = Category::where('id',$request->id)->first();
        if(isset($data)){
            Category::where('id',$request->id)->update([
                'name' => $request->name,
            ]);
            return response()->json(['status' => 'success','name' => $request->name],200);
        }
        return response()->json(['message' => 'category not found!']);
    }

    // to create contact
    public function messageSend(Request $request)
    {
        // dd($request);
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        Contact::creat($data);
        return response()->json($data,200);
    }
}
