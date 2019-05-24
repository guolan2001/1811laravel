<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>添加商品</title>
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css/css.css')}}" />
    <script type="text/javascript" src="{{asset('admin/js/jquery.min.js')}}"></script>
</head>
<body>
<div id="pageAll">
    <div class="pageTop">
    </div>
    <div class="page ">
        <div class="banneradd bor">
            <div class="baTop">
                <span>添加商品</span>
            </div>
            <div class="baBody">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="addHandle" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="bbD">
                        商品名称：<input type="text" class="input1" name="goods_name"/>
                    </div>
                    <div class="bbD">
                        品牌分类：
                        <select name="brand_id">
                            <option value="" checked>请选择</option>
                            @foreach($info as $v)
                                <option value="{{$v->brand_id}}">{{$v->brand_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="bbD">
                        商品图片：
                        <div class="bbDd">
                            <div class="bbDImg">+</div>
                            <input type="file" class="file" name="goods_img"/>
                        </div>
                    </div>
                    <div class="bbD">
                        商品价格：<input type="text" class="input1" name="goods_price"/>
                    </div>
                    <div class="bbD">
                        是否上架：<label><input type="radio" checked="checked" name="is_show" value="1"/>是</label>
                        <label><input type="radio" name="is_show" value="2"/>否</label>
                    </div>
                    <div class="bbD">
                        <p class="bbDP">
                            <button class="btn_ok btn_yes">提交</button>
                            <a class="btn_ok btn_no" href="javascript:;">取消</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>