<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateCatRequest;
use App\Http\Requests\Admin\UpdateCatRequest;
use App\Models\Cat;
use Illuminate\Http\Request;
use Illuminate\Support\Reflector;

class CatController extends Controller
{
    public function __invoke(CreateCatRequest $request)
    {

        $cat = Cat::create($request->validated());

        $data = [
            'cat' => $cat,
        ];

        return response()->json($data)->setStatusCode(200);
    }

    public function allCats()
    {

        $cats = Cat::all()->sortBy(function ($cat) {
            $statuses = [
                'available' => 0,
                'reserved' => 1,
                'adopted' => 2
            ];

            return $statuses[$cat->status];
        });


        return response()->json($cats)->setStatusCode(200);
    }

    public function viewCat($id)
    {
        $cat = Cat::find($id);

        if (!$cat) {
            return response()->json([
                'message' => 'Пост не найден',
            ], 404);
        }

        return response()->json($cat)->setStatusCode(200);
    }

    public function updateCat(UpdateCatRequest $request, $id)
    {
        $validated = $request->validated();
        $cat = Cat::findOrFail($id);
        $cat->update($validated);

        return response()->json($cat)->setStatusCode(200);
    }
    public function deleteCat($id)
    {
        $cat = Cat::findOrFail($id);
        $cat->delete($id);

        return response()->json(null)->setStatusCode(200);
    }
}
