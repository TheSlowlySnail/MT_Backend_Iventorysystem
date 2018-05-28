<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property array|null|string barcode
 * @property array|null|string name
 */
class Item extends Model
{
    public $table = "items";
//    public $primaryKey="barcode";

}
