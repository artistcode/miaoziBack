<?php
namespace app\common\model;

use think\Model;
use think\facade\Cache;
use think\Request;
use  app\lib\exception\BaseException as Exception;
class JobsCategory extends Model{

    public function read(){
        $category = $this->select()->toArray();
        $build = [];
        foreach ($category as $item) {
            $build[$item['id']] = $item;
        }
        $tree =[];
        foreach ($build as $item) {
            if (isset($build[$item['parent']])){
              $build[$item['parent']]['children'][]=&$build[$item['id']];
            }else{
                $tree[] = &$build[$item['id']];
            }
        }
        return $tree;
    }
}



