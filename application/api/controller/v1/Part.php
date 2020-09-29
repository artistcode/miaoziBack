<?php

namespace app\api\controller\v1;

use think\Controller;
use think\Request;
use app\common\controller\Base;
use app\common\model\Part as PartModel;
use app\common\validate\Jobs as JobsValidate;
class Part extends Base
{
    protected $Model;
    public function __construct(PartModel $Model){
        $this->Model =  $Model;
    }

    public function read(){
        $list  = $this->Model->fetchList();

        self::showResCode('返回成功',$list);
    }


}
