<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    protected $table="goods";
    //主键
    protected $primaryKey='goods_id';
    //开启时间戳
    public $timestamps = true;
    //允许添加的字段
    protected $fillable=[
        'goods_name',
        'goods_img',
        'is_show',
        'brand_id'
    ];

}
