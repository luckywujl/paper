define(['jquery', 'bootstrap', 'backend', 'table', 'form','selectpage'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
        	//手动输入单价，计算金额
        	$("#c-sale_price").bind("keyup",function (event) {
        	  		$("#c-sale_amount").val(($("#c-sale_price").val()*$("#c-sale_weight").val()).toFixed(2));
        	  		
        	  })
        	
        	//定时读更新时间
				setInterval(function(){
  				 //更新页面时间
  				 var myDate = new Date();
  				 $("#c-sale_datetime").val(myDate.getFullYear()+'-'+(myDate.getMonth()+1)+'-'+myDate.getDate()+" "+myDate.getHours()+':'+myDate.getMinutes()+':'+myDate.getSeconds());
				 $("#c-sale_datetime").val(myDate.getFullYear()+'-'+(myDate.getMonth()+1)+'-'+myDate.getDate()+" "+myDate.getHours()+':'+myDate.getMinutes()+':'+myDate.getSeconds());
				}, 1000);
				
				
				
				//选择客户
				$('#c-sale_custom_id').selectPage({
					showField:'custom_name',
					keyField:'custom_id',
					data:'sale/custom/index',
 					pageSize:10,
 					eAjaxSuccess:function (data) {
 						data.list = typeof data.rows !=='undefined' ? data.rows :(typeof data.list !== 'undefined' ? data.list : []);
 						data.totalRow = typeof data.total !== 'undefined' ? data.total :(typeof data.totalRow !== 'undefined' ? data.totalRow :data.list.length);
 						return data;
 					},
					eSelect:function (data) {
						$("#c-sale_custom_name").val(data.custom_name);
						Fast.api.ajax({
							url:'sale/custom/getcustominfo',
							data:{custom_id:data.custom_id}
						},
						function (data,ret) {
							//填写客户信息
							console.info(data);
							//return false;
							$("#c-sale_custom_address").val(data.custom_address);
							$("#c-sale_custom_tel").val(data.custom_tel);
							$("#c-sale_custom_contact").val(data.custom_contact);
						},function (data) {
							//失败的回调
							return false;
						})
					},
				});
				
				//新建
				$(document).on("click",".btn-new",function () {
					Fast.api.ajax({
        	  		 	url:'sale/detaillist/new',
        	  			},function (data,ret) {
        	  				$("#c-sale_id").val(ret.data);
        	  				$("#c-sale_code").val('');
							$("#c-sale_number").val('0');//件数归零
						 	$("#c-sale_weight").val('0');//重量归零
						 	$("#c-sale_price").val('0.00');//单价归零
						 	$("#c-sale_amount").val('0.00');//金额归零	
						 	$("#c-sale_remark").val('');//备注清空		
        	  				$("table").bootstrapTable('refresh');//刷新表格
        	  				return false;
        	  			},function (data) {			
        	  		 		return false;
        	  			});
					
					
					
				});
      
				//打开草稿
				$(document).on("click",".btn-open",function () {
					Fast.api.open('sale/saledraft/index','打开草稿',{
						area:['90%', '90%'],
					 	callback:function (data) {
					 		alert(data);
				   	}
					});
				});
				//扫码
				$(document).on("click",".btn-input",function () {
					var sale_id = $("#c-sale_id").val();
					var sale_code = $("#c-sale_code").val();
					var key ='';
					if (sale_code=='') {
						key = sale_id}else{
							key = sale_code}
					Fast.api.open('sale/detaillist/input?sale_id='+sale_id+'&key='+key,'扫码',{
						area:['90%', '90%'],
						callback:function (data) {
					 	//	alert(data);
					 	//	$("#c-sale_code").val(data);
					 		Fast.api.ajax({
        	  		 		url:'sale/detaillist/detailtotal',
        	  				data:{key:data,sale_id:sale_id}
        	  				},function (data,ret) {
        	  					$("#c-sale_amount").val(data[0]['amount']);
        	  					$("#c-sale_number").val(data[0]['number']);
        	  					$("#c-sale_weight").val(data[0]['weight']);
        	  					$("#c-sale_price").val((data[0]['amount']/data[0]['weight']).toFixed(2));
        	  					//对总表进行汇总，求总件数，总重量，总金额，倒算单价
        	  					
        	  					$("table").bootstrapTable('refresh');//刷新表格
        	  					return false;
        	  				},function (data) {
        	  					$("table").bootstrapTable('refresh');//刷新表格
        	  		 			return false;
        	  				});
				   	}
					});
				}); 	
				// 暂存
				$(document).on("click",".btn-save",function () {
					$("#add-form").attr("action","sale/detaillist/save").submit();
				});
				// 保存草稿
				$(document).on("click",".btn-savedraft",function () {
					if ($("#c-sale_number").val()=='0') {
						alert('请添加产品明细，再保存！');
					  return false;
					}else {
					$("#add-form").attr("action","sale/detaillist/savedraft").submit();
					}		
				});
				
        	Controller.api.bindevent();
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'sale/detaillist/index' + location.search,
                    //add_url: 'sale/detaillist/add',
                    //edit_url: 'sale/detaillist/edit',
                    // del_url: 'sale/detaillist/del',
                    //multi_url: 'sale/detaillist/multi',
                    //import_url: 'sale/detaillist/import',
                    table: 'sale_detail',
                }
            });

            var table = $("#table");
            var ids = Table.api.selectedids(table);
            var sale_id = $("#c-sale_id").val();
					var sale_code = $("#c-sale_code").val();
					var key ='';
					if (sale_code=='') {
						key = sale_id}else{
							key = sale_code}

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'detail_id',
                sortName: 'detail_no',
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
                        //{field: 'company_id', title: __('Company_id'), operate: 'LIKE'},
                        {field: 'operate', title: __('Operate'), table: table, 
                        	buttons:[
                        		{
                        			name:'edit1',
                        			//text:'修改',
                        			title:'修改',
                        			classname: 'btn btn-xs btn-primary btn-dialog',
      							      icon: 'fa fa fa-pencil',
                        			//confirm: '确认打开草稿',
                        			url: 'sale/detaillist/edit?detail_id={detail_id}',
                        			callback: function (data, ret) {
                        				//更新汇总数据
                        				Fast.api.ajax({
        	  		 							url:'sale/detaillist/total',
        	  									data:{sale_id:data},
        	  									},function (data,ret) {
        	  										//对总表进行汇总，求总件数，总重量，总金额，倒算单价
        	  										$("#c-sale_amount").val(data[0]['amount']);
        	  										$("#c-sale_number").val(data[0]['number']);
        	  										$("#c-sale_weight").val(data[0]['weight']);
        	  										$("#c-sale_price").val((data[0]['amount']/data[0]['weight']).toFixed(2));
        	  										$("table").bootstrapTable('refresh');//刷新表格
        	  										return false;
        	  									},function (data) {			
        	  		 								return false;
        	  									});
             							 
               						 $("table").bootstrapTable('refresh');//刷新表格
                						 return false;
            							},
          							   error: function (data, ret) {
               							 console.log(data, ret);
            							    Layer.alert(ret.msg);
             							    return false;
          							   }
   
                        		},
                        		{
                        			name:'delete',
                        			//text:'删除',
                        			classname: 'btn btn-xs btn-danger btn-magic btn-ajax',
      							      icon: 'fa fa-trash',
                        			confirm: '确定要删除这一行吗？',
                        			url: 'sale/detaillist/del?sale_id='+$("#c-sale_id").val(),
        								   success: function (data, ret) {
             							 //更新汇总数据
                        				Fast.api.ajax({
        	  		 							url:'sale/detaillist/total',
        	  									data:{sale_id:$("#c-sale_id").val()},
        	  									},function (data,ret) {
        	  										//对总表进行汇总，求总件数，总重量，总金额，倒算单价
        	  										$("#c-sale_amount").val(data[0]['amount']);
        	  										$("#c-sale_number").val(data[0]['number']);
        	  										$("#c-sale_weight").val(data[0]['weight']);
        	  										$("#c-sale_price").val((data[0]['amount']/data[0]['weight']).toFixed(2));
        	  										$("table").bootstrapTable('refresh');//刷新表格
        	  										return false;
        	  									},function (data) {			
        	  		 								return false;
        	  									});
               						 $("table").bootstrapTable('refresh');//刷新表格
                						 return false;
            							},
          							   error: function (data, ret) {
               							 console.log(data, ret);
            							    Layer.alert(ret.msg);
             							    return false;
          							   }
                        		}                    	
                        	],
                        	events: Table.api.events.operate, formatter: Table.api.formatter.operate},
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
        	  //手动输入单价后计算金额
        	  $("#c-detail_price").bind("keyup",function (event) {      	  	   
        	  		$("#c-detail_amount").val($("#c-detail_price").val()*$("#c-detail_weight").val());
        	  	})	
        	  	//提交按钮
        	  	$(document).on("click",".btn-accept",function () {
        	  		//var newamount = $("#c-detail_amount").val();
        	  		//var amounttotal = parent.$("#c-sale_amount").val();
        	  		//parent.$("#c-sale_amount").val(amounttotal-oldamount+newamount);
        	  		$("#edit-form").attr("action","sale/detaillist/edit").submit();
        	  		  Fast.api.close($("#c-detail_sale_id").val());//保存后返回数据给调用者
        	  	})
            Controller.api.bindevent();          
        },
        input: function () {
        	  $("#c-product_code").bind("keypress",function (event) {
        	  	if (event.keyCode == '13') {
        	  		Fast.api.ajax({
        	  			url:'sale/detaillist/scan',
        	  			data:{product_code:$("#c-product_code").val(),sale_code:Config.sale_id}
        	  		},function (data,ret) {
        	  			$("#c-product_code").val('');
        	  			$("table").bootstrapTable('refresh');//刷新表格
        	  		},function (data) {
        	  		
        	  		});
        	  	}
        	  });
            Controller.api.bindevent();
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'sale/detaillist/input' + location.search,
                    del_url: 'sale/detaillist/del',
                    table: 'product_product',
                }
            });

            var table = $("#table");
           

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'product_id',
                sortName: 'product_id',
                search:false,
                commonSearch:false,
                columns: [
                    [
                        {checkbox: true},
                        //{field: 'product_id', title: __('Product_id')},
                        {field: 'product_code', title: __('Product_code'), operate: 'LIKE'},
                        {field: 'product_name', title: __('Product_name'), visible:false, operate: 'LIKE'},
                        {field: 'product_productweight', title: __('Product_productweight'), operate: 'LIKE'},
                        {field: 'product_grade', title: __('Product_grade'), visible:false,operate: 'LIKE'},
                        {field: 'product_quality', title: __('Product_quality'),visible:false, operate: 'LIKE'},
                        {field: 'product_specs', title: __('Product_specs'), operate: 'LIKE'},
                        {field: 'product_unit', title: __('Product_unit'), operate: 'LIKE'},
                        {field: 'product_weight', title: __('Product_weight'), operate:'BETWEEN'},
                        {field: 'product_diameter', title: __('Product_diameter'), operate:'BETWEEN'},
                        {field: 'product_broken', title: __('Product_broken'),visible:false,},
                        {field: 'product_mother_code', title: __('Product_mother_code'), visible:false,operate: 'LIKE'},
                        {field: 'product_storage', title: __('Product_storage'), operate: 'LIKE'},
                        {field: 'product_product_datetime', title: __('Product_product_datetime'),visible:false, operate:'RANGE', addclass:'datetimerange', autocomplete:false, formatter: Table.api.formatter.datetime},
                        {field: 'product_inbound_datetime', title: __('Product_inbound_datetime'), visible:false,operate:'RANGE', addclass:'datetimerange', autocomplete:false, formatter: Table.api.formatter.datetime},
                        //{field: 'product_sale_datetime', title: __('Product_sale_datetime'), operate:'RANGE', addclass:'datetimerange', autocomplete:false, formatter: Table.api.formatter.datetime},
                        //{field: 'product_group', title: __('Product_group'), operate: 'LIKE'},
                        //{field: 'product_machine', title: __('Product_machine'), operate: 'LIKE'},
                        //{field: 'product_operator', title: __('Product_operator'), operate: 'LIKE'},
                        //{field: 'product_QC', title: __('Product_qc'), operate: 'LIKE'},
                        //{field: 'product_sale_code', title: __('Product_sale_code'), operate: 'LIKE'},
                        //{field: 'product_sale_operator', title: __('Product_sale_operator'), operate: 'LIKE'},
                        //{field: 'product_sale_person', title: __('Product_sale_person'), operate: 'LIKE'},
                        //{field: 'product_status', title: __('Product_status'), searchList: {"0":__('Product_status 0'),"1":__('Product_status 1'),"2":__('Product_status 2'),"3":__('Product_status 3')}, formatter: Table.api.formatter.status},
                        //{field: 'company_id', title: __('Company_id')},
                        {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
                    ]
                ]
            });

            parent.window.$(".layui-layer-iframe").find(".layui-layer-close").on('click',function () {
					Fast.api.close(Config.key);            
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