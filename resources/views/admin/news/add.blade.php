<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>头部-有点</title>
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
<form action="doadd" method="post" enctype="multipart/form-data">
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
                    <span>文章</span>
                </div>
                <div class="baBody">
                    <div class="bbD">
                        文章标题：<input type="text" name="new_name" class="input1" />
                    </div>
                    <div class="bbD">文章分类：
                        <select class="input3" name="c_id">



                            @foreach ($data as $v)
                                <option value="{{$v->c_id}}">{{$v->c_name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="bbD">
                        是否显示：
                        <label><input type="radio" name="new_is_show"  value="是"/>是</label>
                        <label><input type="radio" name="new_is_show" value="否" checked="checked"/>否</label>
                    </div>
                    <div class="bbD">
                        文章的重要性：
                        <label><input type="radio" name="new_zy" checked="checked" value="普通"/>普通</label>
                        <label><input type="radio" name="new_zy" value="置顶"/>置顶</label>
                    </div>
                    <div class="bbD">
                        文章作者：<input type="text" name="new_author" class="input1" />
                    </div>
                    <div class="bbD">
                        email：<input type="text" name="new_email" class="input1" />
                    </div>
                    <div class="bbD">
                        关键字：<input class="input2" name="new_keyword" type="text" />
                    </div>
                    <div class="bbD">网页描述：
                        <div class="btext2">
                            <textarea class="text2" name="new_desc"></textarea>
                        </div>
                        <div>
                            <p>
                                上传文件：<input type="file" name="new_file">
                            </p>
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