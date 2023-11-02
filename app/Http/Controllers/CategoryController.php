<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //show category list
    public function list()
    {
        // dd(request('key'));
        $categories = Category::when(request('key'),function($query){
            $query->where('name','like','%'.request('key').'%');
        })->orderBy('id','desc')->paginate(4);
        // dd($categories->total());
        // dd($categories);
        $categories->appends(request()->all());
        return view('admin.category.list',compact('categories'));
    }

    // category create
    public function createPage()
    {
        // dd($request);
        return view('admin.category.createPage');
    }

    //to create category
    public function create(Request $request)
    {
        $this->categoryValidationCheck($request);
        $data = $this->requestCategoryData($request);
        Category::create($data);
        return redirect()->route('category#list');
    }

    //to delete category
    public function delete($id)
    {
        // dd($id);
        Category::where('id',$id)->delete();
        return back();
    }

    //edit page
    public function edit($id)
    {
        $editCategory = Category::where('id',$id)->first();
        return view('admin.category.edit',compact('editCategory'));
    }

    //update page
    public function update(Request $request)
    {
        $request['id'] = $request->categoryId;
        $this->categoryValidationCheck($request);
        $data = $this->requestCategoryData($request);
        Category::where('id',$request->id)->update($data);
        return redirect()->route('category#list');

    }

    // create category validation
    private function categoryValidationCheck($request)
    {
        Validator::make($request->all(),[
            'categoryName' => 'required|unique:categories,name,'.$request->id,
        ])->validate();
    }

    // category request data
    private function requestCategoryData($data)
    {
        return[
            'name' => $data->categoryName,
        ];
    }
}
