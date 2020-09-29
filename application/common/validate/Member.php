<?php

namespace app\common\validate;
use think\Validate;
class Member extends Base
{
    /**
     * 定义验证规则
     * 格式：'字段名'	=>	['规则1','规则2'...]
     *
     * @var array
     */
	protected $rule = [
	    'username'=>'require|mobile',
	    'code'=>'require|length:6',
        'password'=>'require|length:6,8'
    ];

    /**
     * 定义错误信息
     * 格式：'字段名.规则名'	=>	'错误信息'
     *
     * @var array
     */
    protected $message = [
        'username.require'=>'用户名必须',
        'username.mobile'=>'手机号格式错误',
        'username.unique'=>'用户名已存在',
        'code.require'=>'请填写验证码',
        'code.length'=>'请填写6位验证码',
        'password.require'=>'密码必须',
        'password.length'=>'密码长度不符合要求'
    ];

    protected $scene = [
        'senSms'  =>  ['username'],
        'login'=>['username','password'],
        'smslogin'=>['username','code']
    ];
    public function sceneRegister()
    {
        return $this->only(['username','code','password'])
            ->append('username', 'unique:member,phone');
    }


}
