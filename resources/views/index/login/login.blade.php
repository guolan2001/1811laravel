@extends('layouts.shop')
@section('title','会员登录')
@section('content')
    <div class="maincont">
        <header>
            <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
            <div class="head-mid">
                <h1>会员注册</h1>
            </div>
            <meta name="csrf-token" content="{{csrf_token()}}">
        </header>
        <div class="head-top">
            <img src="/index/images/head.jpg" />
        </div><!--head-top/-->
        <form action="user.html" method="get" class="reg-login">
            <h3>还没有三级分销账号？点此<a class="orange" href="reg.html">注册</a></h3>
            <div class="lrBox">
                <div class="lrList"><input type="text" id="u_name" placeholder="输入手机号码或者邮箱号" /></div>
                <div class="lrList"><input type="password" id="u_pwd" placeholder="输入密码" /></div>
            </div><!--lrBox/-->
            <div class="lrSub">
                <input type="button" value="立即登录" />
            </div>
            @include('public/footer')

            <script scr="{{asset('js/jquery-3.3.1.min.js')}}"></script>
            <script>

                $('input:button').click(function(){
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    // var phone = $('')
                    var u_name = $('#u_name').val();
                    var u_pwd = $('#u_pwd').val();
                    // alert(u_name);
                    $.post(
                        "{{url('login/dologin')}}",
                        {u_name:u_name,u_pwd:u_pwd},
                        function(res){
                            alert(res.content);
                            if(res.code==1){
                                window.location.href="/";
                            }
                        }
                    );
                })
            </script>
@endsection