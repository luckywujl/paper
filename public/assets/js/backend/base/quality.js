define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'base/quality/index' + location.search,
                    add_url: 'base/quality/add',
                    edit_url: 'base/quality/edit',
                    del_url: 'base/quality/del',
                    multi_url: 'base/quality/multi',
                    import_url: 'base/quality/import',
                    table: 'base_quality',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'quality_id',
                sortName: 'quality_id',
                columns: [
                    [
                        {checkbox: true},
                        //{field: 'quality_id', title: __('Quality_id')},
                        {field: 'quality', title: __('Quality'), operate: 'LIKE'},
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