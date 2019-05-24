<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>会员注册-有点</title>
    <link rel="stylesheet" type="text/css" href="/admin/css/css.css" />
    <script type="text/javascript" src="/admin/js/jquery.min.js"></script>
</head>
<body>
<div id="pageAll">
    <div class="pageTop">
        <div class="page">
            <img src="/admin/img/coin02.png" /><span><a href="#">首页</a>&nbsp;-&nbsp;<a
                        href="#">公共管理</a>&nbsp;-</span>&nbsp;会员注册
        </div>
    </div>
    @if($errors->any())
        <div>
            @foreach($errors->all() as $v)
                <p>{{$v}}</p>
            @endforeach
        </div>
    @endif
    <div class="page ">
        <!-- 会员注册页面样式 -->
        <div class="banneradd bor">
            <div class="baTopNo">
                <span>会员注册</span>
            </div>
            <div class="baBody">
                <div class="bbD">
                    用户名：<input type="text" name="vip_name"  id="vip_name" class="input3" />
                </div>

                <div class="bbD">
                    &nbsp;&nbsp;&nbsp;密码：<input type="password" name="vip_pwd"  id="vip_pwd" class="input3" />
                </div>
                <div class="bbD">
                    手机号码：<input type="text" name="vip_tel"  id="vip_tel" class="input3" />
                </div>
                @csrf
                <div class="bbD">
                    <p class="bbDP">
                        <a class="btn_ok btn_yes" href="#" id="add">提交</a> <a
                                class="btn_ok btn_no" href="#">取消</a>
                    </p>
                </div>
            </div>
        </div>

        <!-- 会员注册页面样式end -->
    </div>
</div>
</body>
<script>
    $(function(){
        $('#add').click(function(){
            var vip_name=$('#vip_name').val();
            var vip_pwd=$('#vip_pwd').val();
            var vip_tel=$('#vip_tel').val();
            var _token=$('input:hidden').val();

            $.post(
                "{{url('vip/doadd')}}",
                {vip_name:vip_name,vip_pwd:vip_pwd,vip_tel:vip_tel,_token:_token},
                function(res){
                    if(res==1){
                        window.location.href="{{url('vip/index')}}";
                    }
                }

            );
            return false;
        })
    })
</script>
</html>