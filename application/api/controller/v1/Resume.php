<?php


namespace app\api\controller\v1;

use think\Controller;
use think\Request;
use app\common\controller\Base;
use app\common\model\Resume as ResumeMdoel;
class Resume extends Base{
    protected $Model;
    public function __construct(ResumeMdoel $Model){
        $this->Model =  $Model;
    }
    public function read(){
         $resume = $this->Model->fetchList();
        return self::showResCode('获取成功',$resume);
    }
    public function create(){
         $data =  $this->Model->createResume();
        return self::showResCode('添加成功',$data);
    }

    /**
     *  添加工作经历
     */
    public function addWork(){
        $res = $this->Model->workEdit();
        return self::showResCode('添加成功',$res);
    }

    /**
     *   添加项目经历
     */
    public function addProject(){
        $res = $this->Model->projectEdit();
        return self::showResCode('添加成功',$res);
    }
    /**
     *  添加校园经历
     */
    public function addEducation(){
        $res = $this->Model->educationEdit();
        return self::showResCode('添加成功',$res);
    }


}
