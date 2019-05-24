<?php

namespace App\Http\Controllers\index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Cookie;

class LoginController extends Controller
{
    public function login()
    {
        return view('index.login.login');
    }
    public function dologin()
    {
        $data = request()->all();
        // // $u_pwd = request()->u_pwd;
        $data['u_pwd']=md5($data['u_pwd']);
        // dd($data);
        // $where= [
        //     ['u_name','=',$data['u_name']],
        //     ['u_name','=',$data['u_pwd']],
        // ];
        $u_name = request()->u_name;
        $u_pwd = request()->u_pwd;
        $u_pwd = md5($u_pwd);
        $where = [
            ['u_name','=',$u_name],
            ['u_pwd','=',$u_pwd],
        ];
        $res = DB::table('login')->where($where)->first();
        // dd($res);
        if (!empty($res)) {
            $res = json_decode(json_encode($res),true);
        }
        // $data1 = implode(",",$data);
        // dd($res);
        // $res1 = array($res);
        // dd($res);
        // dd($res);
        if($data['u_pwd'] == $res['u_pwd'] && $data['u_name']== $res['u_name']){
            session(['u_id'=>$res['u_id']]);
            return ['code'=>1,'content'=>'登录成功'];
        }else{
            return ['code'=>2,'content'=>'登录失败'];
        }
        // if($data['u_pwd'] == $res['u_pwd'] && $data['u_name']== $res['u_name']){
        //     return ['code'=>1,'content'=>'登录成功'];
        // }else{
        //     return ['code'=>2,'content'=>'登录失败'];
        // }
    }

    public function reg()
    {
        return view('index.login.reg');
    }

    //注册
    public function zhuce()
    {
        $u_name = request()->u_name;
        $code = rand('100000', '999999');
        //$message="欢迎注册铄珠宝有限公司,您的验证码是【".$code."】";

        if (substr_count($u_name, '@')) {
            $this->send($u_name, $code);
            return ['content' => '验证码发送至邮箱'];
        } else {
            $this->sendSms($u_name, $code);
            return ['content' => '验证码发送至手机'];
        }
    }
// 执行注册
    public function store()
    {
        $data=request()->all();
        $u_yzm=Cookie::get('yzm');

        if($data['u_yzm']!=$u_yzm){
            return ['code'=>2,'content'=>'验证码错误'];
        }
        $data['u_pwd']=md5($data['u_pwd']);
        $data['create_time']=time();
        $res=DB::table('login')->insert($data);
        if($res){
            return ['code'=>1,'content'=>'注册成功'];
        }else{
            return ['code'=>2,'content'=>'注册失败'];
        }
    }

    //发送短信
    public function sendSms($u_name, $code)
    {
        cookie::queue('yzm',"$code",3);
        $host = "http://dingxin.market.alicloudapi.com";
        $path = "/dx/sendSms";
        $method = "POST";
        $appcode = "db0fd6c9ec5a4174871459503e91a4e0";
        $headers = array();
        array_push($headers, "Authorization:APPCODE " . $appcode);
        $querys = "mobile=".$u_name."&param=code%3A".$code."&tpl_id=TP1711063";
        $bodys = "";
        $url = $host . $path . "?" . $querys;
    // echo $url;die;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_FAILONERROR, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        if (1 == strpos("$" . $host, "https://")) {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        }
        $data = curl_exec($curl);
        curl_close($curl);
        return $data;

    }


    //发送邮件
    public function send($u_name, $code)
    {
        //$message是\Mail的实例化 use($email)引用$email
        \Mail::raw("$code", function ($message) use ($u_name) {
            //设置主题
            $message->subject("欢迎注册大鑫商城");
            //设置接收方
            $message->to($u_name);
        });
        cookie::queue('yzm', "$code", 3);

    }
    //验证唯一性
    public function checkName()
    {
        $u_name=request()->input();
        $res=DB::table('login')->where('u_name',$u_name)->count();
        if($res){
            return ['code'=>2,'content'=>'账号已用'];
        }
    }
}
