<!DOCTYPE html>
@extends('layouts.shop')
@section('title','会员登录')
@section('content')
<body>
<div class="maincont">
    <header>
        <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
        <div class="head-mid">
            <h1>收货地址</h1>
        </div>
    </header>
    <div class="head-top">
        <img src="/index/images/head.jpg" />
    </div><!--head-top/-->
    <form action="login.html" method="get" class="reg-login">
        <div class="lrBox">
            <div class="lrList"><input type="text" placeholder="收货人" id="address_name" /></div>
            <div class="lrList"><input type="text" placeholder="详细地址" id="address_detsil" /></div>
            <div class="lrList">
                <select>

                    <option>省份/直辖市</option>


                </select>
            </div>
            <div class="lrList">
                <select>


                    <option>区县</option>


                </select>
            </div>
            <div class="lrList">
                <select>


                    <option>详细地址</option> 



                </select>
            </div>
            <div class="lrList"><input type="text" placeholder="手机" id="address_tel"/></div>
            <div class="lrList2"><input type="text" placeholder="设为默认地址"  /> <button>设为默认</button></div>
        </div><!--lrBox/-->
        <div class="lrSub">
            <input type="submit" value="保存" />
        </div>
    </form><!--reg-login/-->

    <div class="height1"></div>
    @include('public/footer')
<script>
    $('.spinnerExample').spinner({});
</script>
</body>
</html>
<script>
    $('#address_name').blur(function(){
        var address_name = $('#address_name').val();
        // alert(address_name);
    })
    $('#address_tel').blur(function(){
        var address_tel = $('#address_tel').val();
        // alert(address_tel);
    })
    $('#address_detsil').blur(function(){
        var address_detsil = $('#address_detsil').val();
        // alert(address_detsil);
    })
            $.post(
                    "{{url('address/list')}}",
                    {address_name:address_name,address_tel:address_tel,address_detsil:address_detsil},
                    function(res){
                        alert(res.content);
                        if(res.code==1){
                            // window.location.href="{{url('login/login')}}";
                        }
                    }
                );
</script>
@endsection