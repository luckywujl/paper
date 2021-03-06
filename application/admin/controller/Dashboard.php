<?php

namespace app\admin\controller;

use app\common\controller\Backend;
use think\Config;
use app\admin\model\sale as sale;
use app\admin\model\product as product;
use app\admin\model\base as base;

/**
 * 控制台
 *
 * @icon fa fa-dashboard
 * @remark 用于展示当前系统中的统计数据、统计报表及重要实时数据
 */
class Dashboard extends Backend
{

    /**
     * 查看
     */
    public function index()
    {
        
        $seventtime = \fast\Date::unixtime('day', -7);
        $paylist = $createlist = [];
        for ($i = 0; $i < 7; $i++)
        {
            $day = date("Y-m-d", $seventtime + ($i * 86400));
            $createlist[$day] = mt_rand(20, 200);
            $paylist[$day] = mt_rand(1, mt_rand(1, $createlist[$day]));
        }
        $hooks = config('addons.hooks');
        $uploadmode = isset($hooks['upload_config_init']) && $hooks['upload_config_init'] ? implode(',', $hooks['upload_config_init']) : 'local';
        $addonComposerCfg = ROOT_PATH . '/vendor/karsonzhang/fastadmin-addons/composer.json';
        Config::parse($addonComposerCfg, "json", "composer");
        $config = Config::get("composer");
        $addonVersion = isset($config['version']) ? $config['version'] : __('Unknown');
        $product = new product\Product();
        $storage = new base\Storage();
        $sale = new sale\Mainlist();
        $product_info = $product
        							->field('count(*) as product_number,sum(product_weight) as product_weight')
        							->where(['company_id'=>$this->auth->company_id,'product_status'=>1])
        							->select();
        $product_number = $product_info[0]['product_number'];		
        $product_weight = $product_info[0]['product_weight'];
        $product_info = $product
        							->field('count(*) as product_specsnumber')
        							->where(['company_id'=>$this->auth->company_id,'product_status'=>1])
        							->group('product_name,product_productweight,product_grade,product_quality,product_specs,product_unit')
        							->count();
        $product_specs = $product_info;
        $storage_info = $storage
        							->where(['company_id'=>$this->auth->company_id])
        							->count();
        $storage_number = $storage_info;
        $product_product = $product
                            ->field('count(*) as number,sum(product_weight) as weight')
                            ->where(['company_id'=>$this->auth->company_id])
                            ->where('product_product_datetime','between time',[date('Y-m-d 00:00:01'),date('Y-m-d 23:59:59')])
                            ->select();
        $product_product_number = $product_product[0]['number'];
        $product_product_weight = $product_product[0]['weight'];
        $main_info = $sale
        						->field('count(*) as number1,sum(sale_weight) as weight,sum(sale_number) as number')
                        ->where(['company_id'=>$this->auth->company_id])
                        ->where('sale_datetime','between time',[date('Y-m-d 00:00:01'),date('Y-m-d 23:59:59')])
                        ->select();
        $sale_number1 = $main_info[0]['number1'];
        $sale_number = $main_info[0]['number'];
        $sale_weight = $main_info[0]['weight'];               
        $this->view->assign([
            'totalnumber'       => $product_number,
            'totalweight'       => $product_weight,
            'totalspecs'        => $product_specs,
            'totalstorage' => $storage_number,
            'todayuserlogin'   => $product_product_weight,
            'todayusersignup'  => $product_product_number,
            'todayorder'       => $sale_number1,
            'unsettleorder'    => $sale_weight,
            'sevendnu'         => $sale_number,
            'sevendau'         => '32%',
            'paylist'          => $paylist,
            'createlist'       => $createlist,
            'addonversion'       => $addonVersion,
            'uploadmode'       => $uploadmode
        ]);

        return $this->view->fetch();
    }

}
