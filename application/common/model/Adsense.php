<?php

namespace app\common\model;

use think\Model;
use think\facade\Cache;
use think\Request;
use  app\lib\exception\BaseException as Exception;
class Adsense extends Model{
    
    public function getImgAttr($value)
    {
        return request()->domain().$value;
    }
   public function read(){
       return $this->select();
   }
    
}