<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateCatRequest;
use App\Http\Requests\Admin\UpdateCatRequest;
use App\Models\Cat;
use App\Models\Order;
use App\Models\OrderCat;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Reflector;

class CatController extends Controller
{
    public function __invoke(CreateCatRequest $request)
    {
        $photo = Photo::create([
            'file' => $request->file->store('images', 'public')
        ]);

        $cat = Cat::create([
            'name' => $request->name,
            'gender' => $request->gender,
            'birth_date' => $request->birth_date,
            'color' => $request->color,
            'breed_id' => $request->breed_id,
            'status' => $request->status,
            'photo_id' => $photo->id,
        ]);

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

    public function getAllOrders()
    {
        $orders = Order::get();

        foreach ($orders as $order) {

            if(OrderCat::where('id', $order->id)->count()){
                $cat = Cat::where('id', OrderCat::where('id', $order->id)->first()->cat_id)->first();
                $data[] = array(
                    'id' => $order->id,
                    'name' => $order->name,
                    'phone' => $order->phone,
                    'status' => $order->status,
                    'cat' => $cat
                );
            }
            else{
                $data[] = array(
                    'id' => $order->id,
                    'name' => $order->name,
                    'phone' => $order->phone,
                    'status' => $order->status,
                );
            }
        }

        return $data;


//        return response()->json($orders)->setStatusCode(200);
    }
}
