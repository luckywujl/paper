<?php

namespace app\admin\model\ezprint;

use think\Model;


class Example extends Model
{

    

    //数据库
    protected $connection = 'database';
    // 表名
    protected $name = 'ezprint_example';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';

    // 定义时间戳字段名
    protected $createTime = 'createtime';
    protected $updateTime = false;
    protected $deleteTime = false;

    // 追加属性
    protected $append = [

    ];
    

    







}
