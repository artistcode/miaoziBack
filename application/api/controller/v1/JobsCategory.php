<?php
namespace app\api\controller\v1;

use think\Controller;
use think\Request;
use app\common\controller\Base;
use app\common\model\JobsCategory as JobsCategoryMdoel;
class JobsCategory extends Base{
    protected $Model;
    public function __construct(JobsCategoryMdoel $Model){
        $this->Model =  $Model;
    }
    public function read(){
        $Category = $this->Model->read();
        return self::showResCode('读取成功',$Category);
    }
}
