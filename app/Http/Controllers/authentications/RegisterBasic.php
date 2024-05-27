<?php

namespace App\Http\Controllers\Authentications;

use App\Mail\WelcomeEmail;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class RegisterBasic extends Controller
{
  public function index()
  {
    return view('content.authentications.auth-register-basic');
  }

  public function saveData(Request $request)
  {
    // Validate request
    $request->validate([
      'fullname' => 'required|string',
      'email' => 'required|email|unique:users',
      'password' => 'required|min:6',
      'contact' => 'required|string',
      'role' => 'required|in:admin,user',
    ]);

    // Create new user
    $user = new User([
      'fullname' => $request->input('fullname'),
      'email' => $request->input('email'),
      'password' => bcrypt($request->input('password')),
      'contact' => $request->input('contact'),
      'role' => $request->input('role'),
    ]);

    // Save user to database
    $user->save();

    Mail::to($user['email'])->send(new WelcomeEmail($user['fullname']));

    // Return success response
    return response()->json(['message' => 'User registered successfully']);
  }
}
