define(['jquery', 'bootstrap', 'backend', 'table', 'form','printing'], function ($, undefined, Backend, Table,Form,Printing) {

    var Controller = {
        index: function () {
        	$("#c-product_name").on('change',function(){
         	var product = $('#c-product_name').val();
            $("#c-product_productweight").selectPageClear();
            //改变下面这个框的数据源
            $("#c-product_productweight_text").data("selectPageObject").option.data = 'base/product/getweight?product='+product;   
        	});
        //提交	
        $(document).on("click",".btn-accept",function () {
            $("#add-form").attr("action","product/product/index").submit();
        });
        $(document).on("click",".btn-print",function () {
           Fast.api.open('product/product/printingone?product_id=1','打印标签',{}); 
        });
        
        
        //定时读取服务器端的重量数据和车牌信息并更新时间
				setInterval(function(){
  				 //更新页面时间
  				 var myDate = new Date();
  				 $("#c-product_product_datetime").val(myDate.getFullYear()+'-'+(myDate.getMonth()+1)+'-'+myDate.getDate()+" "+myDate.getHours()+':'+myDate.getMinutes()+':'+myDate.getSeconds());
				 $("#c-product_inbound_datetime").val(myDate.getFullYear()+'-'+(myDate.getMonth()+1)+'-'+myDate.getDate()+" "+myDate.getHours()+':'+myDate.getMinutes()+':'+myDate.getSeconds());
				}, 1000);
			
			 
        	Controller.api.bindevent();
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'product/product/index' + location.search,
                    //add_url: 'product/product/add',
                    edit_url: 'product/product/edit',
                    del_url: 'product/product/del',
                    //multi_url: 'product/product/multi',
                    printing_url: 'product/product/printing',
                    table: 'product_product',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'product_id',
                sortName: 'product_id',
                columns: [
                    [
                        {checkbox: true},
                        //{field: 'product_id', title: __('Product_id')},
                        {field: 'product_code', title: __('Product_code'), operate: 'LIKE'},
                        {field: 'product_name', title: __('Product_name'), operate: 'LIKE'},
                        {field: 'product_productweight', title: __('Product_productweight'), operate: 'LIKE'},
                        {field: 'product_grade', title: __('Product_grade'), operate: 'LIKE'},
                        {field: 'product_quality', title: __('Product_quality'), operate: 'LIKE'},
                        {field: 'product_specs', title: __('Product_specs'), operate: 'LIKE'},
                        {field: 'product_unit', title: __('Product_unit'), operate: 'LIKE'},
                        {field: 'product_weight', title: __('Product_weight'), operate:'BETWEEN'},
                        {field: 'product_diameter', title: __('Product_diameter'), operate:'BETWEEN'},
                        {field: 'product_broken', title: __('Product_broken')},
                        {field: 'product_mother_code', title: __('Product_mother_code'), operate: 'LIKE'},
                        {field: 'product_storage', title: __('Product_storage'), operate: 'LIKE'},
                        {field: 'product_product_datetime', title: __('Product_product_datetime'), operate:'RANGE', addclass:'datetimerange', autocomplete:false, formatter: Table.api.formatter.datetime},
                        {field: 'product_inbound_datetime', title: __('Product_inbound_datetime'), operate:'RANGE', addclass:'datetimerange', autocomplete:false, formatter: Table.api.formatter.datetime},
                        //{field: 'product_sale_datetime', title: __('Product_sale_datetime'), operate:'RANGE', addclass:'datetimerange', autocomplete:false, formatter: Table.api.formatter.datetime},
                        {field: 'product_group', title: __('Product_group'), operate: 'LIKE'},
                        {field: 'product_machine', title: __('Product_machine'), operate: 'LIKE'},
                        //{field: 'product_operator', title: __('Product_operator'), operate: 'LIKE'},
                        {field: 'product_QC', title: __('Product_qc'), operate: 'LIKE'},
                        //{field: 'product_sale_code', title: __('Product_sale_code'), operate: 'LIKE'},
                        //{field: 'product_sale_operator', title: __('Product_sale_operator'), operate: 'LIKE'},
                        //{field: 'product_sale_person', title: __('Product_sale_person'), operate: 'LIKE'},
                        //{field: 'product_status', title: __('Product_status'), searchList: {"0":__('Product_status 0'),"1":__('Product_status 1'),"2":__('Product_status 2'),"3":__('Product_status 3')}, formatter: Table.api.formatter.status},
                        //{field: 'company_id', title: __('Company_id')},
                        {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
                    ]
                ]
            });

            // 为表格绑定事件
            Table.api.bindevent(table);
        },
        add: function () {
            Controller.api.bindevent();
        },
        edit: function () {
            Controller.api.bindevent();
        },
        printing: function () {
            Controller.api.bindevent();
            require.config({
            	paths:{
            		"jsBarcode":["/assets/js/JsBarcode.all.min"],
            		"qrcode":["/assets/js/jquery.qrcode.min"],
            	}
            });
            require(["jsBarcode","qrcode"],function () {
            	$("#barcode").JsBarcode($("#c-product_code").val(),{
                	height:60,//高度
 						width:2,//设置条之间的宽度
 						fontSize:15,//设置文本的大小
					});
            	$("#qrcode").qrcode({
            		render:"canvas",
            		width:80,
            		height:80,
            		text:$("#c-product_code").val(),
            	});
            	var myDate = new Date($("#c-product_product_datetime").val()*1000);
            	var aObj = document.getElementById("product_date");
                   //aObj.href = "http://www.baidu.com";
                  //根据id获取超链接,设置文字内容 
                  aObj.innerText = myDate.getFullYear()+"\xa0\xa0\xa0\xa0\xa0"+(parseInt(myDate.getMonth())+1)+"\xa0\xa0\xa0\xa0\xa0"+myDate.getDate();
  			     // $("#product_date").innerText = myDate.getFullYear()+'-'+(myDate.getMonth()+1)+'-'+myDate.getDate()+" "+myDate.getHours()+':'+myDate.getMinutes()+':'+myDate.getSeconds());
				 
            	window.print();
            	parent.Layer.closeAll();
           
            });
        },
        printingone: function () {
            Controller.api.bindevent();
            require.config({
            	paths:{
            		"jsBarcode":["/assets/js/JsBarcode.all.min"],
            		"qrcode":["/assets/js/jquery.qrcode.min"],
            	}
            });
            require(["jsBarcode","qrcode"],function () {
            	$("#barcode").JsBarcode($("#c-product_code").val(),{
                	height:60,//高度
 						width:2,//设置条之间的宽度
 						fontSize:15,//设置文本的大小
					});
            	$("#qrcode").qrcode({
            		render:"canvas",
            		width:80,
            		height:80,
            		text:$("#c-product_code").val(),
            	});
            	var myDate = new Date($("#c-product_product_datetime").val()*1000);
            	var aObj = document.getElementById("product_date");
                   //aObj.href = "http://www.baidu.com";
                  //根据id获取超链接,设置文字内容 
                  aObj.innerText = myDate.getFullYear()+"\xa0\xa0\xa0\xa0\xa0"+(parseInt(myDate.getMonth())+1)+"\xa0\xa0\xa0\xa0\xa0"+myDate.getDate();
  			     // $("#product_date").innerText = myDate.getFullYear()+'-'+(myDate.getMonth()+1)+'-'+myDate.getDate()+" "+myDate.getHours()+':'+myDate.getMinutes()+':'+myDate.getSeconds());
				 
            	window.print();
            	parent.Layer.closeAll();
           
            });
        },
        api: {
            bindevent: function () {
                Form.api.bindevent($("form[role=form]"),function (data,ret) {
                  //数据保存成功后执行，清除产品重量接头数，再打印
                  $("#c-product_weight").val('');
                  $("#c-product_diameter").val('');
                  $("#c-product_broken").val('');
                  //打印单据
                  Fast.api.open('product/product/printingone?product_id='+data.product_id,'打印标签',{}); 	
                 
                  //刷新表格
   				   $("#table").bootstrapTable('refresh');
   				   }, function(data, ret){
  						Toastr.success("失败");
				   	}, function(success, error){

					//bindevent的第三个参数为提交前的回调
					//如果我们需要在表单提交前做一些数据处理，则可以在此方法处理
					//注意如果我们需要阻止表单，可以在此使用return false;即可
					//如果我们处理完成需要再次提交表单则可以使用submit提交,如下
					//Form.api.submit(this, success, error);
					//return false;
                });
            }
        }
    };
    return Controller;
});