<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mark extends Model {

    protected $table = "marks";
    protected $primaryKey = "id";
    protected $fillable = ["id", "description"];

}
