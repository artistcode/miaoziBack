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
    public function login(MemberValidate  $validate){
        $validate->goCheck('login');
       $res=  $this->Model->Login();
        self::showResCode('返回数据成功',$res);
    }
}
