<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Vip extends Model
{
    protected $table="vip";
    //主键
    protected $primaryKey='vip_id';
    //开启时间戳
    public $timestamps = true;
    //允许添加的字段
    protected $fillable=[
        'vip_name',
        'vip_pwd',
        'vip_tel',
    ];
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'update_time';
}
