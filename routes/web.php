<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboard\Analytics;
use App\Http\Controllers\layouts\WithoutMenu;
use App\Http\Controllers\layouts\WithoutNavbar;
use App\Http\Controllers\layouts\Fluid;
use App\Http\Controllers\layouts\Container;
use App\Http\Controllers\layouts\Blank;
use App\Http\Controllers\pages\AccountSettingsAccount;
use App\Http\Controllers\pages\AccountSettingsNotifications;
use App\Http\Controllers\pages\AccountSettingsConnections;
use App\Http\Controllers\pages\MiscError;
use App\Http\Controllers\pages\MiscUnderMaintenance;
use App\Http\Controllers\authentications\LoginBasic;
use App\Http\Controllers\authentications\RegisterBasic;
use App\Http\Controllers\Catering\UserController;
use App\Http\Controllers\Catering\ReservationController;
use App\Http\Controllers\Catering\MenuController;
use App\Http\Controllers\authentications\ForgotPasswordBasic;
use App\Http\Controllers\cards\CardBasic;
use App\Http\Controllers\user_interface\Accordion;
use App\Http\Controllers\user_interface\Alerts;
use App\Http\Controllers\user_interface\Badges;
use App\Http\Controllers\user_interface\Buttons;
use App\Http\Controllers\user_interface\Carousel;
use App\Http\Controllers\user_interface\Collapse;
use App\Http\Controllers\user_interface\Dropdowns;
use App\Http\Controllers\user_interface\Footer;
use App\Http\Controllers\user_interface\ListGroups;
use App\Http\Controllers\user_interface\Modals;
use App\Http\Controllers\user_interface\Navbar;
use App\Http\Controllers\user_interface\Offcanvas;
use App\Http\Controllers\user_interface\PaginationBreadcrumbs;
use App\Http\Controllers\user_interface\Progress;
use App\Http\Controllers\user_interface\Spinners;
use App\Http\Controllers\user_interface\TabsPills;
use App\Http\Controllers\user_interface\Toasts;
use App\Http\Controllers\user_interface\TooltipsPopovers;
use App\Http\Controllers\user_interface\Typography;
use App\Http\Controllers\extended_ui\PerfectScrollbar;
use App\Http\Controllers\extended_ui\TextDivider;
use App\Http\Controllers\icons\MdiIcons;
use App\Http\Controllers\form_elements\BasicInput;
use App\Http\Controllers\form_elements\InputGroups;
use App\Http\Controllers\form_layouts\VerticalForm;
use App\Http\Controllers\form_layouts\HorizontalForm;
use App\Http\Controllers\tables\Basic as TablesBasic;

Route::group(['middleware' => 'guest'], function () {
  Route::controller(LoginBasic::class)->group(function () {
    Route::get('/', 'index')->name('login');
    Route::post('function', 'loginUser')->name('logoin.post');
  });

  // Main Page Route
  Route::get('/auth/register-basic', [RegisterBasic::class, 'index'])->name('auth-register-basic');
  Route::post('/register', [RegisterBasic::class, 'saveData'])->name('register');
  Route::get('/auth/forgot-password-basic', [ForgotPasswordBasic::class, 'index'])->name('auth-reset-password-basic');
  //google
  Route::post('/google', [LoginBasic::class, 'verifyGoogle'])->name('google-auth');
});

Route::group(['middleware' => 'auth'], function () {
  Route::get('/dashboard', [Analytics::class, 'index'])->name('dashboard-analytics');

  Route::get('/addreservation', [ReservationController::class, 'index'])->name('view.reservations');
  Route::post('/reservations', [ReservationController::class, 'store'])->name('add.reservations');
  Route::get('fetchReservations', [ReservationController::class, 'fetchReservations']);
  Route::get('reservations/{id}', [ReservationController::class, 'getReservation']);
  Route::put('reservations/{id}', [ReservationController::class, 'update']);
  Route::delete('reservations/{id}', [ReservationController::class, 'destroy'])->name('delete.reservation');

  Route::get('/users', [UserController::class, 'index'])->name('users');
  Route::post('/store-user', [UserController::class, 'saveusers'])->name('store-user');
  Route::get('/fetchUser', [UserController::class, 'fetchUser'])->name('fetchUser');
  Route::put('/update-user/{id}', [UserController::class, 'updateUser'])->name('updateUser');
  Route::get('/edit-user/{id}', [UserController::class, 'getUser'])->name('edit-User');
  Route::delete('/delete-user/{id}', [UserController::class, 'destroy'])->name('delete-User');

  //menu
  Route::get('/menu', [MenuController::class, 'index'])->name('menu');
  Route::get('/fetch-Menu', [MenuController::class, 'fetchMenu'])->name('fetch-Menu');

  Route::post('/logout', [LoginBasic::class, 'logout'])->name('logout');
});

// Route::middleware('auth')->group(function () {

//   //add reservation

// });
