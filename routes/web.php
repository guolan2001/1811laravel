<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
//    session(['name'=>'岚']);
    return view('index.index.index');
});

//Route::get('/goods','GoodsController@index');

//Route::get('/goods',function(){
//    return 'goods!!!';
//});

//Route::get('/form',function(){
//    return '<form action="/form_do"><input type="text" name="name"><button>提交</button></form>';
//});

//Route::get('/form_do',function(){
//    return request()->name;
//});

//Route::get('/form',function(){
//    return '<form action="/add" method="post">'.csrf_field().'<input type="text" name="name"><button>快点提交</button></form>';
//});

//Route::post('/add',function(){
//    return request()->name;
//});

//Route::match(['get','post'],'goods',function(){
//    echo 1;
//});

//Route::any('goods',function(){
//    echo 2;
//});

//Route::get('/goods/{id}',function($id){
//    echo $id;
//});

//Route::get('/goods/{id}/{name}',function($id,$name){
//    echo $id;
//    echo $name;
//});

//Route::get('/goods/{id?}',function($id){
//    echo $id;
//});

//Route::get('/goods/{id}/{name}',function($id,$name){
//    echo $id;
//    echo $name;
//})->where(['id'=>'\d+']);


//Route::get('/form',function(){
//    return '<form action="/add_do" method="post">'.csrf_field().'<input type="text" name="name"><button>快点跳过去</button></form>';
//});
//
//Route::post('/add_do',function(){
//    return request()->name;
//});

Route::prefix('/brand')->group(function(){
   Route::get('/add','admin\BrandController@add');
   Route::post('/doadd','admin\BrandController@doadd');
   Route::get('/list','admin\BrandController@list');
   Route::get('/edit/{id}','admin\BrandController@edit');
    Route::any('/doedit','admin\BrandController@doedit');
    Route::post('/del/{id}','admin\BrandController@del');

});
//Route::get('/form',function(){
//    return '<form action="/sendemail" method="post">'.csrf_field().'<input type="text" name="email"><button>提交</button></form>';
//});
Route::post('/sendemail','BrandController@sendemail');

Route::get('/form',function(){
    return '<form action="/logindo" method="post">'.csrf_field().'<input type="text" name="email">---<input type="password" name="password"><button>提交</button></form>';
});
Route::post('/logindo','BrandController@logindo');

Route::prefix('/cate')->group(function(){
    Route::get('/add','admin\CateController@add');
    Route::post('/doadd','admin\CateController@doadd');
    Route::get('/list','admin\CateController@index');
    Route::get('/edit/{id}','admin\CateController@edit');
    Route::get('/del/{id}','admin\CateController@del');

});
Route::any('indexd','admin\IndexController@index');

Route::prefix('/user')->group(function(){
    Route::get('/add','admin\UserController@add');
    Route::post('/doadd','admin\UserController@doadd');
    Route::get('/list','admin\UserController@index');
    Route::get('/del/{id}','admin\UserController@del');

});

Route::prefix('/vip')->group(function(){
    Route::get('/add','admin\VipController@add');
    Route::post('/doadd','admin\VipController@doadd');
    Route::get('/index','admin\VipController@index');
    Route::get('/edit/{id}','admin\VipController@edit');
    Route::get('/del/{id}','admin\VipController@del');

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('/news')->group(function(){
    Route::get('/add','admin\NewsController@add');
    Route::post('/doadd','admin\NewsController@doadd');
    Route::get('/index','admin\NewsController@index');
    Route::get('/detail/{id}','admin\NewsController@detail');
    Route::get('/del/{id}','admin\NewsController@del');

});

Route::prefix('/goods')->group(function(){
    Route::get('/add','admin\GoodsController@add');
    Route::post('/addHandle','admin\GoodsController@addHandle');
    Route::get('/index','admin\GoodsController@index');
    Route::get('/edit/{id}','admin\GoodsController@edit');
    Route::get('/del/{id}','admin\GoodsController@del');

});

Route::prefix('/login')->group(function(){

    Route::get('login','index\LoginController@login');
    Route::get('reg','index\LoginController@reg');
    Route::post('zhuce','index\LoginController@zhuce');
    Route::post('doreg','index\LoginController@store');
    Route::post('dologin','index\LoginController@dologin');
    Route::post('checkName','index\LoginController@checkName');

});

Route::prefix('index/goods')->group(function(){
    Route::get('/goodslist','index\GoodsController@goodslist');
    Route::any('/goodsinfo/{id}','index\GoodsController@goodsinfo');
    Route::get('/dogoods','index\GoodsController@dogoods');
    Route::any('/com','index\GoodsController@com');

});

Route::prefix('/user')->group(function(){
    Route::get('/userinfo','index\UserController@userinfo');
});

Route::prefix('index/order')->group(function(){
    Route::get('/index','index\orderController@index');
});

Route::prefix('index/address')->group(function(){
    Route::get('/index','index\AddressController@index');
    Route::get('/list','index\AddressController@list');

});

Route::prefix('index/cat')->group(function(){
    Route::get('/index','index\CatController@index');
    Route::get('/pay','index\CatController@pay');
    Route::get('/success','index\CatController@success');
    Route::post('/addCart','index\CatController@addCart');
    Route::post('/getTotal','index\CatController@getTotal');
});
Route::get('/','index\IndexController@index');

Route::prefix('test')->group(function(){
    Route::get('/index','admin\TestController@index');
    Route::get('/add','admin\TestController@add');
    Route::post('/doadd','admin\TestController@doadd');

});

Route::prefix('/shangpin')->group(function(){
    Route::get('add','ShangpinController@create');
    Route::get('list','ShangpinController@index');
    Route::post('add_do','ShangpinController@store');
    Route::get('edit/{id}','ShangpinController@edit');
    Route::post('update/{id}','ShangpinController@update');
    Route::post('del/{shang_id}','ShangpinController@destroy');
    Route::get('xiangqing/{news_id}','ShangpinController@xiangqing');

});