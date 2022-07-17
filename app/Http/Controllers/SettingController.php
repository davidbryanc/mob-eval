<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{
    public function index()
    {
        return view('setting');
    }

    public function change_password(Request $request)
    {
        $user = Auth::user();
        if (!Hash::check($request->password_old, $user->password)) {
            return redirect()->back()->with('error', "Password lama tidak sesuai !");
        }
        $user->forceFill([
            'password' => Hash::make($request->password_new),
        ])->save();
        return redirect()->back()->with('success', "Password berhasil diubah !");
    }
}
