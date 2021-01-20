<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:114:"/media/luckywujl/data/www/admin/localhost_9003/wwwroot/public/../application/admin/view/product/product/index.html";i:1611159240;s:97:"/media/luckywujl/data/www/admin/localhost_9003/wwwroot/application/admin/view/layout/default.html";i:1602168706;s:94:"/media/luckywujl/data/www/admin/localhost_9003/wwwroot/application/admin/view/common/meta.html";i:1602168706;s:96:"/media/luckywujl/data/www/admin/localhost_9003/wwwroot/application/admin/view/common/script.html";i:1602168706;}*/ ?>
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
                                <div class="panel panel-default panel-intro">
    <?php echo build_heading(); ?>

    <div class="panel-body">
    <form id="add-form" class="form-horizontal" role="form" data-toggle="validator" method="POST" action="">

   
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-1"><?php echo __('Product_name'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-product_name" data-source="base/product/getproduct" data-field="product" data-primary-key="product" class="form-control selectpage" name="row[product_name]" type="text">
        </div>
    
        <label class="control-label col-xs-12 col-sm-1"><?php echo __('Product_productweight'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-product_productweight" data-source="base/product/getweight" data-field="product_weight" data-primary-key="product_weight" class="form-control selectpage" name="row[product_productweight]" type="text">
        </div>
    
        <label class="control-label col-xs-12 col-sm-1"><?php echo __('Product_grade'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-product_grade" data-source="base/grade/index" data-field="grade" data-primary-key="grade" class="form-control selectpage" name="row[product_grade]" type="text">
        </div>
    
        <label class="control-label col-xs-12 col-sm-1"><?php echo __('Product_quality'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-product_quality" data-source="base/quality/index" data-field="quality" data-primary-key="quality" class="form-control selectpage" name="row[product_quality]" type="text">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-1"><?php echo __('Product_specs'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-product_specs" data-source="base/specs/index" data-field="specs" data-primary-key="specs"  class="form-control selectpage" name="row[product_specs]" type="text">
        </div>
    
        <label class="control-label col-xs-12 col-sm-1"><?php echo __('Product_unit'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-product_unit" class="form-control" name="row[product_unit]" type="text">
        </div>
    
        <label class="control-label col-xs-12 col-sm-1"><?php echo __('Product_weight'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-product_weight" data-rule="required" class="form-control" name="row[product_weight]" type="number">
        </div>
    
        <label class="control-label col-xs-12 col-sm-1"><?php echo __('Product_diameter'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-product_diameter"  class="form-control" name="row[product_diameter]" type="text">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-1"><?php echo __('Product_broken'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-product_broken"  class="form-control" name="row[product_broken]" type="number">
        </div>
    
        <label class="control-label col-xs-12 col-sm-1"><?php echo __('Product_mother_code'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-product_mother_code" class="form-control" name="row[product_mother_code]" type="text">
        </div>
    
        <label class="control-label col-xs-12 col-sm-1"><?php echo __('Product_storage'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-product_storage" data-rule="required" data-source="base/storage/index" data-field="storage" data-primary-key="storage" class="form-control selectpage" name="row[product_storage]" type="text">
        </div>
    
        <label class="control-label col-xs-12 col-sm-1"><?php echo __('Product_product_datetime'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-product_product_datetime" class="form-control datetimepicker" data-date-format="YYYY-MM-DD HH:mm:ss" data-use-current="true" name="row[product_product_datetime]" type="text" value="<?php echo date('Y-m-d H:i:s'); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-1"><?php echo __('Product_inbound_datetime'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-product_inbound_datetime" class="form-control datetimepicker" data-date-format="YYYY-MM-DD HH:mm:ss" data-use-current="true" name="row[product_inbound_datetime]" type="text" value="<?php echo date('Y-m-d H:i:s'); ?>">
        </div>

        <label class="control-label col-xs-12 col-sm-1"><?php echo __('Product_group'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-product_group" data-source="setting/group/index" data-field="group" data-primary-key="group" class="form-control selectpage" name="row[product_group]" type="text">
        </div>
   
        <label class="control-label col-xs-12 col-sm-1"><?php echo __('Product_machine'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-product_machine" data-source="setting/machine/index" data-field="machine" data-primary-key="machine" class="form-control selectpage" name="row[product_machine]" type="text">
        </div>
    
        <label class="control-label col-xs-12 col-sm-1"><?php echo __('Product_qc'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-product_QC" data-source="setting/person/index" data-field="person" data-primary-key="person" class="form-control selectpage" name="row[product_QC]" type="text">
        </div>
    </div>
    
    <div class="form-group layer-footer">
        <label class="control-label col-xs-12 col-sm-2"></label>
        <div class="col-xs-12 col-sm-8">
            
            <button type="reset" class="btn btn-default btn-embossed"><?php echo __('Reset'); ?></button>
            <button type="button" class="btn btn-info btn-embossed btn-accept"><?php echo __('确定'); ?></button>
        </div>
    </div>
</form>

        <div id="myTabContent" class="tab-content">
            <div class="tab-pane fade active in" id="one">
                <div class="widget-body no-padding">
                    <div id="toolbar" class="toolbar">
                        <a href="javascript:;" class="btn btn-primary btn-refresh" title="<?php echo __('Refresh'); ?>" ><i class="fa fa-refresh"></i> </a>
                        <a href="javascript:;" class="btn btn-success btn-edit btn-disabled disabled <?php echo $auth->check('product/product/edit')?'':'hide'; ?>" title="<?php echo __('Edit'); ?>" ><i class="fa fa-pencil"></i> <?php echo __('Edit'); ?></a>
                        <a href="javascript:;" class="btn btn-danger btn-del btn-disabled disabled <?php echo $auth->check('product/product/del')?'':'hide'; ?>" title="<?php echo __('Delete'); ?>" ><i class="fa fa-trash"></i> <?php echo __('Delete'); ?></a>
                        <a href="javascript:;" class="btn btn-info btn-print btn-disabled disabled <?php echo $auth->check('product/product/print')?'':'hide'; ?>" title="<?php echo __('补打标签'); ?>" ><i class="fa fa-leaf"></i> <?php echo __('补打标签'); ?></a>
                        
                        <div class="dropdown btn-group <?php echo $auth->check('product/product/multi')?'':'hide'; ?>">
                            <a class="btn btn-primary btn-more dropdown-toggle btn-disabled disabled" data-toggle="dropdown"><i class="fa fa-cog"></i> <?php echo __('More'); ?></a>
                            <ul class="dropdown-menu text-left" role="menu">
                                <li><a class="btn btn-link btn-multi btn-disabled disabled" href="javascript:;" data-params="status=normal"><i class="fa fa-eye"></i> <?php echo __('Set to normal'); ?></a></li>
                                <li><a class="btn btn-link btn-multi btn-disabled disabled" href="javascript:;" data-params="status=hidden"><i class="fa fa-eye-slash"></i> <?php echo __('Set to hidden'); ?></a></li>
                            </ul>
                        </div>

                        
                    </div>
                    <table id="table" class="table table-striped table-bordered table-hover table-nowrap"
                           data-operate-edit="<?php echo $auth->check('product/product/edit'); ?>" 
                           data-operate-del="<?php echo $auth->check('product/product/del'); ?>" 
                           width="100%">
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="/assets/js/require<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js" data-main="/assets/js/require-backend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js?v=<?php echo htmlentities($site['version']); ?>"></script>
    </body>
</html>
