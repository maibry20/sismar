<?php

namespace App\Http\Controllers\Security;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Security\User;
use App\Models\Roles;

class UserController extends Controller {

    public function index() {
        $role = Roles::all();
        return view("security.user.init", compact("role"));
    }

    public function create() {
        return "create";
    }

    public function store(Request $request) {
        if ($request->ajax()) {
            $input = $request->all();
            unset($input["id"]);
//            $user = Auth::User();
//            $input["users_id"] = 1;
            $result = User::create($input);
            if ($result) {
                return response()->json(['success' => true]);
            } else {
                return response()->json(['success' => false]);
            }
        }
    }

    public function edit($id) {
        $record = User::FindOrFail($id);
        unset($record->password);
        return response()->json($record);
    }

    public function update(Request $request, $id) {
        $profile = User::FindOrFail($id);
        $input = $request->all();
        $result = $profile->fill($input)->save();
        if ($result) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    public function destroy($id) {
        $profile = User::FindOrFail($id);
        $result = $profile->delete();
        if ($result) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

}
