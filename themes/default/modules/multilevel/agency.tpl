<!-- BEGIN: main --><div class="table-responsive">    <div class="text-center clearfix"><a class="btn btn-primary" href="{agencycontent}">{LANG.add_agencycontent}</a><br></div>    <table class="table table-striped table-bordered table-hover">        <colgroup>            <col class="w100">            <col span="1">            <col span="2" class="w150">        </colgroup>        <thead>        <tr class="text-center">            <th>{LANG.order}</th>            <th>{LANG.title}</th>            <th>{LANG.price_require}</th>            <th>{LANG.price_for_discount}</th>            <th>{LANG.sale_product}</th>            <th>Chiết khấu</th>            <th>{LANG.status}</th>            <th>{LANG.feature}</th>        </tr>        </thead>        <tbody>        <!-- BEGIN: row -->        <tr>            <td class="text-center">                <select id="change_weight_{ROW.id}" onchange="nv_chang_weight('{ROW.id}', '{op}');" class="form-control">                    <!-- BEGIN: weight -->                    <option value="{WEIGHT.w}"{WEIGHT.selected}>{WEIGHT.w}</option>                    <!-- END: weight -->                </select></td>            <td>{ROW.title}</td>            <td>{ROW.price_require}</td>            <td><strong class="red">{ROW.price_for_discount}</strong>&nbsp;{LANG.milion}&nbsp;{LANG.price_discount}&nbsp;<strong class="red">{ROW.price_discount}</strong>&nbsp;{LANG.milion}</td>            <td>{ROW.sale_product_show}</td>            <td>{ROW.percent_discount}%</td>            <td class="text-center">                <select id="change_status_{ROW.id}" onchange="nv_chang_status('{ROW.id}', '{op}');" class="form-control">                    <!-- BEGIN: status -->                    <option value="{STATUS.key}"{STATUS.selected}>{STATUS.val}</option>                    <!-- END: status -->                </select></td>            <td class="text-center"><!-- BEGIN: copy_page --><a href={URL_COPY} title="{LANG.title_copy_page}"><em class="fa fa-copy fa-lg">&nbsp;</em></a><!-- END: copy_page --><em class="fa fa-edit fa-lg">&nbsp;</em><a href="{ROW.url_edit}">{GLANG.edit}</a> &nbsp; <em class="fa fa-trash-o fa-lg">&nbsp;</em><a href="javascript:void(0);" onclick="nv_module_del({ROW.id}, '{op}', '{ROW.checkss}');">{GLANG.delete}</a></td>        </tr>        <!-- END: row -->        </tbody>    </table></div><!-- END: main -->