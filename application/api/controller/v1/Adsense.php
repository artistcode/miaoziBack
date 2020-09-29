<?php


namespace app\api\controller\v1;

use think\Controller;
use think\Request;
use app\common\controller\Base;
use app\common\model\Adsense as AdsenseMdoel;
class Adsense extends Base{

    public function read(AdsenseMdoel $Model){
         $Adsense =  $Model->read();
         return self::showResCode('读取成功',$Adsense);
    }
}