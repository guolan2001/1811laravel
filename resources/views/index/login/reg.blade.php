
@extends('layouts.shop')
@section('title','会员注册')
@section('content')

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
    <form action="{{url('login/zhece')}}" method="get" class="reg-login">
        <h3>已经有账号了？点此<a class="orange" href="login.html">登陆</a></h3>
        <div class="lrBox">
            <div class="lrList"><input type="text" name="u_name" placeholder="输入手机号码或者邮箱号" id="u_name" /></div>
            <div class="lrList2"><input type="text" name="u_yzm" placeholder="输入验证码" id="u_yzm" /> <button value="" id="yzm">获取验证码</button></div>
            <div class="lrList"><input type="password" name="u_pwd" placeholder="设置新密码（6-18位数字或字母）" id="u_pwd"/></div>
            <div class="lrList"><input type="password" name="u_rpwd" placeholder="再次输入密码" id="u_rpwd" /></div>
        </div><!--lrBox/-->
        <div class="lrSub">
            <input type="submit" id="sub" value="立即注册" />
        </div>
        <!--reg-login/-->

        @include('public/footer')


        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // 验证用户唯一性
            $('#u_name').blur(function(){
                var _this=$(this);
                var u_name=_this.val();
                if(u_name==''){
                    alert('账号不可为空');
                    return false;
                }
                var reg=/^1[3-8]\d{9}$/i;
                var reg1=/^[1-9]\d{4,10}@qq.com$/i;
                var reg2=/^[a-z1-9]\w{5,11}@163.com$/i;
                if(!reg.test(u_name)&!reg1.test(u_name)&!reg2.test(u_name)){
                    alert("请输入正确的手机或邮箱账号");
                    return false;
                }
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var flag='';
                $.ajax({
                    url:"{{url('login/checkName')}}",
                    type:'POST',
                    data:{u_name:u_name},
                    async:false,
                    success:function(res){
                        alert(res.content);
                        if(res.code==2){
                            flag="账号已被使用";
                        }
                    },
                    dataType:'json'
                });
                return flag;
            });
            //发送验证码
            $('#yzm').click(function(){
                var u_name=$('#u_name').val();
                // alert(u_name);
                if(u_name==''){
                    alert('账号不能为空');
                    return false;
                }
                $.post(
                    "{{url('login/zhuce')}}",
                    {u_name:u_name},
                    function(res){
                        alert(res.content);
                    },
                    'json'
                );
                return false;
            });
            // 提交注册
            $('#sub').click(function(){
                var u_name=$('#u_name').val();
                var u_yzm=$('#u_yzm').val();
                var u_pwd=$('#u_pwd').val();
                var u_rpwd=$('#u_rpwd').val();
                var reg=/^1[3-8]\d{9}$/i;
                var reg1=/^[1-9]\d{4,10}@qq.com$/i;
                var reg2=/^[a-z1-9]\w{5,11}@163.com$/i;
                if(!reg.test(u_name)&!reg1.test(u_name)&!reg2.test(u_name)){
                    alert("请输入正确的手机或邮箱账号");
                    return false;
                }
                if(u_name==''|u_yzm==''|u_pwd==''|u_rpwd==''){
                    alert('必填项不能为空');
                    return false;

                }
                if(u_pwd!=u_rpwd){
                    alert('两次密码输入不一致');
                    return false;

                }
                $.post(
                    "{{url('login/doreg')}}",
                    {u_name:u_name,u_yzm:u_yzm,u_pwd:u_pwd},
                    function(res){
                        alert(res.content);
                        if(res.code==1){
                            window.location.href="{{url('login/login')}}";
                        }
                    }
                );

                return false;
            });
        </script>
@endsection