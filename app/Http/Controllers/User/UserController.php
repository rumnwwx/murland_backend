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
        $cats = Cat::all();

        return response()->json($cats)->setStatusCode(200);
    }
    //МБ ПЕРЕДЕЛАТЬ НИЧЕНЕ ПОНЯТНО9(((
    public function filter(Request $request)
    {
        $query = Cat::query();

        if($request->get('gender') != null){
            $query->where('gender', $request->get('gender'));
        }

        if($request->get('breed') != null){
            $query->where('breed', $request->get('breed'));
        }

        $cats = $query->paginate(8);

        $breeds = Cat::distinct()->pluck('breed')->sort();

        return response()->json(compact('cats', 'breeds'));
    }
    public function createReview(CreateReviewRequest $request)
    {

        $validated = $request->validated();

        $review = Review::create([
            'author_name' => $validated['name'],
            'content' => $validated['comment'],
            'is_approved' => false
        ]);

        return response()->json([
            'success' => true,
            'review' => $review
        ], 201);
    }
}
