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
    $reservations = Reservation::with('user')
      ->latest()
      ->get();
    return view('catering.addreservation', compact('reservations'));
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
      'address' => 'required',
      'package' => 'required',
      'reservationDate' => 'required|date',
    ]);

    // Retrieve user details
    $user = User::select('id', 'fullname', 'email', 'contact')->findOrFail($data['user_id']);

    // Check if the date is already reserved
    $existingReservation = Reservation::where('date', $request->get('reservationDate'))->first();

    if ($existingReservation) {
      return response()->json(['message' => 'The selected date is already reserved. Please choose another date.'], 409);
    }

    // Create a new reservation
    Reservation::create([
      'user_id' => $user->id,
      'address' => $request->get('address'),
      'packages' => $request->get('package'),
      'date' => $request->get('reservationDate'),
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
