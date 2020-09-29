<?php

namespace app\common\model;

use think\Model;
use think\facade\Cache;
use  app\lib\exception\BaseException as Exception;
class Member extends Model
{
    public function getAvatarAttr($value)
    {
        return request()->domain().$value;
    }
    public function resume(){
        return $this->hasOne('resume');
    }
    public function company(){
        return $this->hasOne('company');
    }
     // 判断用户是否存在
     public function isExist($arr=[]){
        if(!is_array($arr)) return false;
        if (array_key_exists('phone',$arr)) { // 手机号码
            $user = $this->with(['resume','company'])->where('phone',$arr['phone'])->find();
            if(!$user)throw new Exception(['code'=>200,'msg'=>'用户不存在','errorCode'=>20000]);
            return $user;
        }
        return false;
    }

    // 账号登录
    public function login(){
        // 获取所有参数
        $param = request()->param();
        // 检查用户账号类型
        $userType = $this->checkUserType($param['username']);
        // 验证用户是否存在
        $user = $this->isExist($userType);
        // 用户不存在
        if(!$user)throw new Exception(['code'=>200,'msg'=>'昵称/邮箱/手机号错误','errorCode'=>20000]);
        $is_user = $user->password  ==md5( $param['password']) ? true  : false;
        if(!$is_user) throw new Exception(['code'=>200,'msg'=>'密码错误','errorCode'=>20000]);
        // 登录成功 生成token，进行缓存，返回客户端

        $userarr = $user->toArray();
        $userarr['token'] = $this->CreateSaveToken($userarr);
        return $userarr;
    }
     // 生成并保存token
     public function CreateSaveToken($arr=[]){
        // 生成token
        $token = sha1(md5(uniqid(md5(microtime(true)),true)));
        $arr['token'] = $token;
        // 登录过期时间
        $expire =array_key_exists('expires_in',$arr) ? $arr['expires_in'] : config('api.token_expire');
        // 保存到缓存中
        if (!Cache::set($token,$arr,$expire)) throw new Exception();
        // 返回token
        return $token;
    }
    // 验证用户名是什么格式，昵称/邮箱/手机号
    public function checkUserType($data){
        $arr=[];
        // 验证是否是手机号码
        if(preg_match('^1(3|4|5|7|8)[0-9]\d{8}$^', $data)){
            $arr['phone']=$data;
            return $arr;
        }
        // 验证是否是邮箱
        if(preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/', $data)){
            $arr['email']=$data;
            return $arr;
        }
        $arr['username']=$data;
        return $arr;
    }

        public function logout(){
        $token = request()->header("token");
           $res =  Cache::rm($token);
           if(!$res)  TApiException('不存在');
        }
        public function sendSMS(){
            $mobile= request()->param('username');
            $length = 6;
            if(Cache::get($mobile))  throw new  Exception(['code'=>200,'msg'=>'你操作的太快了','errorCode'=>20000]);
            $code = rand(pow(10,($length-1)), pow(10,$length)-1);
            Cache::set($mobile,$code,60);
            return '发送成功请注意查收'.$code;
        }


        public function register(){
            $param  = request()->param();
            if (!Cache::get($param['username']))  throw new  Exception(['code'=>200,'msg'=>'请先发送验证码','code'=>20000]);
            if (Cache::get($param['username']) !=$param['code'])  throw new  Exception(['code'=>200,'msg'=>'验证码错误','code'=>20000]);
             /* 验证成功*/

            $user =  $this->create(
                 [
                     'phone'=>$param['username'],
                     'password'=>md5($param['password'])
                 ]
             );
            if ($user){
                return '注册成功';
            }

        }
        public function findPwd(){

        }

}
