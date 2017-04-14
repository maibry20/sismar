<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;

class Entry extends Model {

    protected $table = "entries";
    protected $primaryKey = "id";
    protected $fillable = ["id", "element_id",
        "serial", "user_id",
        "status_id", "departure_id", "order_id",
        "freserve", "fdelivery",
    ];

}
