<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    // pizza list
    public function pizzaList()
    {
        $pizza = Product::select('products.*','categories.name as category_name')->when(request('key'),function($query){
            $query->where('products.name','like','%'.request('key').'%');
        })->leftJoin('categories','categories.id','products.category_id')->orderBy('products.id','desc')->paginate(3);
        // dd($pizza->toarray());
        return view('admin.product.pizzaList',compact('pizza'));
    }

    // pizza create page
    public function pizzaCreatePage()
    {
        $categories = Category::select('id','name')->get();
        return view('admin.product.pizzaCreatePage',compact('categories'));
    }



    // pizza create
    public function pizzaCreate(Request $request)
    {
        $this->pizzaValidationCheck($request);
        $data = $this->getPizzaData($request);
        if($request->image)
        {
            $imageName = uniqid().'_'.$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/'.$imageName);
            $data['image'] = $imageName;
        }
        Product::create($data);
        return redirect()->route('product#pizzaList')->with(['created' => 'pizza creating is successful']);;
    }

    // pizza see more
    public function pizzaSeemore($id)
    {
        $pizza = Product::where('id',$id)->first();
        $category = Category::select('name')->where('id',$pizza->category_id)->first();
        // dd($category);
        return view('admin.product.pizzaSeemore',compact(['pizza','category']));
    }

    //pizza edit
    public function pizzaEditPage($id)
    {
        $data = Product::where('id',$id)->first();
        $category = Category::select('id','name')->get();
        return view('admin.product.pizzaEditPage',compact('data','category'));
    }

    // pizza update
    public function pizzaUpdate(Request $request)
    {
        $ID = $request->pizzaId;
        $this->pizzaUpdateValidationCheck($request);
        $data = $this->getPizzaData($request);
        $oldImage = Product::where('id',$ID)->first()->image;
        if($request->image)
        {
            if($oldImage)
            {
                Storage::delete('public/'.$oldImage);
            }
            $imageName = uniqid().'_'.$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/'.$imageName);
            $data['image'] = $imageName;
        }else{
            $data['image'] = $oldImage;
        }
        Product::where('id',$ID)->update($data);
        return redirect()->route('product#pizzaList')->with(['updated' => 'pizza updating is successful']);
    }

    //pizza delete
    public function pizzaDelete($id)
    {
        // dd($id);
        Product::where('id',$id)->delete();
        return back()->with(['deleted' => 'Deleting process successful']);
    }

    // get data from pizza input
    private function getPizzaData($request)
    {
        return [
            'category_id' => $request->categoryId,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'waiting_time' => $request->waitingTime,
        ];
    }

    // pizza validation check
    private function pizzaValidationCheck($request)
    {
        Validator::make($request->all(),[
            'categoryId' => 'required',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'waitingTime' => 'required',
            'image' => 'required',
        ])->validate();
    }

    private function pizzaUpdateValidationCheck($request)
    {
        Validator::make($request->all(),[
            'categoryId' => 'required',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'waitingTime' => 'required',
        ])->validate();
    }
}
