<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table="news";
    //主键
    protected $primaryKey='new_id';
    //开启时间戳
    public $timestamps = true;
    //允许添加的字段
    protected $fillable=[
        'new_name',
        'c_id',
        'new_zy',
        'new_is_show',
        'new_author',
        'new_email',
        'new_keyword',
        'new_desc',
        'new_file',

    ];
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'update_time';

}
