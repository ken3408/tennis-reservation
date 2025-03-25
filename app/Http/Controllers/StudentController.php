<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
  public function search(Request $request)
  {
    $query = $request->input('query');
    return Student::where('student_number', 'like', "%{$query}%")
      ->orWhere('name', 'like', "%{$query}%")
      ->get();
  }
}
