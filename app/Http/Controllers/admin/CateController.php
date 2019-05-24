<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use think\validatedData;
use DB;

class CateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageSize=config('app.pageSize');
        $data=Db::table('cate')->join('brand','cate.brand_id','=','brand.brand_id')->paginate($pageSize);
        return view('admin.cate.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        $data=Db::table('brand')->select('brand_name','brand_id')->get();
        return view('admin.cate.add',['data'=>$data]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function doadd(Request $request)
    {
        $data=$request->except(['_token']);
//        dd($data);
//        $validatedData = $request->validate([
//            'cate_name' => 'required|unique:brand|max:10',
//
//        ],[
//            'cate_name.required'=>'分类名称不能为空'
//        ]);
        $res=Db::table('cate')->insert($data);

        if($res){
            return redirect('/cate/list');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function del($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function infinite($data,$parend_id=0,$level=1)
    {
        static $arr=[];
        foreach ($data as $v){
            if($v->parend_id==$parend_id){
                $v->level=$level;
                $arr[]=$v;
                $this->infinite($data,$parend_id=0,$level=1);
            }
        }
        return $arr;
    }


}
