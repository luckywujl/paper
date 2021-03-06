<?php

namespace app\admin\controller\sale;

use app\common\controller\Backend;
use think\Db;
use app\admin\model\sale as sale;
use app\admin\model\product as product;

/**
 * 销售主管理
 *
 * @icon fa fa-circle-o
 */
class Mainlist extends Backend
{
    
    /**
     * Mainlist模型对象
     * @var \app\admin\model\sale\Mainlist
     */
    protected $model = null;
    protected $dataLimit = 'personal';
    protected $dataLimitField = 'company_id';

    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\admin\model\sale\Mainlist;
        $this->view->assign("saleStatusList", $this->model->getSaleStatusList());
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
     * 编辑
     */
    public function edit($ids = null)
    {
        $row = $this->model->get($ids);
        if (!$row) {
            $this->error(__('No Results were found'));
        }
        $adminIds = $this->getDataLimitAdminIds();
        if (is_array($adminIds)) {
            if (!in_array($row[$this->dataLimitField], $adminIds)) {
                $this->error(__('You have no permission'));
            }
        }
      
        if ($this->request->isAjax()) {
        $detail = new sale\Detaillistraft();
        list($where, $sort, $order, $offset, $limit) = $this->buildparams();
        $list = $detail
            	 ->where($where)
                ->where('detail_sale_code',$row['sale_code'])
                ->order($sort, $order)
                ->paginate($limit);
            $result = array("total" => $list->total(), "rows" => $list->items());
            return json($result);
         }
        $this->view->assign("row", $row);
        return $this->view->fetch();
    }
    /**
    *审核过账
    */
    public function verify() 
    {
    	if(!empty($this->request->post("sale_code"))) {
    		$sale_code = $this->request->post("sale_code");
    		list($where, $sort, $order, $offset, $limit) = $this->buildparams();
    		$result = 0;
    		$product = new product\Product();
    		Db::startTrans();
    		$result = $this->model
    					->where($where)
    					->where('sale_code',$sale_code)
    					->update(['sale_status'=>1,'sale_verify_person'=>$this->auth->nickname,'sale_verify_datetime'=>time()]); //已审核
    		$result = $product->where($where)->where('product_sale_code',$sale_code)->update(['product_status'=>4,'product_sale_datetime'=>time(),'product_sale_operator'=>$this->auth->nickname]);
    		
    		Db::commit();			
    		if($result) {
    			$this->success('审核成功',null,null);
    		} else{
    			$this->error('审核失败',null,null);
    		}
    	}	
    }
    
    /**
    *反审核
    */
    public function rverify() 
    {
    	if(!empty($this->request->post("sale_code"))) {
    		$sale_code = $this->request->post("sale_code");
    		list($where, $sort, $order, $offset, $limit) = $this->buildparams();
    		$result = 0;
    		$product = new product\Product();
    		Db::startTrans();
    		$result = $this->model
    					->where($where)
    					->where('sale_code',$sale_code)
    					->update(['sale_status'=>0,'sale_verify_person'=>NULL,'sale_verify_datetime'=>NULL]); //未审核
    		$result = $product->where($where)->where('product_sale_code',$sale_code)->update(['product_status'=>2,'product_sale_datetime'=>NULL,'product_sale_operator'=>NULL]);
    		Db::commit();
    		if($result) {
    			$this->success('反审核成功',null,null);
    		} else{
    			$this->error('反审核失败',null,null);
    		}
    	}	
    }
    /**
    *作废
    */
    public function cancel() 
    {
    	if(!empty($this->request->post("sale_code"))) {
    		$sale_code = $this->request->post("sale_code");
    		list($where, $sort, $order, $offset, $limit) = $this->buildparams();
    		$result = 0;
    		Db::startTrans();
    		$result = $this->model
    					->where('sale_code',$sale_code)
    					->update(['sale_status'=>3]); //已作废
    		if($result) {
    			//需将产品状态回到入库状态
    		$product = new product\Product();
    		$result = $product->where($where)->where('product_sale_code',$sale_code)->update(['product_sale_code'=>NULL,'product_status'=>1]);	
    		Db::commit();
    		if($result) {
    			
    			$this->success('完成作废',null,null);
    		} else{
    			$this->error('作废失败',null,null);
    		}	
    		} else{
    			$this->error('作废失败',null,null);
    		}
    		
    	}	
    }

    /**
    *收款
    */
    public function collection() 
    {
    	if(!empty($this->request->post("sale_code"))) {
    		$sale_code = $this->request->post("sale_code");
    		list($where, $sort, $order, $offset, $limit) = $this->buildparams();
    		$result = 0;
    		$result = $this->model
    					->where('sale_code',$sale_code)
    					->update(['sale_status'=>2,'sale_collection_person'=>$this->auth->nickname,'sale_collection_datetime'=>time()]); //已收款
    		if($result) {
    			$this->success('完成收款',null,null);
    		} else{
    			$this->error('收款失败',null,null);
    		}
    	}	
    }
}
