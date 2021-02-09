<?php

namespace app\admin\model\setting;

use think\Model;


class Person extends Model
{

    

    

    // 表名
    protected $name = 'setting_person';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = false;

    // 定义时间戳字段名
    protected $createTime = false;
    protected $updateTime = false;
    protected $deleteTime = false;

    // 追加属性
    protected $append = [
        'person_status_text'
    ];
    

    
    public function getPersonStatusList()
    {
        return ['0' => __('Person_status 0'), '1' => __('Person_status 1')];
    }


    public function getPersonStatusTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['person_status']) ? $data['person_status'] : '');
        $list = $this->getPersonStatusList();
        return isset($list[$value]) ? $list[$value] : '';
    }




}
