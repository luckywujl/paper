<?php

namespace app\admin\model\storage;

use think\Model;


class Product extends Model
{

    

    

    // 表名
    protected $name = 'product_product';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = false;

    // 定义时间戳字段名
    protected $createTime = false;
    protected $updateTime = false;
    protected $deleteTime = false;

    // 追加属性
    protected $append = [
        'product_product_datetime_text',
        'product_inbound_datetime_text',
        'product_sale_datetime_text',
        'product_status_text'
    ];
    

    
    public function getProductStatusList()
    {
        return ['0' => __('Product_status 0'), '1' => __('Product_status 1'), '2' => __('Product_status 2'), '3' => __('Product_status 3'), '4' => __('Product_status 4')];
    }


    public function getProductProductDatetimeTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['product_product_datetime']) ? $data['product_product_datetime'] : '');
        return is_numeric($value) ? date("Y-m-d H:i:s", $value) : $value;
    }


    public function getProductInboundDatetimeTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['product_inbound_datetime']) ? $data['product_inbound_datetime'] : '');
        return is_numeric($value) ? date("Y-m-d H:i:s", $value) : $value;
    }


    public function getProductSaleDatetimeTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['product_sale_datetime']) ? $data['product_sale_datetime'] : '');
        return is_numeric($value) ? date("Y-m-d H:i:s", $value) : $value;
    }


    public function getProductStatusTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['product_status']) ? $data['product_status'] : '');
        $list = $this->getProductStatusList();
        return isset($list[$value]) ? $list[$value] : '';
    }

    protected function setProductProductDatetimeAttr($value)
    {
        return $value === '' ? null : ($value && !is_numeric($value) ? strtotime($value) : $value);
    }

    protected function setProductInboundDatetimeAttr($value)
    {
        return $value === '' ? null : ($value && !is_numeric($value) ? strtotime($value) : $value);
    }

    protected function setProductSaleDatetimeAttr($value)
    {
        return $value === '' ? null : ($value && !is_numeric($value) ? strtotime($value) : $value);
    }


}
