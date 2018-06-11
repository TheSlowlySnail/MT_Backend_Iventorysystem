<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lend extends Model
{
    public $table = "lending";
    protected $fillable = ['personid', 'annotation', 'itemid', 'startdate','enddate'];

}
