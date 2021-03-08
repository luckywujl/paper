<?php

namespace app\admin\controller\product;

use app\common\controller\Backend;
use think\Db;
/**
 * 产品信息库
 *
 * @icon fa fa-circle-o
 */
class Product extends Backend
{
    
    /**
     * Product模型对象
     * @var \app\admin\model\product\Product
     */
    protected $model = null;
    protected $searchFields = 'product_code,product_name';
    protected $dataLimit = 'personal';
    protected $dataLimitField = 'company_id';
    protected $noNeedRight = ['printingone','printing'];

    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\admin\model\product\Product;
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
        if ($this->request->isPost()) {
            $params = $this->request->post("row/a");
            list($where, $sort, $order, $offset, $limit) = $this->buildparams();
            if ($params) {
                $params = $this->preExcludeFields($params);

                if ($this->dataLimit && $this->dataLimitFieldAutoFill) {
                    $params[$this->dataLimitField] = $this->auth->company_id;
                }
                //确定产品编号
                $main = $this->model
                ->where($where)
                ->where('product_product_datetime','between time',[date('Y-m-d 00:00:01'),date('Y-m-d 23:59:59')])
                ->order('product_code','desc')
                ->limit(1)
                ->select();
                if(count($main)>0) {
                	$item = $main[0];
                	$code = '0000'.(substr($item['product_code'],8,4)+1);
                	$code = substr($code,strlen($code)-4,4);
                	$params['product_code'] = date('Ymd').$code;
                } else {
                  $params['product_code'] = date('Ymd').'0001';
                }
                $params['product_operator']=$this->auth->nickname;//添加当前操作员信息
                $params['product_status']=1;//直接入库，如果需要增加入库流程，在此处修改为0
                $result = false;
                Db::startTrans();
                try {
                    //是否采用模型验证
                    if ($this->modelValidate) {
                        $name = str_replace("\\model\\", "\\validate\\", get_class($this->model));
                        $validate = is_bool($this->modelValidate) ? ($this->modelSceneValidate ? $name . '.add' : $name) : $this->modelValidate;
                        $this->model->validateFailException(true)->validate($validate);
                    }
                    $result = $this->model->allowField(true)->save($params);
                    Db::commit();
                    $product['product_id'] =$this->model->product_id;//产品库产品ID	
                    $this->success(null,null,$product); 
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
                    $this->error(__('No rows were inserted'));
                }
            }
            $this->error(__('Parameter %s can not be empty', ''));
        }
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
                //仅显示当天的
                ->where('product_product_datetime','between time',[date('Y-m-d 00:00:01'),date('Y-m-d 23:59:59')])
                //仅显示当班操作员的产品
                ->where('product_operator',$this->auth->nickname)
                ->order($sort, $order)
                ->paginate($limit);

            $result = array("total" => $list->total(), "rows" => $list->items());

            return json($result);
        }
        return $this->view->fetch();
    }
    
    /**
     * 批量打印
     */
    public function printing($ids = null)
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
       
        $this->view->assign("row", $row);
        return $this->view->fetch();
    }
    /**
     * 打印
     */
    public function printingone()
    {
        $params = $this->request->param();//接收过滤条件
        if(input('?product_id')) {
    	   $row = $this->model
    	   ->where('product_id',$params['product_id'])->find();
        }
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
        return $this->view->fetch("product/product/printing");
    }


}
