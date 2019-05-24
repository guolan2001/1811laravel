<?php

namespace App\Http\Controllers\index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class CatController extends Controller
{
    public function index()
    {
        //$u_id=session('u_id');
        //$data = DB::table('cart')->get();
        $data =  DB::table('goods')
        ->join('cart','cart.goods_id','=','goods.goods_id')
        ->get();
        return view('index.cat.index',['data'=>$data]);
    }

    public function pay()
    {
        return view('index.cat.pay');
    }

    public function success()
    {
        return view('index.cat.success');
    }
    public function addCart()
    {
        $data = [];
        $goods_id = request()->goods_id;
        $buy_number = request()->buy_number;
        $data['user_id']=session('u_id');
        // dd($data);
        // dd($data['goods_id']);
        $data['create_time']=time();
        $cartInfo = DB::table('cart')->select('goods_id','buy_number')->where('goods_id',$goods_id)->first();
        // dd($cartInfo);
        if (!empty($cartInfo)) {
            $cartInfo = json_decode(json_encode($cartInfo),true);
        }
        // dd($cartInfo);
        if (!empty($cartInfo)) {
            // echo 111;
            $res=$this->checkGoodsNumber($goods_id,$buy_number,$cartInfo['buy_number']);
            if($res){
                $updateInfo=[
                'buy_number'=>$cartInfo['buy_number']+$buy_number,
                'update_time'=>time()
                ];
                $result=DB::table('cart')->where('goods_id',$goods_id)->update($updateInfo);
                // dd($result);
                if ($result) {
                    return ['code'=>1,'content'=>'加入购物车成功'];
                }else{
                    return ['code'=>2,'content'=>'加入购物车失败'];
                }
            }
        }else{
            // dd(1111);
            $data ['goods_id']= $goods_id;
            $data ['buy_number' ]= $buy_number;
            $res = DB::table('cart')->insert($data);
            // dd($res);
            if ($res) {
                return ['code'=>1,'content'=>'加入购物车成功'];
            }else{
                return ['code'=>2,'content'=>'加入购物车失败'];
            }
        }
    

}
    public function checkGoodsNumber($goods_id,$buy_number,$number=0)
    {
        //根据商品ID查询商品库存
        $goods_number=DB::table('goods')->where("goods_id",$goods_id)->value("goods_number");
       // echo $goods_number;exit;
       if(($buy_number+$number)>$goods_number){
           return false;
       }else{
           return true;
       }
    }
    public function getTotal()
    {
    $goods_id = request()->goods_id;
    dd($goods_id);
    //获取商品价格
    $goodsWhere = [
        ['goods_id','=',$goods_id],
        ['is_show','=',1]
    ];
   $shop_price = $goods_model->where($goodsWhere)->value('shop_price');
    //获取购买数量
    if($this->checkLogin()){
        //从数据库中获取
        $cart_model = model('Cart');
        $user_id = $this->getUserId();
        $cartWhere = [
            ['user_id','=',$user_id],
            ['goods_id','=',$goods_id],
            ['is_del','=',1]
        ];
       $buy_number = $cart_model->where($cartWhere)->value('buy_number');
    }else{
        //从cookie中获取
        $str = cookie('cartInfo');
        if(!empty($str)){
            $info = getBase64Info($str);
            foreach($info as $k=>$v){
                if($goods_id==$v['goods_id']){
                    $buy_number = $v['buy_number'];
                }
            }
        }
    }
    echo $shop_price*$buy_number;
    }

}
