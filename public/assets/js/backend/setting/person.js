define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'setting/person/index' + location.search,
                    add_url: 'setting/person/add',
                    edit_url: 'setting/person/edit',
                    del_url: 'setting/person/del',
                    multi_url: 'setting/person/multi',
                    import_url: 'setting/person/import',
                    table: 'setting_person',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'person_id',
                sortName: 'person_id',
                columns: [
                    [
                        {checkbox: true},
                        //{field: 'person_id', title: __('Person_id')},
                        {field: 'person', title: __('Person'), operate: 'LIKE'},
                        {field: 'person_tel', title: __('Person_tel'), operate: 'LIKE'},
                        {field: 'person_status', title: __('Person_status'), searchList: {"0":__('Person_status 0'),"1":__('Person_status 1')}, formatter: Table.api.formatter.status},
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