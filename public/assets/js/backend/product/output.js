define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'product/output/index' + location.search,
                    //add_url: 'product/output/add',
                    //edit_url: 'product/output/edit',
                    //del_url: 'product/output/del',
                    //multi_url: 'product/output/multi',
                    //import_url: 'product/output/import',
                    table: 'product_product',
                }
            });

            var table = $("#table");
            var myDate = new Date();
  				var today = myDate.getFullYear()+'-'+(myDate.getMonth()+1)+'-'+myDate.getDate();
				 

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'product_code',
                sortName: 'product_code',
                search:false,
                columns: [
                    [
                        {checkbox: true},
                        //{field: 'product_id', title: __('Product_id')},
                        {field: 'product_code', title: __('Product_code'), sortable:true, operate: 'LIKE'},
                        {field: 'product_name', title: __('Product_name'), sortable:true, operate: 'LIKE'},
                        {field: 'product_productweight', title: __('Product_productweight'), sortable:true, operate: 'LIKE'},
                        {field: 'product_grade', title: __('Product_grade'), sortable:true, operate: 'LIKE'},
                        {field: 'product_quality', title: __('Product_quality'), sortable:true, operate: 'LIKE'},
                        {field: 'product_specs', title: __('Product_specs'), sortable:true, operate: 'LIKE'},
                        {field: 'product_unit', title: __('Product_unit'), operate: 'LIKE'},
                        {field: 'product_weight', title: __('Product_weight'), operate:'BETWEEN'},
                        {field: 'product_diameter', title: __('Product_diameter'), operate: 'LIKE'},
                        {field: 'product_broken', title: __('Product_broken')},
                        {field: 'product_mother_code', title: __('Product_mother_code'), operate: 'LIKE'},
                        {field: 'product_storage', title: __('Product_storage'), operate: 'LIKE'},
                        {field: 'product_product_datetime', title: __('Product_product_datetime'), sortable:true, operate:'RANGE', addclass:'datetimerange', defaultValue:today+' 00:00:00 - '+today+' 23:59:59',autocomplete:false, formatter: Table.api.formatter.datetime},
                        //{field: 'product_inbound_datetime', title: __('Product_inbound_datetime'), operate:'RANGE', addclass:'datetimerange', autocomplete:false, formatter: Table.api.formatter.datetime},
                        //{field: 'product_sale_datetime', title: __('Product_sale_datetime'), operate:'RANGE', addclass:'datetimerange', autocomplete:false, formatter: Table.api.formatter.datetime},
                        {field: 'product_group', title: __('Product_group'), sortable:true, operate: 'LIKE'},
                        //{field: 'product_machine', title: __('Product_machine'), operate: 'LIKE'},
                        //{field: 'product_operator', title: __('Product_operator'), operate: 'LIKE'},
                        {field: 'product_QC', title: __('Product_qc'), sortable:true, operate: 'LIKE'},
                        //{field: 'product_sale_code', title: __('Product_sale_code'), operate: 'LIKE'},
                        //{field: 'product_sale_operator', title: __('Product_sale_operator'), operate: 'LIKE'},
                        //{field: 'product_sale_person', title: __('Product_sale_person'), operate: 'LIKE'},
                        //{field: 'product_status', title: __('Product_status'), searchList: {"0":__('Product_status 0'),"1":__('Product_status 1'),"2":__('Product_status 2'),"3":__('Product_status 3'),"4":__('Product_status 4')}, formatter: Table.api.formatter.status},
                        //{field: 'company_id', title: __('Company_id')},
                       // {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
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