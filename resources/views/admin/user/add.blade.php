<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>添加用户-有点</title>
    <link rel="stylesheet" type="text/css" href="/admin/css/css.css" />
    <script type="text/javascript" src="/admin/js/jquery.min.js"></script>
</head>
<body>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div id="pageAll">
    <div class="pageTop">
        <div class="page">
            <img src="/admin/img/coin02.png" /><span><a href="#">首页</a>&nbsp;-&nbsp;<a
                        href="#">公共管理</a>&nbsp;-</span>&nbsp;意见管理
        </div>
    </div>
    <div class="page ">
        <!-- 会员注册页面样式 -->
        <div class="banneradd bor">
            <div class="baTopNo">
                <span>会员注册</span>
            </div>
            <div class="baBody">
                <div class="bbD">
                    &nbsp;&nbsp;&nbsp;用户名：<input type="text" name="user_name" class="input3" id="user_name"/>
                </div>
                <div class="bbD">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;密码：<input type="password" name="user_pwd" id="user_pwd" class="input3" />
                </div>
                <div class="bbD">
                    用户邮箱：<input type="text" name="user_emil" id="user_emil" class="input3" />
                </div>
                {{csrf_field()}}
                <div class="bbD">
                    <p class="bbDP">
                        <button class="btn_ok btn_yes" href="#" id="add">提交</button>
                        <a class="btn_ok btn_no" href="#">取消</a>
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
            var user_name=$('#user_name').val();
            var user_pwd=$('#user_pwd').val();
            var user_emil=$('#user_emil').val();
            var _token=$('input:hidden').val();

            $.post(
                "{{url('user/doadd')}}",
                {user_name:user_name,user_pwd:user_pwd,user_emil:user_emil,_token:_token},
                function(res){
                    if(res==1){
                        window.location.href="{{url('user/index')}}";
                    }
                },
                'json'
            );
            return false;
        })
    })
</script>
</html>
