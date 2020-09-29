<?php

 Route::group('api/:version/',function(){
      Route::post('login','api/:version.Member/login');
});

