<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    //CREATE PROJECT API
    public function createProject(Request $request)
    {
        // validation
        $request->validate([
            "name" => "required",
            "description" => "required",
            "duration" => "required"

        ]);

        // student id + create data


        // send response


    }
    //LIST PROJECT API
    public function listProject()
    {
    }
    //SINGLE PROJECT API
    public function singleProject($id)
    {
    }
    //DELETE PROJECT API
    public function deleteProject($id)
    {
    }
}
