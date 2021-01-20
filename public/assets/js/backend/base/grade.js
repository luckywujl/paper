define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'base/grade/index' + location.search,
                    add_url: 'base/grade/add',
                    edit_url: 'base/grade/edit',
                    del_url: 'base/grade/del',
                    multi_url: 'base/grade/multi',
                    import_url: 'base/grade/import',
                    table: 'base_grade',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'grade_id',
                sortName: 'grade_id',
                columns: [
                    [
                        {checkbox: true},
                        //{field: 'grade_id', title: __('Grade_id')},
                        {field: 'grade', title: __('Grade'), operate: 'LIKE'},
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