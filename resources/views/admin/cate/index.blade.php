<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>约见管理-有点</title>
    <link rel="stylesheet" type="text/css" href="/admin/css/css.css" />
    <script type="text/javascript" src="/admin/js/jquery.min.js"></script>
    <link rel="stylesheet" href="{{asset('css/page.css')}}" rel="stylesheet" type="text/css">
    <!-- <script type="text/javascript" src="js/page.js" ></script> -->
</head>

<body>
<div id="pageAll">
    <div class="pageTop">
        <div class="page">
            <img src="/admin/img/coin02.png" /><span><a href="#">首页</a>&nbsp;-&nbsp;<a
                        href="#">公共管理</a>&nbsp;-</span>&nbsp;意见管理
        </div>
    </div>

    <div class="page">
        <!-- balance页面样式 -->
        <div class="connoisseur">
            <div class="conform">
                <button><a href="{{url('cate/add')}}">添加</a></button>
            </div>
            <!-- bbalance 表格 显示 -->
            <div class="conShow">
                <table border="1" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="66px" class="tdColor tdC">序号</td>
                        <td width="255px" class="tdColor">分类名称</td>
                        <td width="210px" class="tdColor">所属分类</td>
                        <td width="235px" class="tdColor">是否显示</td>
                        <td width="245px" class="tdColor">是否在导航栏显示</td>
                        <td width="280px" class="tdColor">关键字</td>
                        <td width="380px" class="tdColor">商品描述</td>
                        <td width="380px" class="tdColor">操作</td>
                    </tr>
                    @foreach ($data as $v)
                    <tr>
                        <td width="380px" >{{$v->cate_id}}</td>
                        <td width="380px" >{{$v->cate_name}}</td>
                        <td width="380px" >{{$v->brand_name}}</td>
                        <td width="380px" >{{$v->is_show}}</td>
                        <td width="380px" >{{$v->is_nav_show}}</td>
                        <td width="380px" >{{$v->keywords}}</td>
                        <td width="380px" >{{$v->description}}</td>
                        <td width="380px" >
                            <a href="cate/del">删除</a>
                            <a href="">修改</a>
                        </td>
                    </tr>
                    @endforeach
                </table>
                {{$data->links() }}
            </div>
            <!-- balance 表格 显示 end-->
        </div>
        <!-- balance页面样式end -->
    </div>

</div>

</body>

</script>
</html>