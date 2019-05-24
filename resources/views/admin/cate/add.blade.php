<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>头部-有点</title>
    <link rel="stylesheet" type="text/css" href="/admin/css/css.css" />
    <script type="text/javascript" src="/admin/js/jquery.min.js"></script>
</head>
<body>

<form action="doadd" method="post">
    @csrf
<div id="pageAll">
    <div class="pageTop">
        <div class="page">
            <img src="/admin/img/coin02.png" />
            <span>
                <a href="#">首页</a>&nbsp;-&nbsp;
                <a href="#">公共管理</a>&nbsp;-
            </span>&nbsp;意见管理
        </div>
    </div>
    <div class="page ">
        <!-- 上传广告页面样式 -->
        <div class="banneradd bor">
            <div class="baTop">
                <span>分类管理</span>
            </div>
            <div class="baBody">
                <div class="bbD">
                    分类名称：<input type="text" name="cate_name" class="input1" />
                </div>
                <div class="bbD">所属分类：
                    <select class="input3" name="brand_id">
                        <option>--请选择--</option>

                        @foreach ($data as $v)
                            <option value="{{$v->brand_id}}">{{$v->brand_name}}</option>
                        @endforeach


                    </select>
                </div>

                <div class="bbD">
                    是否显示：<label><input type="radio" name="is_show" checked="checked" value="1"/>是</label> <label><input
                                type="radio" value="2"/>否</label>
                </div>
                <div class="bbD">
                    是否在导航栏显示：<label><input type="radio" name="is_nav_show" checked="checked" value="1"/>是</label> <label><input
                                type="radio" value="2"/>否</label>
                </div>
                <div class="bbD">
                    关键字：<input class="input2" name="keywords" type="text" />
                </div>
                <div class="bbD">商品描述：
                    <div class="btext2">
                        <textarea class="text2" name="description"></textarea>
                    </div>
                <div class="bbD">
                    <p class="bbDP">
                        <button class="btn_ok btn_yes" href="#">提交</button>
                        <a class="btn_ok btn_no" href="#">取消</a>
                    </p>
                </div>
            </div>
        </div>

        <!-- 上传广告页面样式end -->
    </div>
    </div>
</form>
</body>
</html>



