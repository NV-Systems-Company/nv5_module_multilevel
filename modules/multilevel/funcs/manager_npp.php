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
//check user admin? authors 
$check_admin = $db->query('SELECT admin_id FROM ' . NV_AUTHORS_GLOBALTABLE . ' WHERE admin_id=' . $user_info['userid'])->fetch();
if(empty($check_admin)) {nv_redirect_location(NV_BASE_SITEURL);exit();};

$page_title = $module_info['site_title'];
$key_words = $module_info['keywords'];
$contents="";
$error = array();
$data = array();
$data['fullname'] = '';
$data['username'] = '';
$data['email'] = '';
$data['password'] = '';
$data['repassword'] = '';
$data['address'] = '';
$data['phone'] = '';
$data['codename'] = '';
$data['cccd'] = '';
$data['stknganhang'] = '';
$data['provinceid'] = 0;

if ($nv_Request->get_title('txtCheckss', 'post','')==NV_CHECK_SESSION)
{
	$data['fullname'] = $nv_Request->get_title('fullname', 'post', '');
	$data['address'] = $nv_Request->get_title('address', 'post', '');
	$data['phone'] = $nv_Request->get_title('phone', 'post', '');
	$data['username'] = $nv_Request->get_title('username', 'post', '');
	$data['email'] = $nv_Request->get_title('email', 'post', '');
	$data['password'] = $nv_Request->get_title('password', 'post', '');
	$data['repassword'] = $nv_Request->get_title('repassword', 'post', '');
	$data['codename'] = $nv_Request->get_title('codename', 'post', '');
	$data['stknganhang'] = $nv_Request->get_title('stknganhang', 'post', '');
	$data['cccd'] = $nv_Request->get_title('cccd', 'post', '');
	$data['provinceid'] = $nv_Request->get_array('list_provin', 'post', 0);
	//$list_provin = $nv_Request->get_array('list_provin', 'post', '');

	if (nv_md5safe($data['repassword']) !=nv_md5safe($data['password'])) $error[]= $lang_module['error_password1'];
	//if (empty($list_city) or $list_city==0) $error[]= $lang_module['error_provinceid'];
	/*Check Username hợp lệ?
	Tạm thời chưa check trùng CMND, SĐT, update sau	
	*/
	$table_name = NV_PREFIXLANG . '_' . $module_data . '_users';
	if ($_FILES['photo_npp']['tmp_name'] == '') $error[]=$lang_module['error_photo'];
	$userid = $db->query("SELECT userid FROM " . NV_USERS_GLOBALTABLE . " WHERE username = '" . $data['username'] . "'" )->fetch();
	if(!empty($userid))  $error[]=$lang_module['error_username_duplicate'];
	
	$userid = $db->query("SELECT userid FROM " . NV_USERS_GLOBALTABLE . " WHERE email = '" . $data['email'] . "'" )->fetch();
	if(!empty($userid))   $error[]=$lang_module['error_email_duplicate'];
	
	$userid = $db->query("SELECT userid FROM " . NV_USERS_GLOBALTABLE . " WHERE username = '" . $data['codename'] . "'" )->fetch();
	if(!empty($userid))   $error[]=$lang_module['error_codename_duplicate'];
	else
	{
	$userid = $db->query("SELECT userid FROM " . $table_name  . " WHERE username = '" . $data['codename'] . "' or code ='" . $data['codename'] . "'")->fetch();
	if(!empty($userid))   $error[]=$lang_module['error_codename_duplicate'];
	}
	if (empty($error))
	{
		$file_allowed_ext[] = 'images';
		$pathSaveUrl = nv_multilevel_get_path_dir();
		$length_substr = strlen(NV_ROOTDIR . NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_name . '/');
		$upload = new NukeViet\Files\Upload($file_allowed_ext, $global_config['forbid_extensions'], $global_config['forbid_mimes'], NV_UPLOAD_MAX_FILESIZE, NV_MAX_WIDTH, NV_MAX_HEIGHT);

		if ($_FILES['photo_npp']['tmp_name'] != '') {
            $upload_info = $upload->save_file($_FILES['photo_npp'], NV_ROOTDIR . '/' . $pathSaveUrl, false, true);
            @unlink($_FILES['photo_npp']['tmp_name']);
            if (!empty($upload_info['error'])) {
                $error[] = $upload_info['error'];
            } else {
                if (!empty($data['photo_npp'])) {
                    @unlink(NV_ROOTDIR . NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_name . '/' . $array_data['photo_npp']);
                }
                $data['photo_npp'] = substr($upload_info['name'], $length_substr);
            }
        }
		
		$customer_name = explode(' ', $data['fullname']);
        $total_str = count($customer_name);
        $data['first_name'] = $customer_name[$total_str - 1];
        unset($customer_name[$total_str - 1]);
        $data['last_name'] = implode(' ', $customer_name);
		
		$sql = 'INSERT INTO '.NV_USERS_GLOBALTABLE.' (group_id, username, md5username, password, email, first_name,last_name,photo,question,answer, active, regdate) VALUES
		(' . intval(0) . ',:username,:md5username,:password,:email,:first_name,:last_name,:photo,:question,:answer,' . intval(1) . ',' . intval(NV_CURRENTTIME) . ')';
		
		$data_insert = array();
		$data_insert['username'] = $data['username'];
		$data_insert['md5username'] =nv_md5safe($data['username']);;
		$data_insert['password'] =$crypt->hash_password($data['password'],$global_config['hashprefix']);
		$data_insert['email'] = $data['email'];
		$data_insert['first_name'] = $data['first_name'];
		$data_insert['last_name'] = $data['last_name'];
		$data_insert['photo'] = $data['photo_npp'];
		$data_insert['question'] = $lang_module['question'];
		$data_insert['answer'] = $data['phone'];
		$rowid= $db->insert_id($sql, 'userid', $data_insert);
		if ($rowid > 0)
		{
			//$_SESSION['multilevel'][$alias_mod]['info'] = $multi_userid;
			//$_SESSION[$module_data]['parentid']=$parent['userid'];
			//$_SESSION[$module_data]['parentuser']=$parent['username'];
			$_SESSION[$module_data]['currentid']=$rowid;
			
			$sql = 'INSERT INTO '.$table_name.' (userid, username, parentid, usernameparent, mobile, banknumber,numbercard,precode, code,domain,
			datatext,address, add_time,status ) VALUES
			( :userid, :username, :parentid, :usernameparent, :mobile, :banknumber,:numbercard,:precode, :code,:domain,
			:datatext,:address, ' .intval(NV_CURRENTTIME). ',' .  intval(1)  . ')'; 
			$data_insert = array();$data['precode']=$rowid.$parent['userid'];
			$data_insert['userid'] = $rowid;
			$data_insert['username'] =$data['username'];
			$data_insert['parentid'] =0;
			$data_insert['usernameparent'] ='NPP';
			$data_insert['mobile'] =$data['phone'];
			$data_insert['banknumber'] =$data['stknganhang'];
			$data_insert['numbercard'] =$data['cccd'];
			$data_insert['precode'] =$data['precode'];
			$data_insert['code'] =$data['codename'];
			$data_insert['domain'] =implode(',',$data['provinceid']);
			$data_insert['datatext'] =serialize($data);
			$data_insert['address'] =$data['address'];
			
			$row_id= $db->insert_id($sql, 'userid', $data_insert);
			$data['userid'] = $rowid;
			//$contents = multilevel_register_npp($data,$error);
			nv_redirect_location(NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=memberlist');
		}else
		/*Vì 1 lý do nào đó không lưu được*/
		$error[]= 'Rất tiếc, không đăng ký được. <br/> vui lòng liên hệ ADMIN hệ thống!';
		
	}
	
}
$contents = multilevel_register_npp($data,$error);
include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';