<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Request;

class Analytics extends Controller
{
  public function index()
  {
    $totalUsers = User::count();
    $totalReservations = Reservation::count();
    return view('content.dashboard.dashboards-analytics', compact('totalUsers', 'totalReservations'));
  }
}
