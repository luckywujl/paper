define(['jquery', 'bootstrap', 'backend', 'table', 'form','printing'], function ($, undefined, Backend, Table, Form, Printing) {

    var Controller = {
        index: function () {
        	$(".btn-edit").data("area",["90%","90%"]);
        	$(".btn-edit").data("title",'查看');
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'sale/mainlist/index' + location.search,
                    add_url: 'sale/mainlist/add',
                    edit_url: 'sale/mainlist/edit',
                    del_url: 'sale/mainlist/del',
                    multi_url: 'sale/mainlist/multi',
                    import_url: 'sale/mainlist/import',
                    table: 'sale_main',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'sale_id',
                sortName: 'sale_id',
                columns: [
                    [
                        {checkbox: true},
                        //{field: 'sale_id', title: __('Sale_id')},
                        {field: 'sale_code', title: __('Sale_code'), operate: 'LIKE'},
                        {field: 'sale_datetime', title: __('Sale_datetime'), operate:'RANGE', addclass:'datetimerange', autocomplete:false, formatter: Table.api.formatter.datetime},
                        {field: 'sale_custom_id', title: __('Sale_custom_id')},
                        {field: 'sale_custom_name', title: __('Sale_custom_name'), operate: 'LIKE'},
                        {field: 'sale_custom_address', title: __('Sale_custom_address'), visible:false,operate: 'LIKE'},
                        {field: 'sale_custom_tel', title: __('Sale_custom_tel'), visible:false,operate: 'LIKE'},
                        {field: 'sale_custom_contact', title: __('Sale_custom_contact'), visible:false,operate: 'LIKE'},
                        {field: 'sale_number', title: __('Sale_number')},
                        {field: 'sale_weight', title: __('Sale_weight'), operate:'BETWEEN'},
                        {field: 'sale_price', title: __('Sale_price'), operate:'BETWEEN'},
                        {field: 'sale_amount', title: __('Sale_amount'), operate:'BETWEEN'},
                        {field: 'sale_person', title: __('Sale_person'), operate: 'LIKE'},
                        {field: 'sale_operator', title: __('Sale_operator'), operate: 'LIKE'},
                        {field: 'sale_remark', title: __('Sale_remark'),visible:false,},
                        {field: 'sale_verify_datetime', title: __('Sale_verify_datetime'), operate:'RANGE', addclass:'datetimerange', autocomplete:false, formatter: Table.api.formatter.datetime},
                        {field: 'sale_collection_datetime', title: __('Sale_collection_datetime'), operate:'RANGE', addclass:'datetimerange', autocomplete:false, formatter: Table.api.formatter.datetime},
                        {field: 'sale_verify_person', title: __('Sale_verify_person'), operate: 'LIKE'},
                        {field: 'sale_collection_person', title: __('Sale_collection_person'), operate: 'LIKE'},
                        {field: 'sale_status', title: __('Sale_status'), searchList: {"0":__('Sale_status 0'),"1":__('Sale_status 1'),"2":__('Sale_status 2'),"3":__('Sale_status 3')}, formatter: Table.api.formatter.status},
                        //{field: 'company_id', title: __('Company_id'), operate: 'LIKE'},
                        {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
                    ]
                ]
            });

            // 为表格绑定事件
            Table.api.bindevent(table);
            table.on('post-body.bs.table',function () {
            	$(".btn-editone").data("area",["90%","90%"]);
            	$(".btn-editone").data("title",'查看');
            })
            
        },
        add: function () {
            Controller.api.bindevent();
        },
        edit: function () {
        	//打印
        	$(document).on("click",".btn-printing",function () {
					$.ajax({
                        url: "sale/detaillist/printing",
                        type: 'post',
                        dataType: 'json',
                        data: {sale_code:$("#c-sale_code").val()},
                        success: function (ret) {
                            var options ={
                                templateCode:'FSFHD',
                                data:ret.data,
                                list:ret.list
                            };
                            Printing.api.printTemplate(options);
                            return false;
                        }, error: function (e) {
                            Backend.api.toastr.error(e.message);
                        }
                    });	
			   	});
			   //审核过账
			   $(document).on("click",".btn-verify",function () {
					$.ajax({
                        url: "sale/mainlist/verify",
                        type: 'post',
                        dataType: 'json',
                        data: {sale_code:$("#c-sale_code").val()},
                        success: function (ret) {
                        	document.getElementById("btn-verify").setAttribute("disabled",true);
                        	document.getElementById("btn-cancel").setAttribute("disabled",true);
                           Layer.alert(ret.msg);
                        }, error: function (e) {
                            Backend.api.toastr.error(e.message);
                        }
                    });	
              });
              //反审核
			   $(document).on("click",".btn-rverify",function () {
					$.ajax({
                        url: "sale/mainlist/rverify",
                        type: 'post',
                        dataType: 'json',
                        data: {sale_code:$("#c-sale_code").val()},
                        success: function (ret) {
                        	document.getElementById("btn-rverify").setAttribute("disabled",true);
                        	document.getElementById("btn-collection").setAttribute("disabled",true);
                           
                           Layer.alert(ret.msg);
                        }, error: function (e) {
                            Backend.api.toastr.error(e.message);
                        }
                    });	
              });
              //作废
			   $(document).on("click",".btn-cancel",function () {
					$.ajax({
                        url: "sale/mainlist/cancel",
                        type: 'post',
                        dataType: 'json',
                        data: {sale_code:$("#c-sale_code").val()},
                        success: function (ret) {
                        	document.getElementById("btn-cancel").setAttribute("disabled",true);
                        	document.getElementById("btn-verify").setAttribute("disabled",true);
                           Layer.alert(ret.msg);
                        }, error: function (e) {
                            Backend.api.toastr.error(e.message);
                        }
                    });	
              });
            //收款
			   $(document).on("click",".btn-collection",function () {
					$.ajax({
                        url: "sale/mainlist/collection",
                        type: 'post',
                        dataType: 'json',
                        data: {sale_code:$("#c-sale_code").val()},
                        success: function (ret) {
                        	document.getElementById("btn-collection").setAttribute("disabled",true);
                        	document.getElementById("btn-rverify").setAttribute("disabled",true); 
                           Layer.alert(ret.msg);
                        }, error: function (e) {
                            Backend.api.toastr.error(e.message);
                        }
                    });	
              });
			 
            Controller.api.bindevent();
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'sale/mainlist/edit?ids='+$("#c-sale_id").val() + location.search,
                    //add_url: 'sale/detaillist/add',
                    //edit_url: 'sale/detaillist/edit',
                    // del_url: 'sale/detaillist/del',
                    //multi_url: 'sale/detaillist/multi',
                    //import_url: 'sale/detaillist/import',
                    table: 'sale_detail',
                }
            });

            var table = $("#table");
            
            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'detail_id',
                sortName: 'detail_id',
                sortOrder:'asc',
                search:false,
					 commonSearch: false,
                columns: [
                    [
                        {checkbox: true},
                        //{field: 'detail_id', title: __('Detail_id')},
                        //{field: 'detail_sale_id', title: __('Detail_sale_id')},
                        {field: 'detail_no', title: __('Detail_no')},
                        //{field: 'detail_product_id', title: __('Detail_product_id')},
                        {field: 'detail_product_name', title: __('Detail_product_name'), operate: 'LIKE'},
                        {field: 'detail_product_productweight', title: __('Detail_product_productweight'), operate: 'LIKE'},
                        {field: 'detail_grade', title: __('Detail_grade'), operate: 'LIKE'},
                        {field: 'detail_quality', title: __('Detail_quality'), operate: 'LIKE'},
                        {field: 'detail_specs', title: __('Detail_specs'), operate: 'LIKE'},
                        {field: 'detail_unit', title: __('Detail_unit'), operate: 'LIKE'},
                        {field: 'detail_price', title: __('Detail_price'), operate:'BETWEEN'},
                        {field: 'detail_weight', title: __('Detail_weight'), operate:'BETWEEN'},
                        {field: 'detail_number', title: __('Detail_number')},
                        {field: 'detail_amount', title: __('Detail_amount'), operate:'BETWEEN'},
                        {field: 'detail_detail', title: __('Detail_detail')},
                        {field: 'detail_remark', title: __('Detail_remark')},
              
                    ]
                ]
            });

            // 为表格绑定事件
            Table.api.bindevent(table);
        },
        api: {
            bindevent: function () {
                Form.api.bindevent($("form[role=form]"));
            }
        }
    };
    return Controller;
});