
    <table border="1" cellspacing="0" id="tab">
        <tr>
            <th colspan="3" width="100">用户评论</th>
        </tr>
        @if($res)
            @foreach($res as $v)
                <tr>
                    <td colspan="2" align="left">{{$v->c_name}}</td><td align="right">{{$v->c_grade}}</td>
                </tr>
                <tr>
                    <td colspan="3">{{$v->c_desc}}</td>
                </tr>
            @endforeach
        @endif

    </table>
    {{$res->appends(['goods_id'=>$goods_id])->links()}}
    <!--guige/-->







