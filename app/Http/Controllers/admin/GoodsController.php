<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class GoodsController extends Controller
{
    //商品添加
    public function add()
    {
        $info = Db::table('brand')->get();
        return view('admin/goods/add',['info'=>$info]);
    }
    //添加的处理
    public function addHandle()
    {
        $data = \request()->except('_token');
        $validatedData = request()->validate([
            'goods_name' => 'required|unique:goods|max:10',
            'brand_id' => 'required',
        ],[
            'goods_name.required' => '商品名称必填',
            'goods_name.unique' => '商品已存在',
            'goods_name.max' => '商品名称不能超过10',
            'brand_id.required' => '请选择分类',
        ]);
        if(request()->hasFile('goods_img')){
            $result = $this->upload('goods_img');
            if($result['code']){
                $data['goods_img'] = $result['imgurl'];
            }
        }else{
            exit('请选择一张图片');
        }
        $res = Db::table('goods')->insert($data);
        if($res){
            return redirect('/goods/index');
        }
    }
    //文件上传方法
    public function upload($file)
    {
        if(request()->file($file)->isValid()){
            $photo = request()->file($file);
            $store_result = $photo->store(date('ymd'));
            return ['code'=>1,'imgurl'=>$store_result];
        }else{
            return ['code'=>0,'images'=>'文件上传有误'];
        }
    }
    //列表
    public function index()
    {
        $page = config('app.pageSize');
        $data = Db::table('goods')->paginate($page);

        return view('admin/goods/index',['data'=>$data]);
    }
}