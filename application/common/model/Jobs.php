<?php

namespace app\common\model;

use think\Model;
use think\facade\Cache;
use think\Request;
use  app\lib\exception\BaseException as Exception;
class Jobs extends Model{

    public function member(){
        return $this->belongsTo('member');
    }
    public function JobsCategory(){
        return  $this->belongsTo('JobsCategory');
    }
    public function company(){
        return $this->belongsTo('company');
    }
    public function read(){
        $param = request()->post();
        $page = isset($param['limit']) ? $param['limit']  :  1;
          $limit = isset($param['page']) ? $param['page'] : 10;
          $data = $this
                  ->order('id desc')
                  ->with(['member','company'])
                  ->page($page,$limit)
                  ->select();
        return [ 'count'=>$this->count(),'list'=>$data];
    }
    public function createJobs(){
        $param = request()->post();
        $user  = request()->user;
        $param['company_id'] = $user['company_id'];
        $param['member_id'] = $user['id'];
        $add_status = self::create($param);
        if($add_status) new Exception(['code'=>200,'msg'=>'用户不存在','errorCode'=>20000]);
        return  $user;
    }
    public function info($id){
          $data = $this
                  ->with(['member','company'])
                  ->find($id);

       return $data;
    }

    public function recruit(){
        $data = $this->with('JobsCategory')->select();
        if($data){
            $data = $data->toArray();
            $data =array_column($data,'jobs_category');
        }
        return $data;
    }



}
