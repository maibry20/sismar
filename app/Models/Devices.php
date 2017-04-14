<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Devices extends Model {

    protected $table = "devices";
    protected $primaryKey = "id";
    protected $fillable = ["id", "description", "category_id", "mark_id"];

}
