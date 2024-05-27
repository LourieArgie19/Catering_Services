<?php

namespace App\Http\Controllers\Catering;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Support\Str;
use App\Mail\ReservationConfirmedMail;
use Illuminate\Support\Facades\Mail;

class ReservationController extends Controller
{
  public function index()
  {
    return view('catering.addreservation');
  }
  public function getUserDetails($id)
  {
    $user = User::select('fullname', 'email', 'contact')->find($id);

    if ($user) {
      return response()->json([
        'fullname' => $user->fullname,
        'email' => $user->email,
        'contact' => $user->contact,
      ]);
    } else {
      return response()->json(['message' => 'User not found'], 404);
    }
  }

  public function store(Request $request)
  {
    // Validate the incoming request data
    $data = $request->validate([
      'user_id' => 'required|exists:users,id',
      'packages' => 'required',
      'date' => 'required|date',
    ]);

    // Retrieve user details
    $user = User::select('id', 'fullname', 'email', 'contact')->findOrFail($data['user_id']);

    // Check if the date is already reserved
    $existingReservation = Reservation::where('date', $data['date'])->first();

    if ($existingReservation) {
      return response()->json(['message' => 'The selected date is already reserved. Please choose another date.'], 409);
    }

    // Create a new reservation
    Reservation::create([
      'transaction_id' => Str::uuid(),
      'user_id' => $user->id,
      'fullname' => $user->fullname,
      'email' => $user->email,
      'contact' => $user->contact,
      'address' => $data->address,
      'packages' => $data['packages'],
      'date' => $data['date'],
      'is_confirmed' => false,
    ]);

    return response()->json(['message' => 'Reservation saved successfully!']);
  }

  public function fetchReservations()
  {
    $reservations = Reservation::with('user')
      ->orderByDesc('date')
      ->get();

    return response()->json(['reservations' => $reservations]);
  }
}
