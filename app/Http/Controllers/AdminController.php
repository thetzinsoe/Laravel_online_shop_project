<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Faker\Core\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    // account list
    public function accountList()
    {
        $accountData = User::where('role','admin')->paginate(4);

        return view('admin.account.list',compact('accountData'));
    }

    // accont remove
    public function accountRemove($id)
    {
        if(Auth::user()->id == $id){
            return back();
        }
        $updateData = ['role' => 'user'];
        User::where('id',$id)->update($updateData);
        return back();
    }

    // account Delete
    public function accountDelete($id)
    {
        if(Auth::user()->id == $id){
            return back();
        }
        User::where('id',$id)->delete();
        return back();
    }


    // change password page
    public function passwordChangePage()
    {
        return view('admin.account.change');
    }

    // change password
    public function passwordChange(Request $request)
    {
        $this->checkPasswordValidation($request);
        $userId = Auth::user()->id;
        $oldPass = $request->oldPassword;
        $newPass = $request->newPassword;
        $dbpass = Auth::user()->password;
        $data = User::where('id',$userId)->first();
        // dd($data->toarray());
        if(Hash::check($oldPass, $dbpass)){
            $data = [
                'password' => hash::make($newPass),
            ];
            User::where('id',$userId)->update($data);
            Auth::logout();
            return redirect()->route('auth#loginPage');
        }else{
            return back()->with(['passMiss' => 'Old password missing']);
        }

    }

    //account detail
    public function accountDetail()
    {
        return view('admin.account.detail');
    }

    // account edit
    public function accountEdit()
    {
        return view('admin.account.edit');
    }

    //account update
    public function accountUpdate(Request $request)
    {
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
        Auth::user()->id = $request['id'];
        User::where('id',Auth::user()->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'image' => $imgName,
        ]);
        return redirect()->route('admin#accountDetail')->with(['accupdate' => 'Account update Successful!']);
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
            // 'image' => ['required','image','mimes:jpg,png,jpeg,gif,svg',
            // 'max:2048'],
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
