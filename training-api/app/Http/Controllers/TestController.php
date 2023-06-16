<?php
namespace App\Http\Controllers\ExampleController;
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller {
    public function sample() {
        // echo "<h1>Hello World</h1>";
        return view("sample-view" ,[
            "name" => "Online Webtutor",
             "email" =>"sample@gmail.com"
        ]);
    }
}

