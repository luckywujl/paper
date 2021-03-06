<?php

namespace app\admin\controller\sale;
use Think\Db;
use app\common\controller\Backend;
use app\admin\model\sale as sale;

/**
 * 销售主管理
 *
 * @icon fa fa-circle-o
 */
class Saledraft extends Backend
{
    
    /**
     * Saledraft模型对象
     * @var \app\admin\model\sale\Saledraft
     */
    protected $model = null;
    protected $searchFields = 'sale_custom_name,sale_custom_contact,sale_custom_tel';
    protected $dataLimit = 'personal';
    protected $dataLimitField = 'company_id';
    protected $noNeedRight = ['index'];

    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\admin\model\sale\Saledraft;
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
                ->where($where)
                ->where('sale_status',0)//未审核的草稿
                ->order($sort, $order)
                ->paginate($limit);

            $result = array("total" => $list->total(), "rows" => $list->items());

            return json($result);
        }
        return $this->view->fetch();
    }/**
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
            	$this->error(__('Parameter %s can not be empty', $ids));
                $this->error(__('No rows were deleted'));
            }
        }
        $this->error(__('Parameter %s can not be empty', 'ids'));
    }

    /**
     * 选择草稿
     */
    public function select()
    {
       if(!empty($this->request->get('sale_id'))) {
    		//1、接收sale_code参数
    		$sale_id = $this->request->get('sale_id');
    		list($where, $sort, $order, $offset, $limit) = $this->buildparams();
    		$sale_main = new sale\Mainlist();
    		$main = $sale_main
    						->where($where)->where('sale_id',$sale_id)
    						->find();
    		
         if ($main){
         	 $this->success($sale_id,null,$main);
         	//$this->error($sale_id);
         } else{
             $this->error($sale_id,null,$sale_id);
         }  
      }   
       
    }
    


}
