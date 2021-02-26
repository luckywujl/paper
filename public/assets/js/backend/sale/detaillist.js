define(['jquery', 'bootstrap', 'backend', 'table', 'form','printing','selectpage'], function ($, undefined, Backend, Table, Form, Printing) {

    var Controller = {
        index: function () {
        	//手动输入单价，计算金额
        	$("#c-sale_price").bind("keyup",function (event) {
        	  		$("#c-sale_amount").val(($("#c-sale_price").val()*$("#c-sale_weight").val()).toFixed(2));
        	  		
        	  })
        	
        	//定时读更新时间
				//setInterval(function(){
  				 //更新页面时间
  				 //var myDate = new Date();
  				// $("#c-sale_datetime").val(myDate.getFullYear()+'-'+(myDate.getMonth()+1)+'-'+myDate.getDate()+" "+myDate.getHours()+':'+myDate.getMinutes()+':'+myDate.getSeconds());
				 //$("#c-sale_datetime").val(myDate.getFullYear()+'-'+(myDate.getMonth()+1)+'-'+myDate.getDate()+" "+myDate.getHours()+':'+myDate.getMinutes()+':'+myDate.getSeconds());
				//}, 1000);
				
				
				
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
					 		//无刷新更新页面，填写各项数据后刷新下面的表格
					 		$("#c-sale_code").val(data.sale_code);
					 		//$("#c-sale_datetime").val(data.sale_datetime);
					 		var myDate = new Date(data.sale_datetime*1000);
  		    				$("#c-sale_datetime").val(myDate.getFullYear()+'-'+(myDate.getMonth()+1)+'-'+myDate.getDate()+" "+myDate.getHours()+':'+myDate.getMinutes()+':'+myDate.getSeconds());
							$("#c-sale_custom_name").val(data.sale_custom_name);
							$("#c-sale_custom_id").val(data.sale_custom_id);
							$("#c-sale_custom_id").selectPageRefresh();
							$("#c-sale_custom_contact").val(data.sale_custom_contact);
							$("#c-sale_custom_address").val(data.sale_custom_address);
							$("#c-sale_custom_tel").val(data.sale_custom_tel);
							$("#c-sale_number").val(data.sale_number);
							$("#c-sale_weight").val(data.sale_weight);
							$("#c-sale_price").val(data.sale_price);
							$("#c-sale_amount").val(data.sale_amount);
							$("#c-sale_person").val(data.sale_person);
							$("#c-sale_person").selectPageRefresh();
							$("#c-sale_remark").val(data.sale_remark);
					 		$("table").bootstrapTable('refresh');//刷新表格
					 		//alert(data.sale_custom_name);
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
					  Layer.alert('请添加产品明细，再保存！');
					  return false;
					}else {
					$("#add-form").attr("action","sale/detaillist/savedraft").submit();
					}		
				});
				// 审核过账
				$(document).on("click",".btn-verify",function () {
					if ($("#c-sale_number").val()=='0') {
						Layer.alert('请添加产品明细，再保存！');
					  return false;
					}else {
					$("#add-form").attr("action","sale/detaillist/verify").submit();
					}		
				});
				//打印
				$(document).on("click",".btn-printing",function () {
					var sale_code = $("#c-sale_code").val();
					if (!sale_code==''){
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
					}else {
						Layer.alert('请先保存，再打印！');
					}
					
			   	});
			   	// PDA导入
				  $(document).on("click",".btn-allinput",function () {
				   	var sale_id = $("#c-sale_id").val();
						var sale_code = $("#c-sale_code").val();
						var key ='';
						if (sale_code=='') {
							key = sale_id;
							}else{
							key = sale_code;
							}
					Fast.api.open('sale/detaillist/allinput?sale_id='+sale_id+'&key='+key,'PDA导入',{
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
			   	//清空
			   $(document).on("click",".btn-delall",function () {
			   	   var sale_id = $("#c-sale_id").val();
						var sale_code = $("#c-sale_code").val();
						var key ='';
						if (sale_code=='') {
							key = sale_id;
							}else{
							key = sale_code;
							}
			   	layer.confirm('确定清空所有明细数据?', {btn: ['是','否'] },
			   	function(index){
        				layer.close(index);
          			$.ajax({
                        url: "sale/detaillist/delall",
                        type: 'post',
                        dataType: 'json',
                        data: {sale_code:key,sale_id:sale_id},
                        success: function (ret) {
                           Layer.alert(ret.msg);
                           $(".btn-refresh").trigger('click');//刷新表格
                        }, error: function (e) {
                            Backend.api.toastr.error(e.message);
                        }
                    });				  
       			 },
        			function(index){
           		 	layer.close(index);
        			}
			   	);
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
      							      area:['90%','90%'],
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
                        			url: 'sale/detaillist/del?sale_id='+key,
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
        	  										//return false;
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
        	  			data:{product_code:$("#c-product_code").val(),sale_code:Config.key}
        	  		},function (data,ret) {
        	  			$("#c-product_code").val('');
        	  			$("table").bootstrapTable('refresh');//刷新表格
        	  		},function (data) {
        	  	   	$("#c-product_code").select();
        	  		});
        	  	}
        	  });
            Controller.api.bindevent();
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'sale/detaillist/input' + location.search,
                    del_url: 'sale/detaillist/inputdel',
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
        allinput: function () {
        	//按钮功能
        	$(document).on("click",".btn-select",function () {
        		var rows = $("#table").bootstrapTable('getSelections');
                    if(rows.length<1){
                       alert('请选择一条记录!');
                       return;
                    }
               Fast.api.ajax({
        	  			url:'sale/detaillist/allin',
        	  			data:{sale_id:rows[0].sale_code,sale_code:Config.key}
        	  		},function (data,ret) {
        	  			$("#c-sale_code").val('');
        	  			$("table").bootstrapTable('refresh');//刷新表格
        	  			Fast.api.close(Config.key);
        	  		},function (data) {
        	  		
        	  		});   
        	
               
					
				});
			//输入框扫码功能
        	$("#c-sale_code").bind("keypress",function (event) {
        	  	if (event.keyCode == '13') {
        	  		Fast.api.ajax({
        	  			url:'sale/detaillist/allin',
        	  			data:{sale_id:$("#c-sale_code").val(),sale_code:Config.key}
        	  		},function (data,ret) {
        	  			$("#c-sale_code").val('');
        	  			$("table").bootstrapTable('refresh');//刷新表格
        	  			Fast.api.close(Config.key);
        	  		},function (data) {
        	  	   	$("#c-sale_code").select();
        	  		});
        	  	}
        	  });
        	  
            Controller.api.bindevent();
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'sale/detaillist/allinput' + location.search,
                    del_url: 'sale/detaillist/alldel',
                    table: 'product_product',
                }
            });
            var table = $("#table");
            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'sale_code',
                sortName: 'sale_code',
                search:false,
                commonSearch:false,
                columns: [
                    [
                        {checkbox: true},
                        //{field: 'product_id', title: __('Product_id')},
                        {field: 'sale_code', title: __('Sale_code'), operate: 'LIKE'},
                        {field: 'sale_weight', title: __('Sale_weight'),  operate: 'LIKE'},
                        {field: 'sale_number', title: __('Sale_number'), operate: 'LIKE'},
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
                Form.api.bindevent($("form[role=form]"),function (data,ret) {
                  //数据保存成功后执行，清除产品重量接头数，再打印
                  $("#c-sale_code").val(data);
                
                  //打印单据
                  //Fast.api.open('product/product/printingone?product_id='+data.product_id,'打印标签',{}); 	
                 
                  //刷新表格
   				  // $("#table").bootstrapTable('refresh');
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