<?php

namespace app\common\validate;
use think\Validate;
class Jobs extends Base
{
    /**
     * 定义验证规则
     * 格式：'字段名'	=>	['规则1','规则2'...]
     *
     * @var array
     */	
	protected $rule = [
        'title'=>'require', // 职位标题
        'category_id'=>'require', // 分类id
        'description'=>'require', // 职位描述
        'education'=>'require', //学历要求
        'work_time'=>'require', //工作年限
        'salary_start'=>'require',//薪资开始
        'salary_end'=>'require',//薪资结束
        'longitude'=>'require',//经度
        'latitude'=>'require', //纬度
        'house'=>'require',//门牌号
        'limit'=>'number',//门牌号
        'page'=>'number',//门牌号
    ];
    
    /**
     * 定义错误信息
     * 格式：'字段名.规则名'	=>	'错误信息'
     *
     * @var array
     */	
    protected $message = [
        
    ];

    protected $scene = [
        'create'  =>  ['title'],
        'read'=>['limit','page']
    ];
}
