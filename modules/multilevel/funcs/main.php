<?php

/**
 * @Project NUKEVIET 4.x
 * @Author NVholding <contact@nvholding.vn>
 * @Copyright (C) 2021 NVholding. All rights reserved
 * @License: Not free read more http://nukeviet.vn/vi/store/modules/nvtools/
 * @Createdate Sat, 17 Jul 2021 08:08:05 GMT
 */

if (!defined('NV_IS_MOD_MULTILEVEL'))
    die('Stop!!!');

$page_title = $module_info['site_title'];
$key_words = $module_info['keywords'];

if( $nv_Request->isset_request( 'act', 'post' ) )
{
    $act = $nv_Request->get_title( 'act', 'post', '' );
    $select_name = $nv_Request->get_title( 'select_name', 'post', '' );

    if( $act == 'district' )
    {
        $province = $nv_Request->get_int( 'province', 'post', 0 );
        $selected_id = $nv_Request->get_int( 'selected_id', 'post', 0 );
        $sql = 'SELECT * FROM ' . NV_PREFIXLANG . "_" . $module_data . '_district WHERE status=1';
        if( $province > 0 )
            $sql .= ' AND idprovince=' . $province;

        $result = $db->query( $sql );
        $html = '<select class="form-control"  style="width:100%;" name=' . $select_name . '>';
        $html .= '<option value="0"> --- </option>';
        while( $row = $result->fetch() )
        {
            $sl = ( $selected_id == $row['id'] ) ? ' selected=selected' : '';
            $html .= '<option value="' . $row['id'] . '" ' . $sl . '>' . $row['title'] . '</option>';
        }
        $html .= '</select>';
        die( $html );
    }
}

$array_data = array();

//kiểm tra alias(username) có tồn tại hay không?
// nếu tồn tại username thì hiện trang thông tin cho 
// f1 đăng ký cộng tác viên của f0


if(!empty($array_op[0])){
	/*if (!isset($_SESSION[$module_data])) {$_SESSION[$module_data] = [];}
	$_SESSION[$module_data]['info']=*/
	$username = $array_data['username']=$array_op[0];
	$userid_multilevel = $db->query("SELECT userid FROM " . NV_USERS_GLOBALTABLE . " WHERE username = '" . $username . "' and active=1" )->fetch();
	if(!$userid_multilevel) {nv_redirect_location(NV_BASE_SITEURL);exit();};
	if(defined('NV_IS_USER') && ($userid_multilevel > 0 && $username == $user_info['username'] || $username == '')){
			$contents = multilevel_info_root($user_info);
	}elseif(defined('NV_IS_USER') && $userid_multilevel > 0 && $username != $user_info['username']){
		$username_info=array();
		$username_info['username'] = $username;
		$contents = multilevel_info_root($username_info);
	}elseif(!empty($username) && $userid_multilevel > 0){
		$global_config['module_theme'] = $global_config['site_theme'];//"nvholding";
		$contents = multilevel_register($array_data,$error);
	}else{
		$contents = multilevel_no_user($array_data);
	}
}else{
	if(defined('NV_IS_USER')){
		nv_redirect_location(NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $user_info['username']);
	}else{
		nv_redirect_location(NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=users&' . NV_OP_VARIABLE . '=login');
	}
}
include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';



	/* 
	
	if(!empty($array_op[0])){
			
		//Kiểm tra tồn tại username hay ko?

		
			
		}else{
			// nếu không tồn tại tại khoản thì hiển thị trang thông báo tài khoản không đuọc tim thấy
			
		}
	}
}
else{
	//nếu ko có username thì hiện thông tin của thành viên đang đăng nhập.
	if(defined('NV_IS_USER')){
		$contents = multilevel_info_root($array_data);
	}else{
	// nếu chưa đăng nhập thì chuyển hướng bắt đăng nhập.
		nv_redirect_location(NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=users&' . NV_OP_VARIABLE . '=login');
	}
}
 */


//print_r($array_op); die;


