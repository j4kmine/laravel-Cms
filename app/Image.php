<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
class Image extends Model
{
    //
    public $table = "images";
    protected $fillable = ['name','description','credit','path','tipe'];
}
