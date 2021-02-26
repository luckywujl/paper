define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'storage/stock/index' + location.search,
                    //add_url: 'storage/stock/add',
                    //edit_url: 'storage/stock/edit',
                    //del_url: 'storage/stock/del',
                    //multi_url: 'storage/stock/multi',
                    //import_url: 'storage/stock/import',
                    table: 'product_product',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'product_name',
                sortName: 'product_name',
                columns: [
                    [
                        {checkbox: true},
                        //{field: 'product_id', title: __('Product_id')},
                        //{field: 'product_code', title: __('Product_code'), operate: 'LIKE'},
                        {field: 'product_name', title: __('Product_name'), operate: 'LIKE'},
                        {field: 'product_productweight', title: __('Product_productweight'), operate: 'LIKE'},
                        {field: 'product_grade', title: __('Product_grade'), operate: 'LIKE'},
                        {field: 'product_quality', title: __('Product_quality'), operate: 'LIKE'},
                        {field: 'product_specs', title: __('Product_specs'), operate: 'LIKE'},
                        {field: 'product_unit', title: __('Product_unit'), operate: 'LIKE'},
                        {field: 'product_number', title: __('Product_number'), operate:'BETWEEN'},
                        {field: 'product_weight', title: __('Product_weight'), operate:'BETWEEN'},
                        //{field: 'product_diameter', title: __('Product_diameter'), operate: 'LIKE'},
                        //{field: 'product_broken', title: __('Product_broken')},
                        
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