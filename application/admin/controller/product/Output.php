<?php

namespace app\admin\controller\product;

use app\common\controller\Backend;

/**
 * 产品信息库
 *
 * @icon fa fa-circle-o
 */
class Output extends Backend
{
    
    /**
     * Output模型对象
     * @var \app\admin\model\product\Output
     */
    protected $model = null;
    protected $searchFields = 'product_code,product_name';
    protected $dataLimit = 'personal';
    protected $dataLimitField = 'company_id';
   

    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\admin\model\product\Output;
        $this->view->assign("productStatusList", $this->model->getProductStatusList());
    }

    public function import()
    {
        parent::import();
    }

    /**
     * 默认生成的控制器所继承的父类中有index/add/edit/del/multi五个基础方法、destroy/restore/recyclebin三个回收站方法
     * 因此在当前控制器中可不用编写增删改查的代码,除非需要自己控制这部分逻辑
     * 需要将application/admin/library/traits/Backend.php中对应的方法复制到当前控制器,然后进行修改
     */
    /**
     * 查看
     */
    public function index()
    {
        //设置过滤方法
        $this->request->filter(['strip_tags', 'trim']);
        if ($this->request->isAjax()) {
            //如果发送的来源是Selectpage，则转发到Selectpage
            if ($this->request->request('keyField')) {
                return $this->selectpage();
            }
            list($where, $sort, $order, $offset, $limit) = $this->buildparams();

            $list = $this->model
            	 ->field('product_code,product_name,product_productweight,product_grade,product_quality,product_specs,product_unit,product_weight,product_diameter,product_broken,product_mother_code,product_storage,product_product_datetime,product_inbound_datetime,product_group,product_machine,product_QC')
                ->where($where)
                
                ->order($sort, $order)
                ->select();
                unset($list['product_id']);
            $total = $this->model
            	 //->field('product_name,product_productweight,product_grade,product_quality,product_specs,product_unit,count(*) as product_number,sum(product_weight) as product_weight')
                ->where($where)
                //->where('product_status',1)
                //->group('product_name,product_productweight,product_grade,product_quality,product_specs,product_unit')
                ->order($sort, $order)
                ->count();   
            $sum = $this->model
            	 ->field('count(*) as product_number,sum(product_weight) as product_weight')
                ->where($where)
                //->where('product_status',1)
                ->select();         
             $info =[];
             $info['product_code'] = '合计：';
             $info['product_unit'] = $sum[0]['product_number'];
             $info['product_weight'] = $sum[0]['product_weight'];
             $list [] = $info;
            $result = array("total" => $total, "rows" => $list);
            return json($result);
        }
        return $this->view->fetch();
    }

}
