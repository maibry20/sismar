<?php

namespace App\Http\Controllers\Inventory;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Inventory\Departure;
use App\Models\Parameters;
use App\Models\Devices;
use App\Models\Inventory\Entry;
use DB;
use Auth;

class DepartureController extends Controller {

    public function index() {
        $entry = DB::table("entries")
                        ->select("entries.id", "devices.description")
                        ->join("devices", "devices.id", "entries.element_id")
                        ->where("entries.status_id", 1)->get();
        $reason = Parameters::where("group", "reason")->get();

        return view("inventory.departure.init", compact("reason", "entry"));
    }

    public function store(Request $request) {
        if ($request->ajax()) {
            $input = $request->all();
            unset($input["id"]);
            $user = Auth::User();
            $input["user_id"] = $user->id;
            $input["status_id"] = 1;
            $result = Departure::create($input)->id;
            if ($result) {
                $ent = Entry::findOrFail($input["entry_id"]);
                $ent->status_id = 4;
                $ent->departure_id = $result;
                $ent->save();
                return response()->json(['success' => true]);
            } else {
                return response()->json(['success' => false]);
            }
        }
    }

    public function edit($id) {
        $profile = Departure::FindOrFail($id);
        return response()->json($profile);
    }

    public function update(Request $request, $id) {
        $profile = Departure::FindOrFail($id);
        $input = $request->all();
        $result = $profile->fill($input)->save();
        if ($result) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    public function destroy($id) {
        $profile = Departure::FindOrFail($id);
        $result = $profile->delete();
        if ($result) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

}
