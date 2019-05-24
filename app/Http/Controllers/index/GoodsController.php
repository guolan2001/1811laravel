<?php

namespace App\Http\Controllers\index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class GoodsController extends Controller
{
    public function goodslist()
    {
        $brand_id=request()->input();
        $res=Db::table('goods')->where('brand_id',$brand_id)->get();
        return view('index.goods.goodslist',['res'=>$res]);
    }

    public function dogoods()
    {
        $goods=Db::table('goods')->get();
        return view('index.goods.dogoods',['goods'=>$goods]);
    }

    public function goodsinfo($id)
    {
        //cache(['goods_id'=>''],0);
        $data = cache('goods_'.$id);
        // dd($data);
        if(!$data){
            echo 11;
            $data=Db::table('goods')->where('goods_id',$id)->first();
            cache(['goods_'. $id=>$data],12*60);
        }
        //dd($data);
        $pagesize=config('app.pageSize');
        $res=Db::table('comment')->orderby('create_time','desc')->paginate($pagesize);
        if(request()->ajax()){
            return view('index.goods.ajaxpage',['data'=>$data,'res'=>$res,'goods_id'=>$id]);
        }
        return view('index.goods.goodsinfo',['data'=>$data,'res'=>$res,'goods_id'=>$id]);
    }

    public function com()
    {
        $date=request()->input();
        $data['create_time']=time();
        $link=Db::table('comment')->insert($date);
        if($link){
            return ['code'=>1,'msg'=>'添加成功'];
        }else{
            return ['code'=>2,'msg'=>'添加失败'];
        }

    }


}
