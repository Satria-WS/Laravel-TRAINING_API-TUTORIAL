<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    //CREATE API - POST
    // http://127.0.0.1:8000/api/add-employee
    public function createEmployee(Request $request)
    {
        // validation
        $request->validate([
            "name" => "required",
            "email" => "required|email|unique:employees",
            "phone_no" => "required",
            "gender" => "required",
            "age" => "required",
        ]);

        // create data
        $employee = new Employee();

        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->phone_no = $request->phone_no;
        $employee->gender = $request->gender;
        $employee->age = $request->age;

        $employee->save();

        // send response
        return response()->json([
            "status" => 1,
            "message" => "Employee created succesfully",
        ]);

    }
    // LIST API - GET
    // http://127.0.0.1:8000/api/List-employees
    public function listEmployees()
    {
        $employees = Employee::get();
        // print_r($employees);

        return response()->json([
            "status" => 1,
            "message" => "Listing Employees",
            "data" => $employees,
        ], 200);
    }
    // SINGLE DETAIL API - GET
    // http://127.0.0.1:8000/api/single-employee/1
    public function getSingleEmployee($id)
    {
        if (Employee::where("id", $id)->exists()) {

            $employee_detail = Employee::where("id", $id)->first();
            return response()->json([
                "status" => 1,
                "message" => "Employee found",
                "data" => $employee_detail,
            ]);
        } else {
            return response()->json([
                "status" => 0,
                "message" => "Employee not found",

            ], 404);
        }
    }

    // UPDATE API - PUT
    // http://127.0.0.1:8000/api/update-employee/1
    public function updateEmployee(Request $request, $id)
    {
        if (Employee::where("id", $id)->exists()) {

            $employee = Employee::find($id);

            $employee->name = !empty($request->name) ? $request->name : $employee->name;
            $employee->email = !empty($request->email) ? $request->email : $employee->email;
            $employee->phone_no = !empty($request->phone_no) ? $request->phone_no : $employee->phone_no;
            $employee->age = !empty($request->age) ? $request->age : $employee->age;

            $employee->save();

            return response()->json([
                "status" => 1,
                "message" => "Employee updated successfully",
            ]);

        } else {
            return response()->json([
                "status" => 0,
                "message" => "Employee not found",
            ], 404);
        }
    }
    // DELETE API - DELETE
    // http://127.0.0.1:8000/api/delete-employee/10
    public function deleteEmployee($id)
    {
        if (Employee::where("id", $id)->exists()) {
            $employee = Employee::find($id);
            $employee->delete();
            return response()->json([
                "status" => 1,
                "message" => "Employee deleted succesfully",
            ]);

        } else {
            return response()->json([
                "status" => 0,
                "message" => "Employee not found",
            ], 404);
        }
    }
}
