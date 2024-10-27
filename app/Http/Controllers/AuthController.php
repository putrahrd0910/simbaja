<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

// public function registerPost(Request $request)
function registerPost(Request $request)
{
$user = new User();
$user->name = $request->name;
$user->email = $request->email;
$user->password = Hash::make($request->password);
$user->save();
return back()->with('success', 'Register successfully');
}