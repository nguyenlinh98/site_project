<?php


namespace App\Models;

use App\Models\BaseModel;

class Categories extends BaseModel
{
    protected $table = 'Categories';
    protected $fillable =['id','name','status','created_at','updated_at'];

}