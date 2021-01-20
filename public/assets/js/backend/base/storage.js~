define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'base/storage/index' + location.search,
                    add_url: 'base/storage/add',
                    edit_url: 'base/storage/edit',
                    del_url: 'base/storage/del',
                    multi_url: 'base/storage/multi',
                    import_url: 'base/storage/import',
                    table: 'base_storage',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'storage_id',
                sortName: 'storage_id',
                columns: [
                    [
                        {checkbox: true},
                        //{field: 'storage_id', title: __('Storage_id')},
                        {field: 'storage', title: __('Storage'), operate: 'LIKE'},
                        {field: 'stroage_person', title: __('Stroage_person'), operate: 'LIKE'},
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