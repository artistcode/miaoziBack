<?php

namespace app\api\controller\v1;

use think\Controller;
use think\Request;
use app\common\controller\Base;
use app\common\model\Jobs as JobsMdoel;
use app\common\validate\Jobs as JobsValidate;
class Jobs extends Base
{
    protected $Model;
    public function __construct(JobsMdoel $Model){
        $this->Model =  $Model;
    }
    public function read(JobsValidate  $validate){
        $validate->goCheck('read');
        $Jobs = $this->Model->read();
        return self::showResCode('读取成功',$Jobs);
    }
    public function create(JobsValidate $validate){
        $validate->goCheck('create');
        $Jobs = $this->Model->createJobs();
        return self::showResCode('发布成功',$Jobs);
    }
    public function add(){

    }
    public function update(){

    }
    public function delete(){

    }

    public function recruit(){
      $data = $this->Model->recruit();
      return self::showResCode('获取成功',$data);
    }

    public function info($id){

        $info = $this->Model->info($id);

        return self::showResCode('返回成功',$info);
    }


}
