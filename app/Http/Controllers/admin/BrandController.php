<?php

namespace App\Http\Controllers\admin;

use App\Http\Requests\StoreBlogPost;
use Illuminate\Http\Request;
use DB;
use App\model\Brand;
use Illuminate\Support\Facades\Cookie;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use think\response\Redirect;
use Illuminate\Validation\Rule;


class BrandController extends Controller
{
    public function list()
    {
        Cookie::queue(Cookie::forget('name'));
        echo Cookie::get('name');

        $query=request()->all();
        $where=[];
        if($query['brand_name']??''){
            $where[]=['brand_name','like',"%$query[brand_name]%"];
        }
        if($query['brand_url']??''){
            $where['brand_url']=$query['brand_url'];
        }
        $pageSize=config('app.pageSize');
        DB::connection()->enableQueryLog();
        $data =  DB::table('brand')->where($where)->orderBy('brand_id', 'desc')->paginate($pageSize);
        //$data =  Brand::where($where)->orderBy('brand_id', 'desc')->paginate($pageSize);
        $logs = DB::getQueryLog();
        return view('admin.brand.list',['data'=>$data,'query'=>$query]);
    }

    public function add()
    {
        Cookie::queue('name','ss',3);
        return view('admin.brand.add');
    }

    //第二种表单请求验证
    //public function doadd(StoreBlogPost $request)
    public function doadd(Request $request)
    {
        $data=$request->except(['_token']);
        //第三种手动创建验证器
        $validator = \Validator::make($request->all(), [
            'brand_name' => 'required|unique:brand|max:10',
            'brand_logo' => 'required',
            'brand_desc' => 'required',
            'brand_url' => 'required',
        ],[
            'brand_name.required'=>'品牌名称不能为空',
            'brand_name.unique'=>'品牌名称不能重复',
            'brand_name.max'=>'品牌名称长度不能10位',
            'brand_logo.required'=>'品牌logo不能为空',
            'brand_desc.required'=>'品牌描述不能为空',
            'brand_url.required'=>'品牌网址不能为空',
        ]);
        if ($validator->fails()) {
            return redirect('brand/add')
                ->withErrors($validator)
                ->withInput();
        }
        //第一种表单验证
/*        $validatedData = $request->validate([
            'brand_name' => 'required|unique:brand|max:10',
            'brand_logo' => 'required',
            'brand_desc' => 'required',
            'brand_url' => 'required',
        ],[
            'brand_name.required'=>'品牌名称不能为空',
            'brand_name.unique'=>'品牌名称不能重复',
            'brand_name.max'=>'品牌名称长度不能10位',
            'brand_logo.required'=>'品牌logo不能为空',
            'brand_desc.required'=>'品牌描述不能为空',
            'brand_url.required'=>'品牌网址不能为空',
        ]);*/
        //先判断文件是否存在
        if ($request->hasFile('brand_logo')) {
            //存在调用upload方法
            $res=$this->upload($request,'brand_logo');
            //判断code是否正确
            if($res['code']){
                //把图片路径赋值给$data
                $data['brand_logo']=$res['imgurl'];
            }
        }

        $res=Db::table('brand')->insert($data);
        //$brand=Brand::created($data);
        //$brand=Brand::insert($data);
        if($res){
            return redirect('/brand/list');
        }
    }

    public function upload(Request $request, $flie)
    {
        //判断上传过程中是否出错
        if ($request->file($flie)->isValid()) {
            //获取上传文件的值
            $photo=$request->file($flie);

            //创建文件目录
            $store_result=$photo->store(date('Ymd'));
            return ['code'=>1,'imgurl'=>$store_result];
        }else{
            return ['coed'=>0,'message'=>'上传过程出错'];
        }


    }

    public function edit($id)
    {
        $cate=DB::table('cate')->get();
        //无限极分类
        $this->createTree($cate);
        $data=DB::table('brand')->where('brand_id',$id)->first();
        return view('admin.brand.edit',compact('data'));
    }

    public function createTree($data,$parent_id=0,$level=1)
    {
        if(!$data || !is_array($data)){
            return;
        }
        static $newdata=[];
        foreach ($data as $v){
            if($v->parent_id==$parent_id){
                $v->level=$level;
                $newdata[]=$v;
                $this->createTree($data,$v->cate_id,$level+1);
            }
        }
        return $newdata;
    }

    public function doedit(Request $request)
    {
        $id=request()->brand_id;
//        dd($id);
        $data=request()->except('_token');
//        dd($data);
        $validator = \Validator::make($data,
            [
                'brand_name'=>'required|max:10',
                Rule::unique('brand')->ignore($id,'brand_id'),
            ],
            [
                'brand_logo'=>'required',
                'brand_url'=>'required',
                'brand_desc'=>'required',
            ],
            [
                'brand_name.required'=>'品牌名称必填',
                'brand_name.unique'=>'品牌名称不能重复',
                'brand_name.max'=>'品牌名称最大为10',
                'brand_logo.required'=>'图片必填',
                'brand_url.required'=>'网址必填',
                'brand_desc.required'=>'描述必填',
            ]);

        if($validator->fails()){
            return redirect('brand/edit'.$id)->withErrors($validator)->withInput();
        }
        if($request->hasFile('brand_logo')){
            $res=$this->upload($request,'brand_logo');
                if($res['code']){
                    $data['brand_logo']=$res['imgurl'];
                }
        }

        $res=Brand::where('brand_id',$id)->update($data);
//        dd($res);
        if($res){
            return redirect('/brand/list');

        }else{
            return redirect('/brand/list');
        }
    }

    public function del($id)
    {
//        dd($id);
        $res=Brand::destroy($id);
        if($res){
            return ['code'=>1,'msg'=>'删除成功'];
        }else{
            return ['code'=>0,'msg'=>'删除失败'];
        }
    }


//    public function sendemail(){
//        $email =  request()->email;
//        $this->send($email);
//
//    }
//
//    public function send($email){
//        \Mail::send('email',['name'=>$email] ,function($message)use($email){
//            //设置主题
//            $message->subject("欢迎注册");
//            //设置接收方
//            $message->to($email);
//        });
//    }

    public function sendemail(){
        $email =  request()->email;
        $this->send($email);

    }

    public function send($email){
        \Mail::raw('郭岚',function($message)use($email){
            //设置主题
            $message->subject("欢迎注册");
            //设置接收方
            $message->to($email);
        });
    }

    public function logindo()
    {
        $pwd=request()->password;
        $email=request()->email;

        if(Auth::attempt(['email'=>$email,'password'=>$pwd])){
            dump(Auth::user());
//            dd(Auth::id());
           return redirect('brand/add');
        }else{
            return '登陆失败';
        }
    }
}
