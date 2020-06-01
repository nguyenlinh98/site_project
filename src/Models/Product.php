<?php


namespace App\Models;
use App\Models\BaseModel;


class Product extends BaseModel
{
    /**
     * @var string
     */
    protected $table ='product';
    protected $fillable = ['id', 'name', 'price', 'description','status','created_at', 'updated_at'];
}