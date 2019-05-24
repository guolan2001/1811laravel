<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class user extends Model
{
    protected $table="user";
    //主键
    protected $primaryKey='user_id';
    //开启时间戳
    public $timestamps = true;
    //允许添加的字段
    protected $fillable=[
        'user_name',
        'user_pwd',
        'user_emil',
    ];
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'update_time';


}
