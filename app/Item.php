<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public $table = "items";
    public $primaryKey="barcode";

}
