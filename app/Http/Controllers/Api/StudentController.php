<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
  public function search(Request $request)
  {
    $query = $request->input('query');

    return Student::where('student_number', 'like', "%{$query}%")
      ->orWhere('name', 'like', "%{$query}%")
      ->with(['lessonMaster'])
      ->get();
  }
}
