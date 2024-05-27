<?php

namespace App\Http\Controllers\Catering;

use App\Models\User; // Adjusted the import to match the model
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MenuController extends Controller
{
  public function index()
  {
    return view('catering.menu');
  }
  public function fetchMenu()
  {
    $menu = User::select('id', 'fullname', 'email', 'contact')->get(); // Adjusted the attributes to match the model

    return response()->json(['menus' => $menu]); // Corrected key to match AJAX response
  }
}
