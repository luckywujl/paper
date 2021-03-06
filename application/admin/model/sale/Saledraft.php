<?php

namespace app\admin\model\sale;

use think\Model;


class Saledraft extends Model
{

    

    

    // 表名
    protected $name = 'sale_main';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = false;

    // 定义时间戳字段名
    protected $createTime = false;
    protected $updateTime = false;
    protected $deleteTime = false;

    // 追加属性
    protected $append = [
        'sale_datetime_text',
        'sale_verify_datetime_text',
        'sale_collection_datetime_text',
        'sale_status_text'
    ];
    

    
    public function getSaleStatusList()
    {
        return ['0' => __('Sale_status 0'), '1' => __('Sale_status 1'), '2' => __('Sale_status 2'), '3' => __('Sale_status 3')];
    }


    public function getSaleDatetimeTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['sale_datetime']) ? $data['sale_datetime'] : '');
        return is_numeric($value) ? date("Y-m-d H:i:s", $value) : $value;
    }


    public function getSaleVerifyDatetimeTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['sale_verify_datetime']) ? $data['sale_verify_datetime'] : '');
        return is_numeric($value) ? date("Y-m-d H:i:s", $value) : $value;
    }


    public function getSaleCollectionDatetimeTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['sale_collection_datetime']) ? $data['sale_collection_datetime'] : '');
        return is_numeric($value) ? date("Y-m-d H:i:s", $value) : $value;
    }


    public function getSaleStatusTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['sale_status']) ? $data['sale_status'] : '');
        $list = $this->getSaleStatusList();
        return isset($list[$value]) ? $list[$value] : '';
    }

    protected function setSaleDatetimeAttr($value)
    {
        return $value === '' ? null : ($value && !is_numeric($value) ? strtotime($value) : $value);
    }

    protected function setSaleVerifyDatetimeAttr($value)
    {
        return $value === '' ? null : ($value && !is_numeric($value) ? strtotime($value) : $value);
    }

    protected function setSaleCollectionDatetimeAttr($value)
    {
        return $value === '' ? null : ($value && !is_numeric($value) ? strtotime($value) : $value);
    }


}
