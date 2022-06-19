<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
        $array = [
            'post1' => [
                'name' => '1111'
            ],
            'post2' => [
                'name' => '2222'
            ],
            'post3' => [
                'name' => '3333'
            ],
        ];
        return response()->json($array);
    }
}
