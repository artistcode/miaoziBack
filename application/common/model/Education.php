<?php
namespace app\common\model;

use think\Model;
use think\facade\Cache;
use think\Request;
use  app\lib\exception\BaseException as Exception;
class Education extends Model{
    public function getStartTimeAttr($value){
        return date('Y/m',$value);
    }
    public function getEndTimeAttr($value){
        return date('Y/m',$value);
    }
}
