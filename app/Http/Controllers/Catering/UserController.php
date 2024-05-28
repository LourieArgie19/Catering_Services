<?php

namespace App\Http\Controllers\Catering;

use App\Mail\WelcomeEmail;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
  public function index()
  {
    $users = User::all();
    return view('Catering.users', ['users' => $users]);
  }
  public function saveusers(Request $request)
  {
    // Validate the incoming request data
    $data = $request->validate([
      'fullname' => 'required|string',
      'email' => 'required|email|unique:users',
      'password' => 'required|min:6',
      'contact' => 'required|string',
      'role' => 'required|in:admin,user',
    ]);

    // Hash the password
    $data['password'] = bcrypt($data['password']);

    // Create a new client
    $register = User::create($data);
    Mail::to($register['email'])->send(new WelcomeEmail($register['fullname']));

    return response()->json(['success' => true, 'message' => 'User created successfully.']);
  }

  public function fetchUser()
  {
    $users = User::all();
    return response()->json([
      'user' => $users,
    ]);
  }

  public function getUser($id)
  {
    $user = User::find($id);

    if ($user) {
      return response()->json([
        'status' => 200,
        'user' => $user,
      ]);
    } else {
      return response()->json([
        'status' => 404,
        'user' => 'User Not Found',
      ]);
    }
  }

  public function updateUser(Request $request, $id)
  {
    $data = $request->validate([
      'fullname' => 'required',
      'email' => 'required|unique:users,email,' . $id,
      'contact' => 'required',
      'role' => 'required|in:user,admin',
      'password' => 'required|min:5',
    ]);

    // Find the user by ID
    $user = User::findOrFail($id);

    // Update the user's information
    $user->update($data);

    // Return success response
    return response()->json(['success' => true, 'message' => 'User updated successfully']);
  }

  public function destroy($id)
  {
    $users = User::where('id', $id)->delete();
  }

  public function editUser($id)
  {
    $user = User::find($id);

    if (!$user) {
      return response()->json(['error' => 'User not found'], 404);
    }

    return view('Catering.edit-user', ['user' => $user]);
  }
}
