<?php
namespace app\common\model;

use think\Model;
use think\facade\Cache;
use think\Request;
use  app\lib\exception\BaseException as Exception;
class Part extends Model{

    public function fetchList(){
        $param =request()->param();
        return $this->select();

    }
}
