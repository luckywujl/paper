<?php

namespace app\admin\controller\sale;

use app\common\controller\Backend;
use think\Db;
use app\admin\model\sale as sale;
use app\admin\model\product as product;

/**
 * 销售明细
 *
 * @icon fa fa-circle-o
 */
class Detaillist extends Backend
{
    
    /**
     * Detaillist模型对象
     * @var \app\admin\model\sale\Detaillist
     */
    protected $model = null;
    //protected $searchFields = 'custom,custom_contact,custom_tel';
    protected $dataLimit = 'personal';
    protected $dataLimitField = 'company_id';
    //protected $noNeedRight = ['index'];

    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\admin\model\sale\Detaillist;

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
        list($where, $sort, $order, $offset, $limit) = $this->buildparams();
            $sale_main_temp = new sale\Mainlisttemp();
            $mainlist_temp = $sale_main_temp
            	->where($where)
            	->where(['sale_operator'=>$this->auth->nickname])
            	->find();
        if ($this->request->isAjax()) {
            //如果发送的来源是Selectpage，则转发到Selectpage
            if ($this->request->request('keyField')) {
                return $this->selectpage();
            }
            $list = $this->model
            	 //->field('product_name as detail_product_name,product_productweight as detail_product_productweight,product_grade as detail_grade ,product_quality as detail_quality,product_specs as detail_specs,product_unit as detail_unit,sum(product_weight) as detail_weight')
                ->where($where)
                ->where('detail_sale_id',$mainlist_temp['sale_id'])
                //->group('product_name,product_productweight,product_grade,product_quality,product_specs,product_unit')
                ->order($sort, $order)
                ->paginate($limit);
            $result = array("total" => $list->total(), "rows" => $list->items());
            return json($result);
        }
        $this->view->assign("row", $mainlist_temp);       
        return $this->view->fetch();
    }
    
    /**
     * 打开草稿
     */
    public function open()
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
                ->where($where)
                ->where('detail_sale_id',1)
                ->order($sort, $order)
                ->paginate($limit);

            $result = array("total" => $list->total(), "rows" => $list->items());

            return json($result);
        }
        return $this->view->fetch("sale/detaillist/index");
    }
    
    /**
     * 新建
     */
    public function new()
    {
				$main = new sale\Mainlisttemp();
				$main_info = $main
					 ->where(['sale_operator'=>$this->auth->nickname,'company_id'=>$this->auth->company_id])
					 ->select();
				$sale_id = array_column($main_info,'sale_id');	
				$result = 0;             
            Db::startTrans();
            $result = $this->model
                ->where('detail_sale_id','IN',$sale_id)
                ->delete();//删除临时子表
            $result = $main
					 ->where(['sale_operator'=>$this->auth->nickname,'company_id'=>$this->auth->company_id])
					 ->delete();//删除临时父表
				$params=[];
				$params['sale_operator'] = $this->auth->nickname;
				$params['company_id'] = $this->auth->company_id;
				$params['sale_number'] = 0;
				$params['sale_weight'] = 0;
				$params['sale_price'] = 0;
				$params['sale_amount'] = 0;	 
				$result = $main->save($params);	 
            Db::commit();
            $sale_id =$main->sale_id;//产品库产品ID	
            if ($result) {
                        //$this->success();
                        $this->success('新建单据',null,$sale_id);
                    } else {
                        $this->error(__('No rows were delete'));
                    }

    }
    
    /**
     * 扫码
     */
    public function input()
    {
    	  //设置过滤方法
        $this->request->filter(['strip_tags', 'trim']);
        $params = $this->request->param();//接收过滤条件
        if(input('?sale_id')) {
        if ($this->request->isAjax()) {          
            list($where, $sort, $order, $offset, $limit) = $this->buildparams();           
				$product = new product\Product();
            $list = $product
                ->where($where) 
                ->where('product_sale_code',$params['sale_id'])//仅显示销售单号等于主表id的记录
                ->order($sort, $order)
                ->paginate($limit);
            $result = array("total" => $list->total(), "rows" => $list->items());
            return json($result);
        }
        }  
        $this->assign('sale_id',$params['sale_id']);
        return $this->view->fetch();
    }
    
    /**
     * 暂存
     */
    public function save()
    {
        $main = new sale\Mainlisttemp();
        if ($this->request->isPost()) {
            $params = $this->request->post("row/a");
            if ($params) {
                $params = $this->preExcludeFields($params);
                $params['sale_datetime'] = strtotime($params['sale_datetime']) ? strtotime($params['sale_datetime']) : 0;
                $result = false;
				    $result = $main
                    		->where('sale_id',$params['sale_code'])
                    		->update($params);
                if ($result !== false) {
                    $this->success('已暂存！');
                } else {
                    $this->error(__('No rows were updated'));
                }
            }  
        }
    }
    
    /**
     * 保存草稿
     */
    public function savedraft()
    {
        $sale_main_temp = new sale\Mainlisttemp();
        $sale_main = new sale\Mainlist();
        list($where, $sort, $order, $offset, $limit) = $this->buildparams();
        $sale_main_temp_info = $sale_main_temp
        	//	->field('sale_code,sale_custom_name')
        		->where($where)
        		->where(['sale_operator'=>$this->auth->nickname])
        		->select();
        $params =[];		
        foreach ($params as &$vo){
        	$info = [];
           $info['sale_code'] = $vo['sale_code'];
           $info['sale_custom_name'] = $vo['sale_custom_name'];
           $info['sale_custom_address'] = $vo['sale_custom_address'];
           $info['sale_custom_tel'] = $vo['sale_custom_tel'];
           $info['sale_custom_contact'] = $vo['sale_custom_contace'];
           $params[] = $info;
        }
       //$params['sale_code']=$sale_main_temp_info['sale_code'];
       //$params['sale_datetime']=$sale_main_temp_info['sale_datetime'];
       //$params['sale_custom_id']=$sale_main_temp_info['sale_custom_id'];
       //$params['sale_custom_name']=$sale_main_temp_info['sale_custom_name'];
       //$params['sale_custom_address']=$sale_main_temp_info['sale_custom_address'];
       //$params['sale_custom_tel']=$sale_main_temp_info['sale_custom_tel'];
        $result = false;
         //$result = \think\Db::name('sale_main')->insertAll($params);
         Db::startTrans();
         $result = Db::table('paper_sale_main')->insertall($sale_main_temp_info);  
         Db::commit();
         if ($result !== false) {
              //      $this->success($sale_main_temp_info['sale_code']);
                } else {
                    $this->error(__('No rows were updated'));
                }
    }



}
