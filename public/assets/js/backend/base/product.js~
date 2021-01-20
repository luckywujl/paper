define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'base/product/index' + location.search,
                    add_url: 'base/product/add',
                    edit_url: 'base/product/edit',
                    del_url: 'base/product/del',
                    multi_url: 'base/product/multi',
                    import_url: 'base/product/import',
                    table: 'base_product',
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
                        {field: 'product', title: __('Product'), operate: 'LIKE'},
                        {field: 'product_weight', title: __('Product_weight'), operate: 'LIKE'},
                        {field: 'product_unit', title: __('Product_unit'), operate: 'LIKE'},
                        {field: 'product_price', title: __('Product_price'), operate:'BETWEEN'},
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
        api: {
            bindevent: function () {
                Form.api.bindevent($("form[role=form]"));
            }
        }
    };
    return Controller;
});