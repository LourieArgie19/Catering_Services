<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
  use HasFactory;

  protected $table = 'reserve';
  protected $fillable = ['user_id', 'address', 'packages', 'date', 'is_confirmed'];

  public function user()
  {
    return $this->belongsTo(User::class, 'user_id'); // Specify the foreign key
  }

  public function getReservationDateAttribute()
  {
    return Carbon::parse($this->date)->format('F d, Y');
  }
}
