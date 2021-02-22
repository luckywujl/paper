<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:113:"/media/luckywujl/data/www/admin/localhost_9003/wwwroot/public/../application/admin/view/sale/detaillist/edit.html";i:1614011248;s:97:"/media/luckywujl/data/www/admin/localhost_9003/wwwroot/application/admin/view/layout/default.html";i:1602168706;s:94:"/media/luckywujl/data/www/admin/localhost_9003/wwwroot/application/admin/view/common/meta.html";i:1602168706;s:96:"/media/luckywujl/data/www/admin/localhost_9003/wwwroot/application/admin/view/common/script.html";i:1602168706;}*/ ?>
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

    
    <div class="form-group" hidden="hidden">
    <input id="c-detail_sale_id" readonly="readonly" class="form-control" name="row[detail_sale_id]" type="number" value="<?php echo htmlentities($row['detail_sale_id']	); ?>">
     <input id="c-detail_id" readonly="readonly" class="form-control" name="row[detail_id]" type="number" value="<?php echo htmlentities($row['detail_id']	); ?>">
       
    </div>
    <div class="form-group">
    </div>
    <div class="form-group" >
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Detail_no'); ?>:</label>
        <div class="col-xs-12 col-sm-2" >
            <input id="c-detail_no" readonly="readonly" class="form-control" name="row[detail_no]" type="number" value="<?php echo htmlentities($row['detail_no']); ?>">
        </div>
    
        <label class="control-label col-xs-12 col-sm-1"><?php echo __('Detail_product_name'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-detail_product_name" readonly="readonly" class="form-control" name="row[detail_product_name]" type="text" value="<?php echo htmlentities($row['detail_product_name']); ?>">
        </div>
    
        <label class="control-label col-xs-12 col-sm-1"><?php echo __('Detail_product_productweight'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-detail_product_productweight" readonly="readonly" class="form-control" name="row[detail_product_productweight]" type="text" value="<?php echo htmlentities($row['detail_product_productweight']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Detail_specs'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-detail_specs" class="form-control" readonly="readonly" name="row[detail_specs]" type="text" value="<?php echo htmlentities($row['detail_specs']); ?>">
        </div>
   
        <label class="control-label col-xs-12 col-sm-1"><?php echo __('Detail_unit'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-detail_unit" class="form-control" readonly="readonly" name="row[detail_unit]" type="text" value="<?php echo htmlentities($row['detail_unit']); ?>">
        </div>
  
        <label class="control-label col-xs-12 col-sm-1"><?php echo __('Detail_price'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-detail_price" class="form-control" name="row[detail_price]" type="number" value="<?php echo htmlentities($row['detail_price']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Detail_weight'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-detail_weight" class="form-control" readonly="readonly" name="row[detail_weight]" type="number" value="<?php echo htmlentities($row['detail_weight']); ?>">
        </div>
   
        <label class="control-label col-xs-12 col-sm-1"><?php echo __('Detail_number'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-detail_number" class="form-control" readonly="readonly" name="row[detail_number]" type="number" value="<?php echo htmlentities($row['detail_number']); ?>">
        </div>
   
        <label class="control-label col-xs-12 col-sm-1"><?php echo __('Detail_amount'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-detail_amount" class="form-control" readonly="readonly" name="row[detail_amount]" type="number" value="<?php echo htmlentities($row['detail_amount']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Detail_detail'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <textarea id="c-detail_detail" class="form-control " readonly="readonly" rows="3" name="row[detail_detail]" cols="50"><?php echo htmlentities($row['detail_detail']); ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Detail_remark'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <textarea id="c-detail_remark" class="form-control " rows="3" name="row[detail_remark]" cols="50"><?php echo htmlentities($row['detail_remark']); ?></textarea>
        </div>
    </div>
    
    <div class="form-group layer-footer">
        <label class="control-label col-xs-12 col-sm-2"></label>
        <div class="col-xs-12 col-sm-8">
            <button type="submit" class="btn btn-success btn-embossed disabled"><?php echo __('OK'); ?></button>
            <button type="button" class="btn btn-success btn-embossed btn-accept"><?php echo __('OK'); ?></button>
          
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
