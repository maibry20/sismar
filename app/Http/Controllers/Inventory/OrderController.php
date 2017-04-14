<?php

namespace App\Http\Controllers\Inventory;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Devices;
use App\Models\Inventory\Entry;
use App\Models\Parameters;
use App\Models\Inventory\Order;
use Auth;
use DB;

class OrderController extends Controller {

    public function __construct() {
        $this->middleware("auth");
    }

    public function index() {
        $entry = DB::table("entries")
                        ->select("entries.id", "devices.description")
                        ->join("devices", "devices.id", "entries.element_id")
                        ->where("entries.status_id", 1)->get();
        return view("inventory.order.init", compact("entry"));
    }

    public function store(Request $request) {
        if ($request->ajax()) {
            $input = $request->all();
            unset($input["id"]);
            $user = Auth::User();
            $input["user_id"] = $user->id;
            $input["status_id"] = 1;
            $result = Entry::create($input);
            if ($result) {
                return response()->json(['success' => true]);
            } else {
                return response()->json(['success' => false]);
            }
        }
    }

    public function edit($id) {
        $profile = Entry::FindOrFail($id);
        return response()->json($profile);
    }

    public function update(Request $request, $id) {
        $profile = Entry::FindOrFail($id);
        $input = $request->all();
        $result = $profile->fill($input)->save();
        if ($result) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    public function reserveDevice(Request $request, $id) {
        $entry = Entry::FindOrFail($id);
        $entry->status_id = 3;
        $entry->freserve = date("Y-m-d H:i:s");
        $days = Parameters::where("group", "timeloan")->first();
        $nuevafecha = date('Y-m-d H:i:s', strtotime('+' . $days->value . ' day', strtotime(date('Y-m-d H:i:s'))));
        $entry->fdelivery = $nuevafecha;

        $inOrder["entry_id"] = $entry->id;
        $inOrder["user_id"] = Auth::user()->id;
        $inOrder["event_id"] = 1;
        Order::create($inOrder);

        $entry->save();
        return response()->json(['success' => true]);
    }

    public function deliveryDevice(Request $request, $id) {
        $entry = Entry::FindOrFail($id);
        $entry->status_id = 1;
        $entry->freserve = null;
        $entry->fdelivery = null;
        
        $inOrder["entry_id"] = $entry->id;
        $inOrder["user_id"] = Auth::user()->id;
        $inOrder["event_id"] = 2;
        $entry->save();

        return response()->json(['success' => true]);
    }

    public function destroy($id) {
        $profile = Entry::FindOrFail($id);
        $result = $profile->delete();
        if ($result) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

}
