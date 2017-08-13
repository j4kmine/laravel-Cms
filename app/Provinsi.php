<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
class Provinsi extends Model
{
    //
     public $table = "provinsi";
    protected $fillable = ['name','culture','language','lat','lng','tourism_place','investment_oportunity','culinary','transportation','hotel','id_image'];
}
