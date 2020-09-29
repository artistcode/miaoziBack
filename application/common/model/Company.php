<?php

namespace app\common\model;

use think\Model;
use think\facade\Cache;
use think\Request;
use  app\lib\exception\BaseException as Exception;
class Company extends Model{
    
    public function getLogoAttr($value)
    {
        return request()->domain().$value;
    }
    
}