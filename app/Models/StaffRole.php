<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffRole extends Model
{
  use HasFactory;

  protected $table = 'staff_roles';

  protected $primaryKey = 'role_id';

  protected $fillable = [
    'role_name',
    'permission_level',
  ];
}
