<?php

 Route::group('api/:version/',function(){
     Route::group('',function(){
         Route::get('jobs','api/:version.Jobs/read');
         Route::get('jobs/recruit','api/:version.Jobs/recruit');
         Route::get('jobs/:id','api/:version.Jobs/info');
         Route::post('jobs','api/:version.Jobs/create');
     })->middleware('CheckResume');
     Route::get('part','api/:version.Part/read');
     Route::post('work','api/:version.Resume/addWork');
     Route::post('project','api/:version.Resume/addProject');
     Route::post('education','api/:version.Resume/addEducation');
     Route::get('logout','api/:version.Member/logout');
     Route::post('resume','api/:version.Resume/create');
     Route::put('resume','api/:version.Resume/update');
     Route::delete('resume/:id','api/:version.Resume/delete');
     Route::get('resume','api/:version.Resume/read')->middleware('CheckCompany');
     Route::get('jobsCategory','api/:version.jobsCategory/read');
     Route::post('jobsCategory','api/:version.jobsCategory/create');
     Route::put('jobsCategory','api/:version.jobsCategory/update');
     Route::delete('jobsCategory:id','api/:version.jobsCategory/delete');
     Route::get('intention','api/:version.intention/read');
     Route::post('intention','api/:version.intention/create');
     Route::put('intention','api/:version.intention/update');
     Route::delete('intention:id','api/:version.intention/delete');
   Route::get('adsense','api/:version.Adsense/read');
   Route::post('upload','api/:version.Upload/save');
 })->middleware('MemberIsLogin');
 Route::group('api/:version/',function(){
  Route::post('login','api/:version.Member/login');
  Route::post('register','api/:version.Member/register');
  Route::post('sendsms','api/:version.Member/sendsms');
  Route::post('findpwd','api/:version.Member/findpwd');
});
// socket 部分
Route::group('api/:version/',function(){
    // 发送信息
    Route::post('chat/send','api/:version.Chat/send');
    // 接收未接受信息
    Route::post('chat/get','api/:version.Chat/get');
    // 绑定上线
    Route::post('chat/bind','api/:version.Chat/bind');
})->middleware('MemberIsLogin');
