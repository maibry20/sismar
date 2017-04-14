<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;

class Departure extends Model {

    protected $table = "departures";
    protected $primaryKey = "id";
    protected $fillable = ["id", "entry_id", "reason_id", "user_id", "status_id", "comment"];

}
