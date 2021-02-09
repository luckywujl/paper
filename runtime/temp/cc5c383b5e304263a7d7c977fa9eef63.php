<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:113:"/media/luckywujl/data/www/admin/localhost_9003/wwwroot/public/../application/admin/view/product/product/edit.html";i:1611143737;s:97:"/media/luckywujl/data/www/admin/localhost_9003/wwwroot/application/admin/view/layout/default.html";i:1602168706;s:94:"/media/luckywujl/data/www/admin/localhost_9003/wwwroot/application/admin/view/common/meta.html";i:1602168706;s:96:"/media/luckywujl/data/www/admin/localhost_9003/wwwroot/application/admin/view/common/script.html";i:1602168706;}*/ ?>
<!DOCTYPE html>
<html lang="<?php echo $config['language']; ?>">
    <head>
        <meta charset="utf-8">
<title><?php echo (isset($title) && ($title !== '')?$title:''); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta name="renderer" content="webkit">
<meta name="referrer" content="never">

<link rel="shortcut icon" href="/assets/img/favicon.ico" />
<!-- Loading Bootstrap -->
<link href="/assets/css/backend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.css?v=<?php echo \think\Config::get('site.version'); ?>" rel="stylesheet">

<?php if(\think\Config::get('fastadmin.adminskin')): ?>
<link href="/assets/css/skins/<?php echo \think\Config::get('fastadmin.adminskin'); ?>.css?v=<?php echo \think\Config::get('site.version'); ?>" rel="stylesheet">
<?php endif; ?>

<!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
<!--[if lt IE 9]>
  <script src="/assets/js/html5shiv.js"></script>
  <script src="/assets/js/respond.min.js"></script>
<![endif]-->
<script type="text/javascript">
    var require = {
        config:  <?php echo json_encode($config); ?>
    };
</script>

    </head>

    <body class="inside-header inside-aside <?php echo defined('IS_DIALOG') && IS_DIALOG ? 'is-dialog' : ''; ?>">
        <div id="main" role="main">
            <div class="tab-content tab-addtabs">
                <div id="content">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <section class="content-header hide">
                                <h1>
                                    <?php echo __('Dashboard'); ?>
                                    <small><?php echo __('Control panel'); ?></small>
                                </h1>
                            </section>
                            <?php if(!IS_DIALOG && !\think\Config::get('fastadmin.multiplenav') && \think\Config::get('fastadmin.breadcrumb')): ?>
                            <!-- RIBBON -->
                            <div id="ribbon">
                                <ol class="breadcrumb pull-left">
                                    <?php if($auth->check('dashboard')): ?>
                                    <li><a href="dashboard" class="addtabsit"><i class="fa fa-dashboard"></i> <?php echo __('Dashboard'); ?></a></li>
                                    <?php endif; ?>
                                </ol>
                                <ol class="breadcrumb pull-right">
                                    <?php foreach($breadcrumb as $vo): ?>
                                    <li><a href="javascript:;" data-url="<?php echo $vo['url']; ?>"><?php echo $vo['title']; ?></a></li>
                                    <?php endforeach; ?>
                                </ol>
                            </div>
                            <!-- END RIBBON -->
                            <?php endif; ?>
                            <div class="content">
                                <form id="edit-form" class="form-horizontal" role="form" data-toggle="validator" method="POST" action="">

    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Product_code'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-product_code" class="form-control" name="row[product_code]" type="text" value="<?php echo htmlentities($row['product_code']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Product_name'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-product_name" class="form-control" name="row[product_name]" type="text" value="<?php echo htmlentities($row['product_name']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Product_productweight'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-product_productweight" class="form-control" name="row[product_productweight]" type="text" value="<?php echo htmlentities($row['product_productweight']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Product_grade'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-product_grade" class="form-control" name="row[product_grade]" type="text" value="<?php echo htmlentities($row['product_grade']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Product_quality'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-product_quality" class="form-control" name="row[product_quality]" type="text" value="<?php echo htmlentities($row['product_quality']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Product_specs'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-product_specs" class="form-control" name="row[product_specs]" type="text" value="<?php echo htmlentities($row['product_specs']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Product_unit'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-product_unit" class="form-control" name="row[product_unit]" type="text" value="<?php echo htmlentities($row['product_unit']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Product_weight'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-product_weight" class="form-control" name="row[product_weight]" type="number" value="<?php echo htmlentities($row['product_weight']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Product_diameter'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-product_diameter" class="form-control" name="row[product_diameter]" type="number" value="<?php echo htmlentities($row['product_diameter']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Product_broken'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-product_broken" class="form-control" name="row[product_broken]" type="number" value="<?php echo htmlentities($row['product_broken']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Product_mother_code'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-product_mother_code" class="form-control" name="row[product_mother_code]" type="text" value="<?php echo htmlentities($row['product_mother_code']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Product_storage'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-product_storage" class="form-control" name="row[product_storage]" type="text" value="<?php echo htmlentities($row['product_storage']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Product_product_datetime'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-product_product_datetime" class="form-control datetimepicker" data-date-format="YYYY-MM-DD HH:mm:ss" data-use-current="true" name="row[product_product_datetime]" type="text" value="<?php echo $row['product_product_datetime']?datetime($row['product_product_datetime']):''; ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Product_inbound_datetime'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-product_inbound_datetime" class="form-control datetimepicker" data-date-format="YYYY-MM-DD HH:mm:ss" data-use-current="true" name="row[product_inbound_datetime]" type="text" value="<?php echo $row['product_inbound_datetime']?datetime($row['product_inbound_datetime']):''; ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Product_sale_datetime'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-product_sale_datetime" class="form-control datetimepicker" data-date-format="YYYY-MM-DD HH:mm:ss" data-use-current="true" name="row[product_sale_datetime]" type="text" value="<?php echo $row['product_sale_datetime']?datetime($row['product_sale_datetime']):''; ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Product_group'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-product_group" class="form-control" name="row[product_group]" type="text" value="<?php echo htmlentities($row['product_group']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Product_machine'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-product_machine" class="form-control" name="row[product_machine]" type="text" value="<?php echo htmlentities($row['product_machine']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Product_operator'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-product_operator" class="form-control" name="row[product_operator]" type="text" value="<?php echo htmlentities($row['product_operator']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Product_qc'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-product_QC" class="form-control" name="row[product_QC]" type="text" value="<?php echo htmlentities($row['product_QC']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Product_sale_code'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-product_sale_code" class="form-control" name="row[product_sale_code]" type="text" value="<?php echo htmlentities($row['product_sale_code']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Product_sale_operator'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-product_sale_operator" class="form-control" name="row[product_sale_operator]" type="text" value="<?php echo htmlentities($row['product_sale_operator']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Product_sale_person'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-product_sale_person" class="form-control" name="row[product_sale_person]" type="text" value="<?php echo htmlentities($row['product_sale_person']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Product_status'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            
            <div class="radio">
            <?php if(is_array($productStatusList) || $productStatusList instanceof \think\Collection || $productStatusList instanceof \think\Paginator): if( count($productStatusList)==0 ) : echo "" ;else: foreach($productStatusList as $key=>$vo): ?>
            <label for="row[product_status]-<?php echo $key; ?>"><input id="row[product_status]-<?php echo $key; ?>" name="row[product_status]" type="radio" value="<?php echo $key; ?>" <?php if(in_array(($key), is_array($row['product_status'])?$row['product_status']:explode(',',$row['product_status']))): ?>checked<?php endif; ?> /> <?php echo $vo; ?></label> 
            <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>

        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Company_id'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-company_id" data-rule="required" data-source="company/index" class="form-control selectpage" name="row[company_id]" type="text" value="<?php echo htmlentities($row['company_id']); ?>">
        </div>
    </div>
    <div class="form-group layer-footer">
        <label class="control-label col-xs-12 col-sm-2"></label>
        <div class="col-xs-12 col-sm-8">
            <button type="submit" class="btn btn-success btn-embossed disabled"><?php echo __('OK'); ?></button>
            <button type="reset" class="btn btn-default btn-embossed"><?php echo __('Reset'); ?></button>
        </div>
    </div>
</form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="/assets/js/require<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js" data-main="/assets/js/require-backend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js?v=<?php echo htmlentities($site['version']); ?>"></script>
    </body>
</html>
