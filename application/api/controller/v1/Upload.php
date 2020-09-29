<?php


namespace app\api\controller\v1;

use think\Controller;
use think\Request;
use app\common\controller\Base;

class Upload extends Base{

    public function save(){
        $file = request()->file();
        $info = $file->move( '../uploads');
        return self::showResCode('读取成功',$info);
    }
}
