<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
  use HasFactory;

  protected $table = 'reserve';
  protected $fillable = ['user_id', 'address', 'packages', 'date'];

  public function user()
  {
    return $this->belongsTo(User::class, 'user_id'); // Specify the foreign key
  }
}