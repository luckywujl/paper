<?php

namespace app\admin\controller\sale;

use app\common\controller\Backend;
use think\Db;
use app\admin\model\sale as sale;
use app\admin\model\product as product;
use app\admin\model\base as base;

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
    protected $noNeedRight = ['index','new','save'];
    protected $autoWriteTimestamp = 'sale_datetime';


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
        if(input('?key')) {
        if ($this->request->isAjax()) {          
            list($where, $sort, $order, $offset, $limit) = $this->buildparams();           
				$product = new product\Product();
            $list = $product
                ->where($where) 
                ->where('product_sale_code',$params['key'])//仅显示销售单号等于主表id的记录
                ->order($sort, $order)
                ->paginate($limit);
            $result = array("total" => $list->total(), "rows" => $list->items());
            return json($result);
        }
        }  
        $this->assign('sale_id',$params['key']);
        $this->assignconfig('sale_id',$params['sale_id']);
        $this->assignconfig('key',$params['key']);
        return $this->view->fetch();
    }
    
    /**
    *扫码录入
    */
    public function scan() 
    {
    	if(!empty($this->request->post("product_code"))) {
    		$product_code = $this->request->post("product_code");
    		$sale_code = $this->request->post("sale_code");
    		list($where, $sort, $order, $offset, $limit) = $this->buildparams();
    		$product = new product\Product();
    		$product_info = $product
    									->where($where)
    									->where(['product_code'=>$product_code,'product_status'=>1]) //产品编号与产品状态均进行检查
    									->find();
    		if($product_info) {
    			$result = 0;
    			$result = $product
    							->where('product_code',$product_code)
    							->update(['product_sale_code'=>$sale_code,'product_status'=>2]);
    			if($result) {
    				$this->success('扫描成功',null,null);
    			} else{
    				$this->error('扫描成功',null,null);
    			}
    		}else {
    			//$this->error('产品不存在或状态异常，请检查',null,null);
    			$this->error($sale_code);
    		
    		}
    	}	
    }
    /**
     * 汇总明细
     */
    public function detailtotal()
    {
    	if(!empty($this->request->post("sale_id"))) {
    		//1、接收sale_code参数
    		$sale_id = $this->request->post("sale_id");
    		$sale_key = $this->request->post("key");
    		$product = new product\Product();
    		$baseproduct = new base\Product();
    		list($where, $sort, $order, $offset, $limit) = $this->buildparams();
    		//2、使用聚合查询，获取销售明细数据
    		$list = $product
            	 ->field('product_name as detail_product_name,product_productweight as detail_product_productweight,product_grade as detail_grade,product_quality as detail_quality,product_specs as detail_specs,product_unit as detail_unit,sum(product_weight) as detail_weight,count(*) as detail_number')
                ->where($where)
                ->where('product_sale_code',$sale_key)
                ->group('product_name,product_productweight,product_grade,product_quality,product_specs,product_unit')
                ->select();
          //3、删除原销售明细数据
         $this->model->where($where)->where('detail_sale_id',$sale_id)->delete();  
         //4、将销售明细数据重组 
       
         $detail = [];
         $i = 0;
         //$this->error('ERROR');
         foreach ($list as $k=>$v) {
         	
         	$i = $i + 1;
         	$info = [];
         	//4.1获以产品基础信息，价格，单位并计算出金额
         	
         	$baseinfo = $baseproduct
         			->where($where)
         			->where(['product'=>$v['detail_product_name'],'product_weight'=>$v['detail_product_productweight']])
         			->find();
         	
         	if($baseinfo) {
         		$info['detail_price'] = $baseinfo['product_price'];
         		$info['detail_unit'] = $baseinfo['product_unit'];
         		$info['detail_amount'] = sprintf("%.2f",$baseinfo['product_price']*$v['detail_weight']);
         	}
         	//4.2补齐其它信息
         	 
         	
         	$info['detail_sale_id'] = $sale_id;
         	$info['detail_no'] = $i;
         	$info['detail_product_name'] = $v['detail_product_name'];
         	$info['detail_product_productweight'] = $v['detail_product_productweight'];
         	$info['detail_grade'] = $v['detail_grade'];
         	$info['detail_quality'] = $v['detail_quality'];
         	$info['detail_specs'] = $v['detail_specs'];
         	$info['detail_weight'] = $v['detail_weight'];
         	$info['detail_number'] = $v['detail_number'];
         	$info['company_id'] = $this->auth->company_id;
         	//成生明细重量
         	$productinfo = $product
         			->where($where)
         			->where(['product_sale_code'=>$sale_key,'product_name'=>$v['detail_product_name'],'product_productweight'=>$v['detail_product_productweight'],'product_grade'=>$v['detail_grade'],'product_quality'=>$v['detail_quality'],'product_specs'=>$v['detail_specs']])
         			->select();
         	if($productinfo) {
         	
         	$info['detail_detail'] ='';		
         	foreach($productinfo as $ki=>$vo){
         		$info['detail_detail'] =$info['detail_detail'].'('.$vo['product_weight'].')';
         	}
         	
         }
         	$detail[] = $info; 
         
         }   
         $result =0;
         $result = $this->model->saveall($detail);
         $maintotal = $this->model
         					->field('sum(detail_number) as number,sum(detail_weight) as weight,sum(detail_amount) as amount')
         					->where($where)->where('detail_sale_id',$sale_id)->select();
         
         if ($result){
         	$this->success('OK',null,$maintotal);
         } else{
            $this->error('ERROR');
         }       
                
             }
    }
    /**
     * 暂存
     */
    public function save()
    {
        $sale_main_temp = new sale\Mainlisttemp();
        if ($this->request->isPost()) {
            $params = $this->request->post("row/a");
            if ($params) {
                $params = $this->preExcludeFields($params);
                $params['sale_datetime'] = strtotime($params['sale_datetime']) ? strtotime($params['sale_datetime']) : 0;
                $result = false;
				    $result = $sale_main_temp
                    		->where('sale_id',$params['sale_id'])
                    		->update($params);
                if ($result !== false) {
                    $this->success('已暂存！',null,$params['sale_code']);
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
    	 //定义模型
        $sale_main_temp = new sale\Mainlisttemp();
        $sale_main = new sale\Mainlist();
        $sale_detail = new sale\Detaillistraft();
        $product = new product\Product();
        if ($this->request->isPost()) {
            $params = $this->request->post("row/a");
            if ($params) {
                $params = $this->preExcludeFields($params);
                $params['sale_datetime'] = strtotime($params['sale_datetime']) ? strtotime($params['sale_datetime']) : 0;
                $result = false;
				    $result = $sale_main_temp
                    		->where('sale_id',$params['sale_id'])
                    		->update($params);
                if ($result) {
                    //$this->success('已暂存！');
                
    	//定义模型
       
        list($where, $sort, $order, $offset, $limit) = $this->buildparams();
        $sale_main_temp_info = $sale_main_temp
        		->where($where)
        		->where(['sale_operator'=>$this->auth->nickname])
        		->find();
        Db::startTrans();
        	$info = [];
        	//确定单号
        	if($params['sale_code']=='') {//如果保存的数据中不包含单号，则按规则新建单号
        		$main = $sale_main
       	  	  ->where('sale_datetime','between time',[date('Y-m-d 00:00:01'),date('Y-m-d 23:59:59')])
        	 	  ->where('company_id',$this->auth->company_id)
      	 	  ->order('sale_code','desc')
      	     ->limit(1)
      	     ->select();
       	 	 if(count($main)>0) {
    	    	   $item = $main[0];
    	   	   $code = '0000'.(substr($item['sale_code'],11,4)+1);
     	    	   $code = substr($code,strlen($code)-4,4);
      	  	   $info['sale_code'] = 'XS-'.date('Ymd').$code;
      	 	  } else {
      	   	$info['sale_code'] = 'XS-'.date('Ymd').'0001';
     	   	  }
      	  	}else {//如果保存的数据中包含单号，说明是已经保存的草稿
         	$info['sale_code'] = $params['sale_code'];
         	//删除原草稿，并重建
         	$sale_main
        		->where($where)
        		->where(['sale_code'=>$params['sale_code']])
        		->delete();
        		$sale_detail
        		->where($where)
        		->where(['detail_sale_code'=>$params['sale_code']])
        		->delete();
     		 }
           //保存主表到草稿
           //$info['sale_code'] = $vo['sale_code'];
           $info['sale_datetime'] =time();
           $info['sale_custom_id'] = $sale_main_temp_info['sale_custom_id'];
           $info['sale_custom_name'] = $sale_main_temp_info['sale_custom_name'];
           $info['sale_custom_address'] = $sale_main_temp_info['sale_custom_address'];
           $info['sale_custom_tel'] = $sale_main_temp_info['sale_custom_tel'];
           $info['sale_custom_contact'] = $sale_main_temp_info['sale_custom_contact'];
           $info['sale_number'] = $sale_main_temp_info['sale_number'];
           $info['sale_weight'] = $sale_main_temp_info['sale_weight'];
           $info['sale_price'] = $sale_main_temp_info['sale_price'];
           $info['sale_amount'] = $sale_main_temp_info['sale_amount'];
           $info['sale_person'] = $sale_main_temp_info['sale_person'];
           $info['sale_remark'] = $sale_main_temp_info['sale_remark'];
           $info['sale_operator'] = $sale_main_temp_info['sale_operator'];
           $info['company_id'] = $this->auth->company_id;
           $info['sale_status'] = 0;
           
           //保存子表至草稿
           $sale_detail_temp_info = $this->model
           		->where($where)
           		->where('detail_sale_id',$sale_main_temp_info['sale_id'])
           		->select();
           $details = [];
           foreach($sale_detail_temp_info as $kk=>$vv){
           		$infod = [];
           		$infod['detail_sale_code'] = $info['sale_code'];	
           		$infod['detail_no'] = $vv['detail_no'];	
           		$infod['detail_product_name'] = $vv['detail_product_name'];	
           		$infod['detail_product_productweight'] = $vv['detail_product_productweight'];	
           		$infod['detail_grade'] = $vv['detail_grade'];	
           		$infod['detail_quality'] = $vv['detail_quality'];	
           		$infod['detail_specs'] = $vv['detail_specs'];	
           		$infod['detail_unit'] = $vv['detail_unit'];	
           		$infod['detail_price'] = $vv['detail_price'];	
           		$infod['detail_weight'] = $vv['detail_weight'];
           		$infod['detail_number'] = $vv['detail_number'];	
           		$infod['detail_amount'] = $vv['detail_amount'];	
           		$infod['detail_detail'] = $vv['detail_detail'];		
           		$infod['detail_remark'] = $vv['detail_remark'];	
           		$infod['company_id'] = $vv['company_id'];	
           		$details[] = $infod;
           }
           $resultd = $sale_detail->saveAll($details); 
           //更新产品表中的sale_code及sale_datetime
           $product->where($where)->where('product_sale_code',$sale_main_temp_info['sale_id'])->update(['product_sale_code'=>$info['sale_code'],'product_sale_datetime'=>time(),'product_status'=>3]);
      	  $result = false; 
      	 //保存主表至草稿
       	 $result = $sale_main->save($info); 
       	 Db::commit();
          $sale_code =$sale_main->sale_code;//产品库产品ID	
 
        if ($result !== false) {
            $this->success($sale_code,null,$sale_code);
         } else {
            $this->error(__('No rows were updated'));
         }
         } else {
                    $this->error(__('No rows were updated'));
                }
            }  
        }
    }
    
    /**
     * 编辑
     */
    public function edit($ids =null)
    {
        if ($this->request->isPost()) {
            $params = $this->request->post("row/a");
            if ($params) {
                $params = $this->preExcludeFields($params);
                $result = false;
                Db::startTrans();
                try {              
				        $result = $this->model
                    		->where('detail_id',$params['detail_id'])
                    		->update($params);                    
                    Db::commit();
                } catch (ValidateException $e) {
                    Db::rollback();
                    $this->error($e->getMessage());
                } catch (PDOException $e) {
                    Db::rollback();
                    $this->error($e->getMessage());
                } catch (Exception $e) {
                    Db::rollback();
                    $this->error($e->getMessage());
                }
                if ($result !== false) {
                    $this->success();
                } else {
                    $this->error(__('No rows were updated'));
                }
            }
            $this->error(__('Parameter %s can not be empty', ''));
        }
        //进入编辑页面
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
        $this->view->assign("row", $row);
        return $this->view->fetch();
    }

    /**
     * 删除
     */
    public function del($ids = "")
    {
        if (!$this->request->isPost()) {
            $this->error(__("Invalid parameters"));
        }
        
        $ids = $ids ? $ids : $this->request->post("ids");
        if ($ids) {
            $pk = $this->model->getPk();
            $adminIds = $this->getDataLimitAdminIds();
            if (is_array($adminIds)) {
                $this->model->where($this->dataLimitField, 'in', $adminIds);
            }
            $list = $this->model->where($pk, 'in', $ids)->select();

            $count = 0;
            Db::startTrans();
            try {
                foreach ($list as $k => $v) {
                    $count += $v->delete();
                }
                Db::commit();
            } catch (PDOException $e) {
                Db::rollback();
                $this->error($e->getMessage());
            } catch (Exception $e) {
                Db::rollback();
                $this->error($e->getMessage());
            }
            if ($count) {
                $this->success();
            } else {
                $this->error(__('No rows were deleted'));
            }
        }
        $this->error(__('Parameter %s can not be empty', 'ids'));
    }
    
    /**
     * 汇总
     */
    public function total()
    {
       if(!empty($this->request->post("sale_id"))) {
    		//1、接收sale_code参数
    		$sale_id = $this->request->post("sale_id");
    		list($where, $sort, $order, $offset, $limit) = $this->buildparams();
    		$detail = $this->model
    						->where($where)->where('detail_sale_id',$sale_id)->select();
    		$info =[];
    		$i = 0;
    		foreach($detail as $k=>$v){
    			$i = $i+1;
    		  $infod =[];
    		  $infod['detail_id'] = $v['detail_id'];
    		  $infod['detail_no'] = $i;
    		  $info[]=$infod;
    		}
    		$this->model->saveall($info);
         $maintotal = $this->model
         					->field('sum(detail_number) as number,sum(detail_weight) as weight,sum(detail_amount) as amount')
         					->where($where)->where('detail_sale_id',$sale_id)->select();
         
         if ($maintotal){
         	$this->success(null,null,$maintotal);
         } else{
            $this->error('ERROR');
         }  
      }     
    }
    
    
}
