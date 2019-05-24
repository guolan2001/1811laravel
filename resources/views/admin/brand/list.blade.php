<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/page.css')}}" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="/admin/js/jquery-3.3.1.min.js"></script>


    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
    <meta name="csrf-token" content="{{csrf_token()}}">
</head>
<body>
<div>

    <form>
        <input type="text" name="brand_name" value="{{$query['brand_name']??''}}" placeholder="请输入名称关键字">
        <input type="text" name="brand_url" value="{{$query['brand_url']??''}}" placeholder="请输入名称网址"><button>搜索</button>
        <a href="{{url('brand/add')}}">添加</a>
    </form>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <table border="1">

        <tr>
            <td>id</td>
            <td>品牌名称</td>
            <td>品牌LOGO</td>
            <td>品牌描述</td>
            <td>品牌网址</td>
            <td>操作</td>
        </tr>
        @if($data)
            @foreach($data as $v)
                <tr>
                    <td>{{$v->brand_id}}</td>
                    <td>{{$v->brand_name}}</td>
                    <td><img src="{{config('app.img_url')}}{{$v->brand_logo}}" width="100"></td>
                    <td>{{$v->brand_desc}}</td>
                    <td>{{$v->brand_url}}</td>
                    <td>
                        <a href="javascript:;void(0);" class="del" brand_id="{{$v->brand_id}}">删除</a>
                        <a href="edit/{{$v->brand_id}}">修改</a>
                    </td>
                </tr>
            @endforeach
        @endif

    </table>

    {{$data->appends($query)->links() }}


</div>
</body>
<script>
    $('.del').click(function(){
        var brand_id=$(this).attr('brand_id');
        // alert(brand_id);
        if(!brand_id){
            alert('请选择一条记录');
        }
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
        });
        $.post('/brand/del/'+brand_id,'',function(msg){
            alert(msg.msg);
            window.location.reload();
        },
        'json');

    })
</script>
</html>
