<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;



class StudentController extends Controller
{

  // REGISTER API
  public function register(Request $request)
  {
    // Validation
    $request->validate([
      'name' => 'required',
      'email' => 'required|email|unique:students|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
      'password' => 'required|confirmed|min:8|'
    ]);


    // Check if the entered password already exists in the database
    // $isPasswordTaken = Student::where('password', '!=', null)->get()->filter(function ($student) use ($request) {
    //   return Hash::check($request->password, $student->password);
    // })->isNotEmpty();


    $password = $request->password;
    $isPasswordTaken = Student::whereNotNull('password')
      ->get()
      ->filter(function ($student) use ($password) {
        return Hash::check($password, $student->password);
      })
      ->isNotEmpty();



    if (strlen($password) < 8) {
      return response()->json([
        "status" => 0,
        "message" => "Password must be at least 8 characters long"
      ]);
    }


    if ($isPasswordTaken) {
      return response()->json([
        "status" => 0,
        "message" => "Password already taken",
      ]);
    }

    // Create data
    $student = new Student();

    $student->name = $request->name;
    $student->email = $request->email;
    $student->password = Hash::make($request->password);
    $student->phone_no = $request->phone_no ?? "";

    $student->save();

    // Send response
    return response()->json([
      "status" => 1,
      "message" => "Student registered successfully",
      //   "isPasswordTaken" => $isPasswordTaken
    ]);
  }

  // LOGIN API
  public function login(Request $request)
  {
    // validation
    $request->validate([
      'email' => 'required | email',
      'password' => 'required',
    ]);

    // check student
    $student = Student::where('email', '=', $request->email)->first();

    if (isset($student->id)) {
      if (Hash::check($request->password, $student->password)) {
        // create a token
        $token = $student->createToken('auth_token')->plainTextToken;

        // send a response
        return response()->json([
          'status' => 1,
          'message' => 'Student logged in successfully',
          'access_token' => $token,
        ]);
      } else {
        return response()->json([
          'status' => 0,
          'message' => "Password didn't match",
        ], 404);
      }
    } else {
      return response()->json([
        'status' => 0,
        'message' => 'Student not found',
      ], 404);
    }
  }

  // PROFILE API
  public function profile()

  {

    return response()->json([
      'status' => 1,
      'message' => 'Student Profile information',
      'data' => auth()->user(),
      'information' => [
        'id' => auth()->user()->id,
        'name ' => auth()->user()->name,
        'email' => auth()->user()->email,
      ]

    ]);
  }



  // LOGOUT API
  public function logout()

  {


    // auth()->user()->tokens()->delete();

    PersonalAccessToken::where('tokenable_id', auth()->id())->delete();
    return response()->json([
      'status' => 1,
      'message' => 'Student logged out succesfully',
    ]);
  }
}
