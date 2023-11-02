<?php

namespace App\Http\Controllers;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // to show home page
    public function home()
    {
        $category = Category::orderBy('created_at','desc')->get();
        $pizza = Product::orderBy('created_at','desc')->get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        return view('user.home',compact('pizza','category','cart'));
    }

    // show item in cart
    public function cart()
    {
        $data = Cart::select('carts.id as itemId','carts.product_id as productId','carts.user_id as userId','products.image as pizzaImg','products.name as pizzaName','products.price as pizzaPrice','carts.qty as pizzaQty')
                ->leftjoin('products','products.id','carts.product_id')
                ->get();
        $total = 0;
        if($data->toarray() != null){
            foreach($data as $i=> $d)
            {
                $amount[$i]= $d->pizzaQty * $d->pizzaPrice;
                $total += $d->pizzaQty * $d->pizzaPrice;
            };
            return view('user.product.cart',compact('data','amount','total'));
        }
        return view('user.product.cart',compact('total'));
    }

    //remove item from cart
    public function cartRemove($id)
    {
        Cart::where('id',$id)->delete();
        return back();
    }

    // order
    public function order()
    {
        dd("please wait for order everybody waiting before you reach!");
    }

    // filter by category
    public function categoryFilter($id)
    {
        // dd($id);
        $category = Category::orderBy('created_at','desc')->get();
        $pizza = Product::where('category_id',$id)->orderBy('created_at','desc')->get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        return view('user.home',compact('pizza','category','cart'));
    }

    // pizza Detail
    public function pizzaDetail($id)
    {
        $morePizza = Product::get();
        $pizza = Product::where('id',$id)->first();
        return view('user.product.pizzaDetail',compact('pizza','morePizza'));
    }

    //account edit
    public function accountEdit()
    {
        return view('user.account.edit');
    }

    // account update
    public function accountUpdate($id,Request $request)
    {
        // dd($id);
        $this->checkAccountValidation($request);
        $imgName = '';
        if($request->image)
        {
            if(Auth::user()->image){
                Storage::delete('public/'.Auth::user()->image);
            }
            $imgName = uniqid().'_'.$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$imgName);
        }else{
            if(Auth::user()->image){
                $imgName = Auth::user()->image;
            }
        }
        User::where('id',$id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'image' => $imgName,
        ]);
        return redirect()->route('user#home')->with(['accupdate' => 'Account update Successful!']);

    }

    // change password page
    public function changePasswordPage()
    {
        return view('user.account.change');
    }

    public function changePassword($id,Request $request)
    {
        // dd($id);
        $this->checkPasswordValidation($request);
        $oldPass = $request->oldPassword;
        $newPass = $request->newPassword;
        $dbpass = Auth::user()->password;
        $data = User::where('id',$id)->first();
        // dd($data->toarray());
        if(Hash::check($oldPass, $dbpass)){
            $data = [
                'password' => hash::make($newPass),
            ];
            User::where('id',$id)->update($data);
            Auth::logout();
            return redirect()->route('auth#loginPage');
        }else{
            return back()->with(['passMiss' => 'Old password missing']);
        }

    }

    //order history
    public function orderHistory()
    {
        $data = Order::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->get();
        return view('user.product.orderHistory',compact('data'));
    }

    // order history detail
    public function orderHistoryDetail($code)
    {
        $data = OrderList::select('order_lists.*','products.*','orders.total_price as totalAmount')
                ->join('products','products.id','order_lists.product_id')
                ->join('orders','orders.order_code','order_lists.order_code')
                ->where('order_lists.order_code',$code)
                ->get();
        // dd($data->toarray());
        return view('user.product.orderHistoryDetail',compact('data'));
    }

    // update account check validation
    private function checkAccountValidation($request)
    {
        validator::make($request->all(),[
            'name' => 'required|min:2',
            'email' => 'required|unique:users,email,'.$request->id,
            'address' => 'required|min:4',
            'phone' => 'required|min:8',
            'gender' => 'required',
        ])->validate();
    }

    // password validation check
    private function checkPasswordValidation($request)
    {
        Validator::make($request->all(),[
            'newPassword' => 'required|min:6',
            'oldPassword' => 'required|min:6',
            'confirmPassword' => 'required|min:6|same:newPassword',
        ])->validate();
    }
}
