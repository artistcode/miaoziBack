<?php

namespace app\api\controller\v1;

use think\App;
use think\Controller;
use think\Request;
use app\common\controller\Base;
use app\common\validate\Member as MemberValidate;
use app\common\model\Member as MemberModel;
class Member extends Base
{
    protected $Model;
    public function __construct(MemberModel $Model){
        $this->Model =  $Model;
    }
    /**
    * 会员登录
    */
    public function login(MemberValidate $Validate){
        $Validate->goCheck('login');
        $list =$this->Model->login();
        return self::showResCode('登录成功',$list);
    }

    public function logout(){
        $res = $this->Model->logout();
        return self::showResCode('註銷成功',$res);
    }
    /**
     * 发送短信(验证码)
     */
    public function sendSMS(MemberValidate $Validate){
        $Validate->goCheck('senSms');
        $data =  $this->Model->sendSMS();
        return self::showResCode('获取成功',$data);
    }
    /**
     * 注册
     */
    public function register(MemberValidate $Validate){
        $Validate->goCheck('register');
        $data =  $this->Model->register();
        return self::showResCode('获取成功',$data);
    }

    /**
     * 找回密码
     */
    public function findPwd(){
        $data =  $this->Model->findPwd();
        return self::showResCode('获取成功',$data);
    }
}
