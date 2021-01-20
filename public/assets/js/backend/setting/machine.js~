define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'setting/machine/index' + location.search,
                    add_url: 'setting/machine/add',
                    edit_url: 'setting/machine/edit',
                    del_url: 'setting/machine/del',
                    multi_url: 'setting/machine/multi',
                    import_url: 'setting/machine/import',
                    table: 'setting_machine',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'machine_id',
                sortName: 'machine_id',
                columns: [
                    [
                        {checkbox: true},
                        //{field: 'machine_id', title: __('Machine_id')},
                        {field: 'machine', title: __('Machine'), operate: 'LIKE'},
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
        api: {
            bindevent: function () {
                Form.api.bindevent($("form[role=form]"));
            }
        }
    };
    return Controller;
});