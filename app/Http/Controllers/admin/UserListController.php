<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Contact;

class UserListController extends Controller
{
    // to see user list
    public function userList()
    {
        // dd('hello user list');
        $accountData = User::where('role','user')->paginate(4);

        return view('admin.user.list',compact('accountData'));

    }

    // change user to admin
    public function changeRole(Request $request)
    {
        // logger($request->changeData);
        if($request->changeData == 'admin')
        {
            User::where('id',$request->userId)->update([
                'role' => 'admin',
            ]);
            return response()->json(['status' => 'success'],200);
        }elseif($request->changeData == 'remove'){
            User::where('id',$request->userId)->delete();
            return response()->json(['status' => 'success'],200);
        }
    }

    // show message
    public function messageShow()
    {
        $data = Contact::orderby('updated_at','desc')->get();
        return view('admin.user.message',compact('data'));
    }

    // delete message
    public function messageDelete($id)
    {
        // dd($id);
        Contact::where('id',$id)->delete();
        return back();
    }
}


