<?php

namespace App\Http\Controllers\user;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    // show contact page
    public function contactPage()
    {
        $info = User::where('id',Auth::user()->id)->first();
        return view('user.contact.contactPage',compact('info'));

    }

    // send message
    public function sendMessage(Request $request)
    {
        Validator::make($request->all(),[
            'userName' => 'required',
            'userEmail' => 'required',
            'subject'=> 'required',
            'message'=> 'required',
        ])->validate();
        Contact::create([
            'name' => $request->userName,
            'email' => $request->userEmail,
            'message' => $request->message,
        ]);
        return redirect()->route('user#home')->with(['message' => 'Sending Message Success!']);
    }
}
