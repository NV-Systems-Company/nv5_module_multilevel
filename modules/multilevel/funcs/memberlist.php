<?php

/**
 * NukeViet Content Management System
 * @version 4.x
 * @author VINADES.,JSC <contact@vinades.vn>
 * @copyright (C) 2009-2021 VINADES.,JSC. All rights reserved
 * @license GNU/GPL version 2 or any later version
 * @see https://github.com/nukeviet The NukeViet CMS GitHub project
 */
if (!defined('NV_IS_MOD_MULTILEVEL')) {
    exit('Stop!!!');
}
$contents="";
$data = array();
$page = $nv_Request->get_int('page', 'get', 1);
$per_page = 30;
$page_url = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op;
$table_user = NV_PREFIXLANG . '_' . $module_data . '_users';
$db->sqlreset()->select('COUNT(*)')
->from(NV_USERS_GLOBALTABLE.' u1 inner join '.$table_user.' u2 on u1.userid=u2.userid' );
$num_items = $db->query($db->sql())->fetchColumn();
$db->select('*')->limit($per_page)->offset(($page - 1) * $per_page);	
$result = $db->query($db->sql());//->fetchALL();
$link['search']=$page_url;
$xtpl = new XTemplate($op.'.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_info['module_theme']);
$xtpl->assign('LANG', $lang_module);
$xtpl->assign('GLANG', $lang_global);
$xtpl->assign('LINK', $link);
$stt=1;
while ($row = $result->fetch()) {
	$row['TT']=$stt++;
	$row['status']=($row['status']==1)?$lang_module['active']:$lang_module['noactive'];
	$row['fullname']=$row['last_name'].' '.$row['first_name'];
	$xtpl->assign('ROW', $row);
	$xtpl->parse('main.view.loop');
}

$xtpl->parse('main.view');
$xtpl->parse('main');
$contents = $xtpl->text('main');
//nv_memberslist_theme($data);
include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';

