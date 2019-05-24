@extends('layouts.shop')
@section('title','珠宝非微商城')
@section('content')
    <div class="head-top">
        <img src="/index/images/head.jpg" />
        <dl>
            <dt><a href="/user/userinfo"><img src="/index/images/touxiang.jpg" /></a></dt>
            <dd>
                <h1 class="username">鑫商城</h1>
                <ul>
                    <li>
                        <a href="/index/goods/dogoods">
                            <strong>34</strong>
                            <p>全部商品</p>
                        </a>
                    </li>
                    <li><a href="javascript:;"><span class="glyphicon glyphicon-star-empty"></span><p>收藏本店</p></a></li>
                    <li style="background:none;"><a href="{{url('login/quit')}}"><span class="glyphicon glyphicon-picture"></span><p>退出登陆</p></a></li>
                    <div class="clearfix"></div>
                </ul>
            </dd>
            <div class="clearfix"></div>
        </dl>
    </div><!--head-top/-->
    <form action="#" method="get" class="search">
        <input type="text" class="seaText fl" />
        <input type="submit" value="搜索" class="seaSub fr" />
    </form><!--search/-->
    @if(empty($res))
        <h3>未登录</h3>
    @else
        @foreach($res as $v)
            <h3>欢迎用户{{$v->u_name}}回来</h3>
        @endforeach
    @endif
    <ul class="reg-login-click">
        <li><a href="login/login">登录</a></li>
        <li><a href="/login/reg" class="rlbg">注册</a></li>
        <div class="clearfix"></div>
    </ul><!--reg-login-click/-->
    <div id="sliderA" class="slider">
        <img src="/index/images/image1.jpg" />
        <img src="/index/images/image2.jpg" />
        <img src="/index/images/image3.jpg" />
        <img src="/index/images/image4.jpg" />
        <img src="/index/images/image5.jpg" />
    </div><!--sliderA/-->
    <ul class="pronav">
        @foreach($brand as $v)
            <li>
                <a href="/index/goods/goodslist/?brand_id={{$v->brand_id}}">{{$v->brand_name}}</a>
            </li>
        @endforeach
        <div class="clearfix"></div>
    </ul><!--pronav/-->
    <div class="index-pro1">
        @foreach($data as $v)
            <div class="index-pro1-list">
                <dl>
                    <dt><a href="/index/goods/goodsinfo/{{$v->goods_id}}"><img src="{{config('app.img_url')}}{{$v->goods_img}}" /></a></dt>
                    <dd class="ip-text"><a href="/index/goods/goodsinfo/{{$v->goods_id}}">{{$v->goods_name}}</a><span>已售：488</span></dd>
                    <dd class="ip-price"><strong>¥{{$v->goods_price}}</strong> <span>¥599</span></dd>
                </dl>
            </div>
        @endforeach
        <div class="clearfix"></div>
    </div><!--index-pro1/-->
    <div class="prolist">
        @foreach($data as $v)
            <dl>
                <dt><a href="/index/goods/goodsinfo/{{$v->goods_id}}"><img src="{{config('app.img_url')}}{{$v->goods_img}}" width="100" height="100" /></a></dt>
                <dd>
                    <h3><a href="/index/goods/goodsinfo/{{$v->goods_id}}">{{$v->goods_name}}</a></h3>
                    <div class="prolist-price"><strong>¥{{$v->goods_price}}</strong> <span>¥599</span></div>
                    <div class="prolist-yishou"><span>5.0折</span> <em>已售：35</em></div>
                </dd>
                <div class="clearfix"></div>
            </dl>
        @endforeach
    </div><!--prolist/-->
    <div class="joins"><a href="fenxiao.html"><img src="/index/images/jrwm.jpg" /></a></div>
    <div class="copyright">Copyright &copy; <span class="blue">这是就是三级分销底部信息</span></div>

    @include('public/footer')
@endsection
