<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:114:"/media/luckywujl/data/www/admin/localhost_9003/wwwroot/public/../application/admin/view/sale/detaillist/index.html";i:1612086882;s:97:"/media/luckywujl/data/www/admin/localhost_9003/wwwroot/application/admin/view/layout/default.html";i:1602168706;s:94:"/media/luckywujl/data/www/admin/localhost_9003/wwwroot/application/admin/view/common/meta.html";i:1602168706;s:96:"/media/luckywujl/data/www/admin/localhost_9003/wwwroot/application/admin/view/common/script.html";i:1602168706;}*/ ?>
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
        <label class="control-label col-xs-12 col-sm-1"><?php echo __('Sale_code'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-sale_code" class="form-control "   name="row[sale_code]" type="text" value="<?php echo htmlentities($row['sale_code']); ?>">
        </div>
        <label class="control-label col-xs-12 col-sm-1"><?php echo __('Sale_datetime'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-sale_datetime" class="form-control datetimepicker" data-date-format="YYYY-MM-DD HH:mm:ss" data-use-current="true" name="row[sale_datetime]" type="text" value="<?php echo date('Y-m-d H:i:s'); ?>">
        </div>
    
        <div class="col-xs-12 col-sm-2" hidden="hidden">
            <input id="c-sale_custom_name"   class="form-control " name="row[sale_custom_name]" type="text" value="<?php echo htmlentities($row['sale_custom_name']); ?>">
        </div>
    
        <label class="control-label col-xs-12 col-sm-1"><?php echo __('Sale_custom_name'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-sale_custom_id" data-rule="required"   class="form-control" name="row[sale_custom_id]" type="text" value="<?php echo htmlentities($row['sale_custom_id']); ?>">
        </div>
        
        <label class="control-label col-xs-12 col-sm-1"><?php echo __('Sale_custom_contact'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-sale_custom_contact" class="form-control" name="row[sale_custom_contact]" type="text" value="<?php echo htmlentities($row['sale_custom_contact']); ?>">
        </div>
        
        
        
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-1"><?php echo __('Sale_custom_tel'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-sale_custom_tel" class="form-control" name="row[sale_custom_tel]" type="text" value="<?php echo htmlentities($row['sale_custom_tel']); ?>">
        </div>
        
        <label class="control-label col-xs-12 col-sm-1"><?php echo __('Sale_custom_address'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-sale_custom_address" class="form-control" name="row[sale_custom_address]" type="text" value="<?php echo htmlentities($row['sale_custom_address']); ?>">
        </div>
    
        <label class="control-label col-xs-12 col-sm-1"><?php echo __('Sale_number'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-sale_number" class="form-control" name="row[sale_number]" type="number" value="<?php echo htmlentities($row['sale_number']); ?>">
        </div>
    
        <label class="control-label col-xs-12 col-sm-1"><?php echo __('Sale_weight'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-sale_weight" class="form-control" name="row[sale_weight]" type="number" value="<?php echo htmlentities($row['sale_weight']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-1"><?php echo __('Sale_price'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-sale_price" class="form-control" name="row[sale_price]" type="number" value="<?php echo htmlentities($row['sale_price']); ?>">
        </div>
    
        <label class="control-label col-xs-12 col-sm-1"><?php echo __('Sale_amount'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-sale_amount" class="form-control" name="row[sale_amount]" type="number" value="<?php echo htmlentities($row['sale_amount']); ?>">
        </div>
   
        <label class="control-label col-xs-12 col-sm-1"><?php echo __('Sale_person'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <input id="c-sale_person" data-source="setting/person/index" data-field="person" data-primary-key="person" class="form-control selectpage" name="row[sale_person]" type="text" value="<?php echo htmlentities($row['sale_person']); ?>">
        </div>
    
        <label class="control-label col-xs-12 col-sm-1"><?php echo __('Sale_remark'); ?>:</label>
        <div class="col-xs-12 col-sm-2">
            <textarea id="c-sale_remark" class="form-control " rows="1" name="row[sale_remark]" cols="50"><?php echo htmlentities($row['sale_remark']); ?></textarea>
        </div>
    </div>
    
    
    
   
    <div class="form-group layer-footer">
        <label class="control-label col-xs-12 col-sm-2"></label>
        <div class="col-xs-12 col-sm-8">
            <button type="button" class="btn btn-info btn-embossed btn-new"><?php echo __('新建'); ?></button>
            <button type="button" class="btn btn-success btn-embossed btn-save"><?php echo __('暂存'); ?></button>  
            <button type="button" class="btn btn-success btn-embossed btn-savedraft"><?php echo __('保存草稿'); ?></button>
            <button type="reset" class="btn btn-default btn-embossed"><?php echo __('Reset'); ?></button>
            <button type="button" class="btn btn-success btn-embossed btn-verify"><?php echo __('审核过账'); ?></button>
            <button type="button" class="btn btn-info btn-embossed btn-open"><?php echo __('打开草稿'); ?></button>
        </div>
    </div>
</form>

        <div id="myTabContent" class="tab-content">
            <div class="tab-pane fade active in" id="one">
                <div class="widget-body no-padding">
                    <div id="toolbar" class="toolbar">
                        <a href="javascript:;" class="btn btn-primary btn-refresh" title="<?php echo __('Refresh'); ?>" ><i class="fa fa-refresh"></i> </a>
                        <a href="javascript:;" class="btn btn-success btn-input <?php echo $auth->check('sale/detaillist/input')?'':'hide'; ?>" title="<?php echo __('Input'); ?>" ><i class="fa fa-plus"></i> <?php echo __('input'); ?></a>
                        <a href="javascript:;" class="btn btn-danger btn-back btn-disabled disabled <?php echo $auth->check('sale/detaillist/del')?'':'hide'; ?>" title="<?php echo __('Delete'); ?>" ><i class="fa fa-trash"></i> <?php echo __('Delete'); ?></a>
                        <a href="javascript:;" class="btn btn-success btn-allinput <?php echo $auth->check('sale/detaillist/allinput')?'':'hide'; ?>" title="<?php echo __('Allinput'); ?>" ><i class="fa fa-plus"></i> <?php echo __('allinput'); ?></a>
                        
                       
                        
                    </div>
                    <table id="table" class="table table-striped table-bordered table-hover table-nowrap"
                           data-operate-edit="<?php echo $auth->check('sale/detaillist/edit'); ?>" 
                           data-operate-del="<?php echo $auth->check('sale/detaillist/del'); ?>" 
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
