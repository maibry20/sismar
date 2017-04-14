<?php

namespace App\Http\Controllers\Administration;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Mark;
use App\Models\Devices;

class DeviceController extends Controller {

    public function index() {
        $category = Category::all();
        $mark = Mark::all();
        return view("device.init", compact("category", "mark"));
    }

    public function store(Request $request) {
        if ($request->ajax()) {
            $input = $request->all();
            unset($input["id"]);
//            $user = Auth::User();
//            $input["users_id"] = 1;
            $result = Devices::create($input);
            if ($result) {
                return response()->json(['success' => true]);
            } else {
                return response()->json(['success' => false]);
            }
        }
    }

    public function edit($id) {
        $profile = Devices::FindOrFail($id);
        return response()->json($profile);
    }

    public function update(Request $request, $id) {
        $profile = Devices::FindOrFail($id);
        $input = $request->all();
        $result = $profile->fill($input)->save();
        if ($result) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    public function destroy($id) {
        $profile = Devices::FindOrFail($id);
        $result = $profile->delete();
        if ($result) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

}
