define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'sale/custom/index' + location.search,
                    add_url: 'sale/custom/add',
                    edit_url: 'sale/custom/edit',
                    del_url: 'sale/custom/del',
                    multi_url: 'sale/custom/multi',
                    import_url: 'sale/custom/import',
                    table: 'sale_custom',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'custom_id',
                sortName: 'custom_id',
                columns: [
                    [
                        {checkbox: true},
                        //{field: 'custom_id', title: __('Custom_id')},
                        {field: 'custom_name', title: __('Custom_name'), operate: 'LIKE'},
                        {field: 'custom_tel', title: __('Custom_tel'), operate: 'LIKE'},
                        {field: 'custom_contact', title: __('Custom_contact'), operate: 'LIKE'},
                        {field: 'custom_address', title: __('Custom_address'), operate: 'LIKE'},
                        {field: 'custom_mem', title: __('Custom_mem'), operate: 'LIKE'},
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