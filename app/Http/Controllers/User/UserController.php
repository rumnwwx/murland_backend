<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateCatRequest;
use App\Models\Cat;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function userViewCats()
    {
        $cats = Cat::all();

        return response()->json($cats)->setStatusCode(200);
    }
}
