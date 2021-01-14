<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class AccountController extends Controller
{
    public function index()
    {
        return view('account.edit');
    }

    public function update()
    {
        request()->validate([
            'old_password' => 'required',
            'password' => ['required', 'min:3', 'confirmed'],
        ]);

        $currentPassword = auth()->user()->password;
        $old_password = request('old_password');

        if (Hash::check($old_password, $currentPassword)) {
            auth()->user()->update([
                'password' => bcrypt(request('password')),
            ]);
            Alert::toast('Your password has been changed', 'success');
            return redirect()->back();
        } else {
            return redirect()->back()->withErrors(["old_password" => "your password doesn't match with the current password"]);
        };
    }
}
