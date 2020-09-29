<?php

namespace app\api\controller\v1;

use think\Controller;
use think\Request;
use app\common\controller\Base;
use app\common\model\Intention as IntentionMdoel;
class Intention extends Base
{
    protected $Model;
    public function __construct(IntentionMdoel $Model){
        $this->Model =  $Model;
    }
    public function read(){
        $Intention = $this->Model->fetchList();
        return self::showResCode('读取成功',$Intention);
    }


}
