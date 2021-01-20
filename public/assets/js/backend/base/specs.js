define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'base/specs/index' + location.search,
                    add_url: 'base/specs/add',
                    edit_url: 'base/specs/edit',
                    del_url: 'base/specs/del',
                    multi_url: 'base/specs/multi',
                    import_url: 'base/specs/import',
                    table: 'base_specs',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'specs_id',
                sortName: 'specs_id',
                columns: [
                    [
                        {checkbox: true},
                        //{field: 'specs_id', title: __('Specs_id')},
                        {field: 'specs', title: __('Specs'), operate: 'LIKE'},
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