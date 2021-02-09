define(['jquery', 'bootstrap', 'backend', 'table', 'form','selectpage'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
        	
        	//定时读取服务器端的重量数据和车牌信息并更新时间
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
					$.ajax({
						url:"sale/detaillist/new",
						type:'post',
						dataType:'json',
						
						success:function (ret) {
						 //$("#c-sale_custom_id").val('');//清空客户ID
						 //$("#c-sale_custom_name").val('');//清空客户名称
						 //$("#c-sale_custom_contact").val('');//清空联系人栏
						 //$("#c-sale_custom_address").val('');//清空客户地址栏
						 //$("#c-sale_custom_tel").val('');//清空电话栏
						 $("#c-sale_number").val('0');//件数归零
						 $("#c-sale_weight").val('0');//重量归零
						 $("#c-sale_price").val('0.00');//单价归零
						 $("#c-sale_amount").val('0.00');//金额归零	
						 $("#c-sale_remark").val('');//备注清空
						 $("#c-sale_code").val(ret.data);
						},error:function (e) {
							Backend.api.toastr.error(e.message);
						}
					})
				});
      
				//打开草稿
				$(document).on("click",".btn-open",function () {
					Fast.api.open('sale/saledraft/index','打开草稿',{});
				});
				//扫码
				$(document).on("click",".btn-input",function () {
					Fast.api.open('sale/detaillist/input?sale_id='+$("#c-sale_code").val(),'扫码',{});
				}); 	
				// 暂存
				$(document).on("click",".btn-save",function () {
					$("#add-form").attr("action","sale/detaillist/save").submit();
				});
				// 保存草稿
				$(document).on("click",".btn-savedraft",function () {
					$("#add-form").attr("action","sale/detaillist/savedraft").submit();
				});
				
        	Controller.api.bindevent();
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'sale/detaillist/index' + location.search,
                    //add_url: 'sale/detaillist/add',
                    //edit_url: 'sale/detaillist/edit',
                    //del_url: 'sale/detaillist/del',
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
                        {field: 'detail_specs', title: __('Detail_specs'), operate: 'LIKE'},
                        {field: 'detail_unit', title: __('Detail_unit'), operate: 'LIKE'},
                        {field: 'detail_price', title: __('Detail_price'), operate:'BETWEEN'},
                        {field: 'detail_weight', title: __('Detail_weight'), operate:'BETWEEN'},
                        {field: 'detail_number', title: __('Detail_number')},
                        {field: 'detail_amount', title: __('Detail_amount'), operate:'BETWEEN'},
                        {field: 'detail_detail', title: __('Detail_detail')},
                        {field: 'detail_remark', title: __('Detail_remark')},
                        //{field: 'company_id', title: __('Company_id'), operate: 'LIKE'},
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
        input: function () {
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