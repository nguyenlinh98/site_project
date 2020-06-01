<?php

namespace App\Models;

use App\Models\BaseModel;

class User extends BaseModel
{
    /**
     * @var string
     */
    protected $table = "user";
    protected $fillable =['name','email','password','status','created_at','updated_at'];
}