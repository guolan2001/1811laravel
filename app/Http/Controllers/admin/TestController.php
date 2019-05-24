<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class TestController extends Controller
{
    public function add()
    {
        return view('admin.test.add');
    }

    public function doadd(Request $request)
    {
        $data=$request->except(['_koten']);

        //先判断文件是否存在
        if ($request->hasFile('img')) {
            //存在调用upload方法
            $res=$this->upload($request,'img');
            //判断code是否正确
            if($res['code']){
                //把图片路径赋值给$data
                $data['img']=$res['imgurl'];
            }
        }
        $res=Db::table('test')->create($data);
        dump($res);exit;

    }

    public function upload(Request $request ,$file){
        if ($request->file($file)->isValid()){
            $photo=$request->file($file);
            $store=$photo->store(date('Ymd'));
            return ['code'=>1,'imgurl'=>$store];
        }else{
            return ['code'=>0,'message'=>'上传出错'];
        }
    }

    public function index()
    {
        return view('admin.test.index');
    }
}
