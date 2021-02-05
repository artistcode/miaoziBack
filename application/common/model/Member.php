<?php

namespace app\common\model;

use think\Model;
use think\facade\Cache;
use  app\lib\exception\BaseException as Exception;
class Member extends Model
{
    public function Login(){
        $param  = request()->param();
        $post_user = [
         'phone'=>$param['phone'],
         'password'=>$param['password']
        ];
        $user = $this->where($post_user)->find();
        if(!$user) throw new Exception([ 'msg'=>'用户名或密码错误' 'code'=>'99999' ]);

       return $this->createToken();


    }
    public function createToken(){
          $str = md5(uniqid(md5(microtime(true)), true)); //生成一个不会重复的字符串
          $str = sha1($str); //加密
          return $str;
    }
    public function checkToken($token)
    {
        $res = $this->field('time_out')->where('token', $token)->find();
        if (!empty($res)) {
            if (time() - $res['time_out'] > 0) {
                return 90003; //token长时间未使用而过期，需重新登陆
            }
            $new_time_out = time() + 604800; //604800是七天
            $res = $user->isUpdate(true)
                ->where('token', $token)
                ->update(['time_out' => $new_time_out]);
            if ($res) {
                return 90001; //token验证成功，time_out刷新成功，可以获取接口信息
            }
        }
        return 90002; //token错误验证失败
    }

}
