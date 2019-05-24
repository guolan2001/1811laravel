<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class brand extends Model
{
    protected $table="brand";
    //主键
    protected $primaryKey='brand_id';
    //开启时间戳
    public $timestamps = false;
    //允许添加的字段
    protected $fillable=[
        'brand_name',
        'brand_url',
        'brand_logo',
        'brand_desc'
    ];

    public function getGoodsIdBy($id)
    {
        return self::find($id);
    }
}
