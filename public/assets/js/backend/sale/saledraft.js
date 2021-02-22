define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'sale/saledraft/index' + location.search,
                    
                    del_url: 'sale/saledraft/del',
                   
                    table: 'sale_main',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'sale_id',
                sortName: 'sale_code',
                commonSearch:false,
                search:false,
                clickToSelect: true, //是否启用点击选中
        		    dblClickToEdit: false, //是否启用双击编辑
    				 singleSelect: true, //是否启用单选
                columns: [
                    [
                        {checkbox: true},
                        //{field: 'sale_id', title: __('Sale_id')},
                        {field: 'sale_code', title: __('Sale_code'), operate: 'LIKE'},
                        {field: 'sale_datetime', title: __('Sale_datetime'), operate:'RANGE', addclass:'datetimerange', autocomplete:false, formatter: Table.api.formatter.datetime},
                        //{field: 'sale_custom_id', title: __('Sale_custom_id')},
                        {field: 'sale_custom_name', title: __('Sale_custom_name'), operate: 'LIKE'},
                        //{field: 'sale_custom_address', title: __('Sale_custom_address'), operate: 'LIKE'},
                        //{field: 'sale_custom_tel', title: __('Sale_custom_tel'), operate: 'LIKE'},
                        //{field: 'sale_custom_contact', title: __('Sale_custom_contact'), operate: 'LIKE'},
                        {field: 'sale_number', title: __('Sale_number')},
                        {field: 'sale_weight', title: __('Sale_weight'), operate:'BETWEEN'},
                        {field: 'sale_price', title: __('Sale_price'), operate:'BETWEEN'},
                        {field: 'sale_amount', title: __('Sale_amount'), operate:'BETWEEN'},
                        {field: 'sale_person', title: __('Sale_person'), operate: 'LIKE'},
                        {field: 'sale_operator', title: __('Sale_operator'), operate: 'LIKE'},
                        {field: 'sale_remark', title: __('Sale_remark')},
                        {field: 'operate', title: __('Operate'), table: table, 
                        	buttons:[
                        		{
                        			name:'select',
                        			//text:'选择',
                        			classname: 'btn btn-xs btn-success btn-magic btn-ajax',
      							      icon: 'fa fa-magic',
                        			confirm: '确认打开草稿',
                        		//	url: 'sale/saleraft/select',
        								   success: function (data, ret) {
        								   	Fast.api.close({sale_code});
             							   //Layer.alert(ret.msg + ",返回数据：" + JSON.stringify(data));
               						 //如果需要阻止成功提示，则必须使用return false;
                						 //return false;
            							},
          							   error: function (data, ret) {
               							 console.log(data, ret);
            							    Layer.alert(ret.msg);
             							    return false;
          							   }

                        		}
                        	
                        	],
                        	events: Table.api.events.operate, formatter: Table.api.formatter.operate},
                        
                        //{field: 'sale_verify_datetime', title: __('Sale_verify_datetime'), operate:'RANGE', addclass:'datetimerange', autocomplete:false, formatter: Table.api.formatter.datetime},
                        //{field: 'sale_collection_datetime', title: __('Sale_collection_datetime'), operate:'RANGE', addclass:'datetimerange', autocomplete:false, formatter: Table.api.formatter.datetime},
                        //{field: 'sale_verify_person', title: __('Sale_verify_person'), operate: 'LIKE'},
                        //{field: 'sale_collection_person', title: __('Sale_collection_person'), operate: 'LIKE'},
                        //{field: 'sale_status', title: __('Sale_status'), searchList: {"0":__('Sale_status 0'),"1":__('Sale_status 1'),"2":__('Sale_status 2'),"3":__('Sale_status 3')}, formatter: Table.api.formatter.status},
                        //{field: 'company_id', title: __('Company_id'), operate: 'LIKE'},
                        
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
        api: {
            bindevent: function () {
                Form.api.bindevent($("form[role=form]"));
            }
        }
    };
    return Controller;
});