<?php

namespace app\http\middleware;

class CheckCompany
{
    public function handle($request, \Closure $next)
    {
        // 获取头部信息
        $param = $request->header();
        // 不含token
        if (!array_key_exists('token',$param)) TApiException('非法token，禁止操作',20003,200);
        // 当前用户token是否存在（是否登录）
        $token = $param['token'];
        $user = \Cache::get($token);
        $resume  = $user['company'];
        if(!$resume){
            TApiException('请填写公司信息',40001,200);
        }

        return $next($request);
    }
}
