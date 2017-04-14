<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;

class Order extends Model {

    protected $table = "orders";
    protected $primaryKey = "id";
    protected $fillable = ["id", "entry_id","user_id","event_id"];

}
