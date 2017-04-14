<?php

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | This file is where you may define all of the routes that are handled
  | by your application. Just tell Laravel the URIs it should respond
  | to using a Closure or controller method. Build something great!
  |
 */

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::resource('/role', 'Security\RoleController');
Route::resource('/mark', 'Administration\MarkController');
Route::resource('/category', 'Administration\CategoryController');
Route::resource('/device', 'Administration\DeviceController');
Route::resource('/entry', 'Inventory\EntryController');
Route::resource('/departure', 'Inventory\DepartureController');
Route::resource('/parameters', 'Administration\ParametersController');
Route::resource('/order', 'Inventory\OrderController');
Route::resource('/user', 'Security\UserController');
Route::put('/order/reserve/{id}', 'Inventory\OrderController@reserveDevice');
Route::put('/order/delivery/{id}', 'Inventory\OrderController@deliveryDevice');


Route::get('/history', 'Administration\HistoryController@index');


Route::get('/api/listRole', function() {
    return Datatables::eloquent(\App\Models\Roles::query())->make(true);
});
Route::get('/api/listMark', function() {
    return Datatables::eloquent(\App\Models\Mark::query())->make(true);
});
Route::get('/api/listCategory', function() {
    return Datatables::eloquent(\App\Models\Category::query())->make(true);
});

Route::get('/api/listHistory', function() {
    return Datatables::queryBuilder(
                    DB::table("orders")
                            ->select("orders.id", "users.name as user", "devices.description as element", "orders.created_at", "parameters.description as event")
                            ->join("users", "users.id", "orders.user_id")
                            ->join("entries", "entries.id", "orders.entry_id")
                            ->join("devices", "devices.id", "entries.element_id")
                            ->join("parameters", "parameters.code", DB::raw("orders.event_id and parameters.group='event'"))
            )->make(true);
});
Route::get('/api/listEntry', function() {
    return Datatables::queryBuilder(
                    DB::table("entries")
                            ->select("entries.id", "devices.description as device", "entries.serial", "users.name as user", "entries.created_at as entry", "categories.description as category", "parameters.description as status")
                            ->join("devices", "devices.id", "entries.element_id")
                            ->join("categories", "categories.id", "devices.category_id")
                            ->join("users", "users.id", "entries.user_id")
                            ->join("parameters", "parameters.code", DB::raw("entries.status_id and parameters.group='generic'"))
            )->make(true);
});
Route::get('/api/listDeparture', function() {
    return Datatables::queryBuilder(
                    DB::table("departures")
                            ->select("departures.id", "devices.description as device", "users.name as user", "departures.created_at as departure", "categories.description as category", DB::raw("status.description as status"), "departures.comment", DB::raw("reason.description as reason"))
                            ->join("devices", "devices.id", "departures.entry_id")
                            ->join("categories", "categories.id", "devices.category_id")
                            ->join("users", "users.id", "departures.user_id")
                            ->join("parameters as status", DB::raw("status.id"), DB::raw("departures.status_id and status.group='generic'"))
                            ->join("parameters as reason", DB::raw("reason.code"), DB::raw("departures.reason_id and reason.group='reason'"))
            )->make(true);
});


Route::get('/api/listDevice', function() {
    return Datatables::queryBuilder(
                    DB::table("devices")
                            ->select("devices.id", "devices.description", "categories.description as category", "marks.description as mark")
                            ->join("categories", "categories.id", "devices.category_id")
                            ->join("marks", "marks.id", "devices.mark_id")
            )->make(true);
});
Route::get('/api/listParameter', function() {
    return Datatables::queryBuilder(
                    DB::table('parameters')->orderBy("id", "asc")
            )->make(true);
});

Route::get('/api/listOrder', function() {
    return Datatables::queryBuilder(
                    DB::table("entries")
                            ->select("entries.id", "entries.status_id", "devices.description as device", "entries.serial", "users.name as user", "entries.created_at as order", "categories.description as category", "parameters.description as status", "entries.freserve", "entries.fdelivery")
                            ->join("devices", "devices.id", "entries.element_id")
                            ->join("categories", "categories.id", "devices.category_id")
                            ->join("users", "users.id", "entries.user_id")
                            ->join("parameters", "parameters.id", DB::raw("entries.status_id and parameters.group='generic'"))
                            ->whereIn("entries.status_id", array(1, 3))
            )->make(true);
});

Route::get('/api/listUser', function() {
    return Datatables::queryBuilder(
                    DB::table("users")
                            ->select("users.id", "users.name", "users.email","roles.description as role")
                            ->join("roles", "roles.id", "users.role_id")
            )->make(true);
});
