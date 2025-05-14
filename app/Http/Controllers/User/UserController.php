<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateCatRequest;
use App\Http\Requests\User\CreateReviewRequest;
use App\Models\Cat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function userViewCats()
    {
        $cats = Cat::all()->where(['status' => 'available']);


        return response()->json($cats)->setStatusCode(200);
    }

}
