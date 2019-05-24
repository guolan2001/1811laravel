<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>头部-有点</title>
    <link rel="stylesheet" type="text/css" href="/admin/css/css.css" />
    <script type="text/javascript" src="/admin/js/jquery.min.js"></script>
</head>
<body>

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

                <div class="baBody">
                    <div class="bbD">
                        商品名称：<input type="text" name="name" class="input1" />
                    </div>
                    <div>
                        <p>
                            商品图片：<input type="file" name="img">
                        </p>
                    </div>
                    <div class="bbD">
                        商品数量：<input type="text" name="number" class="input1" />
                    </div>

                    <div class="btext2">
                        商品描述：<textarea name="desc" id="" cols="30" rows="10"></textarea>
                    </div>

                    <div class="bbD">
                        <p class="bbDP">
                            <button class="btn_ok btn_yes" href="#">提交</button>
                            <a class="btn_ok btn_no" href="#">取消</a>
                        </p>
                    </div>
                </div>

                <!-- 上传广告页面样式end -->
            </div>
        </div>
</form>
</body>
</html>