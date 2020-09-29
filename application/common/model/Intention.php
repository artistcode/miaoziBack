<?php
namespace app\common\model;

use think\Model;
use think\facade\Cache;
use think\Request;
use  app\lib\exception\BaseException as Exception;
class Intention extends Model{

    public function jobsCategory(){
        return  $this->belongsTo('JobsCategory');
    }
    public function fetchList(){
        $param = \request()->user;
        $data =  $this->where('resume_id',$param['resume']['id'])->with('jobsCategory')->select();
        if($data){
            $data = $data->toArray();
            $data = array_column($data,'jobs_category');
        }

        return $data;
    }
}
