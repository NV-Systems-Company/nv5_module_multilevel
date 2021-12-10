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
//
$contents = '';$data=array();
$global_config['module_theme'] = $global_config['site_theme'];
/*xử lý thông tin từ home*/
if ($nv_Request->get_title('txtCheckss', 'post')==NV_CHECK_SESSION)
{
	//var_dump($nv_Request->isset_request('txtCheckss', 'post'));
	//$data['last_name'] = $nv_Request->get_title('last_name', 'post', '');
	//$data['first_name'] = $nv_Request->get_title('first_name', 'post', '');
	$data['fullname'] = $nv_Request->get_title('fullname', 'post', '');
	$data['username_ctv'] = $nv_Request->get_title('username_ctv', 'post', '');
	$data['email'] = $nv_Request->get_title('email', 'post', '');
	$data['password'] = $nv_Request->get_title('password', 'post', '');
	$data['re_password'] = $nv_Request->get_title('re_password', 'post', '');
	$data['gender'] = $nv_Request->get_title('gender', 'post', '');
	$data['nguoigioithieu'] = $nv_Request->get_title('nguoigioithieu', 'post', '');
	$data['contact'] = $nv_Request->get_title('contact', 'post', '');
	$data['cccd'] = $nv_Request->get_title('cccd', 'post', '');
	$data['sender_id'] = (int) (defined('NV_IS_USER') ? $user_info['userid'] : 0);
	$error = array();
	if (empty($data['fullname']))$error[]= $lang_module['error_fullname'];
	if (empty($data['email'])) $error[]= $lang_module['error_email'];
	if (empty($data['password'])) $error[]= $lang_module['error_password'];
	if (empty($data['re_password'])) $error[]= $lang_module['error_password'];
	if ($data['re_password'] !=$data['password']) $error[]= $lang_module['error_password1'];
	if (empty($data['nguoigioithieu'])) $error[]= $lang_module['error_nguoigioithieu'];
	/*Check Username hợp lệ?
	Tạm thời chưa check trùng CMND, SĐT, update sau	
	*/
	if(empty($error)){
	$parent=array();
	$parent = $db->query("SELECT userid,username FROM " . NV_USERS_GLOBALTABLE . " WHERE active=1 and username = '" . $data['nguoigioithieu'] . "'" )->fetch();
	if(empty($parent)) $error[]=$lang_module['error_nguoigioithieu1'];
	$userid = $db->query("SELECT userid FROM " . NV_USERS_GLOBALTABLE . " WHERE username = '" . $data['username_ctv'] . "'" )->fetch();
	if($userid)  $error[]=$lang_module['error_username_duplicate'];
	$userid = $db->query("SELECT userid FROM " . NV_USERS_GLOBALTABLE . " WHERE email = '" . $data['email'] . "'" )->fetch();
	if($userid)   $error[]=$lang_module['error_email_duplicate'];
	}
	//$parentroot = nvGetParentIdRoot($parent['userid']);
	/*step1*/
	if(empty($error)){
		$customer_name = explode(' ', $data['fullname']);
        $total_str = count($customer_name);
        $data['first_name'] = $customer_name[$total_str - 1];
        unset($customer_name[$total_str - 1]);
        $data['last_name'] = implode(' ', $customer_name);
		
		$sql = 'INSERT INTO '.NV_USERS_GLOBALTABLE.' (group_id, username, md5username, password, email, first_name,last_name,gender,question,answer, active, regdate) VALUES
		(' . intval(4) . ',:username,:md5username,:password,:email,:firstname,:lastname,:gender,:question,:answer,' . intval(1) . ',' . intval(NV_CURRENTTIME) . ')';
					$data_insert = array();
					$data_insert['username'] = $data['username_ctv'];
					$data_insert['md5username'] =nv_md5safe($data['username_ctv']);;
					$data_insert['password'] =$crypt->hash_password($data['password'],$global_config['hashprefix']);
					$data_insert['email'] = $data['email'];
					$data_insert['firstname'] = $data['first_name'];
					$data_insert['lastname'] = $data['last_name'];
					$data_insert['gender'] = $data['gender'];
					$data_insert['question'] = $lang_module['question'];
					$data_insert['answer'] = $data['contact'];
					$rowid= $db->insert_id($sql, 'userid', $data_insert);
		if ($rowid > 0)
		{
			
			//$_SESSION['multilevel'][$alias_mod]['info'] = $multi_userid;
			$_SESSION[$module_data]['currentid']=$rowid;
			$_SESSION[$module_data]['parentid']=$parent['userid'];
			//$_SESSION[$module_data]['parentuser']=$parent['username'];
			$table_name = NV_PREFIXLANG . '_' . $module_data . '_users';
			$weight = $db->query('SELECT max(weight) FROM '.$table_name.' WHERE parentid=' . $parent['userid'])->fetchColumn();
            $weight = intval($weight) + 1;
            $subcatid = '';
			$sql = 'INSERT INTO '.$table_name.' (userid, username, fullname, email, parentid, usernameparent, mobile,numbercard,precode, code, add_time,edit_time, status ) VALUES
			( :userid, :username, :fullname, :email, :parentid, :usernameparent, :mobile,:numbercard,:precode, :code, ' .intval(NV_CURRENTTIME). ',' .intval(NV_CURRENTTIME). ',' .  intval(0)  . ')'; 
			$data_insert = array();$data['precode']=$rowid.$parent['userid'];
			$data_insert['userid'] = $rowid;
			$data_insert['username'] =$data['username_ctv'];
			$data_insert['fullname'] =$data['fullname'];
			$data_insert['email'] =$data['email'];
			$data_insert['parentid'] =$parent['userid'];
			$data_insert['usernameparent'] =$parent['username'];
			$data_insert['mobile'] =$data['contact'];
			$data_insert['numbercard'] =$data['cccd'];
			$data_insert['precode'] =$data['precode'];
			$data_insert['code'] ='CA'.$rowid;
			$row_id= $db->insert_id($sql, 'userid', $data_insert);
			$_SESSION[$module_data]['step']=NV_CHECK_SESSION.'3';
			$data['step']=3;$data['userid'] = $rowid;
			nv_fix_users_parent_order();
			$contents = multilevel_register($data,$error);
		}else
		/*Vì 1 lý do nào đó không lưu được*/
		$error[]= 'Rất tiếc, không đăng ký được. <br/> vui lòng liên hệ ADMIN hệ thống!';
	}
	else $contents = multilevel_register($data,$error);
}
else
if ($nv_Request->get_title('txtCheckss', 'post')==NV_CHECK_SESSION.'2')
{
	$data['step']=2;
	
	$data['userid'] = $_SESSION[$module_data]['currentid'];
	$data['ngaycap'] = $nv_Request->get_title('ngaycap', 'post', '');
	$data['noicap'] = $nv_Request->get_title('noicap', 'post', '');
	$data['address'] = $nv_Request->get_title('address', 'post', '');
	$data['provinceid'] = $nv_Request->get_title('provinceid', 'post', '');
	$data['districtid'] = $nv_Request->get_title('districtid', 'post', '');
	
	$data['peopleid'] = $nv_Request->get_title('peopleid', 'post', '', 1);
    $file_allowed_ext[] = 'images';
    $pathSaveUrl = nv_multilevel_get_path_dir();
    $length_substr = strlen(NV_ROOTDIR . NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_name . '/');

    //hinh anh sau khi upload hoac sua
    $data['photo_befor'] = $nv_Request->get_title('photo_befor', 'post', '');
    $data['photo_after'] = $nv_Request->get_title('photo_after', 'post', '');

    $upload = new NukeViet\Files\Upload($file_allowed_ext, $global_config['forbid_extensions'], $global_config['forbid_mimes'], NV_UPLOAD_MAX_FILESIZE, NV_MAX_WIDTH, NV_MAX_HEIGHT);
	$error = array();
	if (empty($data['ngaycap'])) $error[]= $lang_module['error_ngaycap'];
	if (empty($data['noicap'])) $error[]= $lang_module['error_noicap'];
	if (empty($data['address'])) $error[]= $lang_module['error_address'];
	if (empty($data['provinceid'])) $error[]= $lang_module['error_provinceid'];
	if ($data['districtid']==0) $error[]= $lang_module['error_districtid'];
	//if (empty($data['photo_befor']) or empty($data['photo_after'])) $error[]= $lang_module['error_photo_cccd'];
	//if (empty($data['photo_after'])) $error[]= $lang_module['error_photo_after'];
	if (empty($error))
	{
	if ($_FILES['photo_befor']['tmp_name'] != '') {
            $upload_info = $upload->save_file($_FILES['photo_befor'], NV_ROOTDIR . '/' . $pathSaveUrl, false, true);
            @unlink($_FILES['photo_befor']['tmp_name']);
            if (!empty($upload_info['error'])) {
                $error[] = $upload_info['error'];
            } else {
                if (!empty($data['photo_befor'])) {
                    @unlink(NV_ROOTDIR . NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_name . '/' . $array_data['photo_befor']);
                }
                $data['photo_befor'] = substr($upload_info['name'], $length_substr);
            }
        }
    if ($_FILES['photo_after']['tmp_name'] != '') {
        $upload_info = $upload->save_file($_FILES['photo_after'], NV_ROOTDIR . '/' . $pathSaveUrl, false, true);
        @unlink($_FILES['photo_after']['tmp_name']);
        if (!empty($upload_info['error'])) {
            $error[] = $upload_info['error'];
        } else {
            if (!empty($data['photo_after'])) {
                @unlink(NV_ROOTDIR . NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_name . '/' . $array_data['photo_after']);
            }
            $data['photo_after'] = substr($upload_info['name'], $length_substr);
        }
    }
	
	$table_name = NV_PREFIXLANG . '_' . $module_data . '_users';
	$stmt = $db->prepare('UPDATE ' . $table_name . ' SET 
	 daterange=:ngaycap, issuedby=:noicap, datatext=:datatext, 
	 provinceid=:provinceid, districtid=:districtid, photo_befor=:photo_befor, 
	 photo_after=:photo_after, address=:address, edit_time=' . NV_CURRENTTIME . 
	 ' WHERE userid =' . $data['userid']);
    $stmt->bindParam(':datatext', serialize($data), PDO::PARAM_STR);
    $stmt->bindParam(':ngaycap', $data['ngaycap'], PDO::PARAM_STR);
    $stmt->bindParam(':noicap', $data['noicap'], PDO::PARAM_STR);
    $stmt->bindParam(':provinceid', $data['provinceid'], PDO::PARAM_INT);
    $stmt->bindParam(':districtid', $data['districtid'], PDO::PARAM_INT);
    $stmt->bindParam(':address', $data['address'], PDO::PARAM_INT);
    $stmt->bindParam(':photo_befor', $data['photo_befor'], PDO::PARAM_INT);
    $stmt->bindParam(':photo_after', $data['photo_after'], PDO::PARAM_INT);
    $stmt->execute();
	if ($stmt->rowCount()) {
         $nv_Cache->delMod($module_name);
		 //Show kết quả đã đăng ký
		 $data=$db->query("SELECT kq.*, u.username, 
		 u.gender,u.first_name ,u.last_name, u.email FROM ".$table_name 
		 .' kq inner join '. NV_USERS_GLOBALTABLE . " u on kq.userid=u.userid
		 WHERE kq.userid = '" . $data['userid'] . "'" )->fetch();
		 $data['fullname']= $data['last_name'].' '.$data['first_name'];
		 $data['gender']= $data['gender']=='F'?$lang_module['gender_1']:$lang_module['gender_2'];
		 
		 $data['step']=3;
     } else {
         $error[] = $lang_module['errorsave'];
     }
	
	}
	$contents = multilevel_register($data,$error);
}
if ($nv_Request->get_title('txtCheckss', 'post')==NV_CHECK_SESSION.'4')
{
	$data['step']=5;
	
	$data['userid'] = $nv_Request->get_int('userid', 'post', 0);
	$data['ngaycap'] = $nv_Request->get_title('ngaycap', 'post', '');
	$data['noicap'] = $nv_Request->get_title('noicap', 'post', '');
	$data['address'] = $nv_Request->get_title('address', 'post', '');
	$data['provinceid'] = $nv_Request->get_title('provinceid', 'post', '');
	$data['districtid'] = $nv_Request->get_title('districtid', 'post', '');
	$data['cccd'] = $nv_Request->get_title('cccd', 'post', '');
	$data['affiliate_code'] = $nv_Request->get_title('affiliate_code', 'post', '');
	$data['peopleid'] = $nv_Request->get_title('peopleid', 'post', '', 1);
    $file_allowed_ext[] = 'images';
    $pathSaveUrl = nv_multilevel_get_path_dir();
    $length_substr = strlen(NV_ROOTDIR . NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_name . '/');

    //hinh anh sau khi upload hoac sua
    $data['photo_befor'] = $nv_Request->get_title('photo_befor', 'post', '');
    $data['photo_after'] = $nv_Request->get_title('photo_after', 'post', '');

    $upload = new NukeViet\Files\Upload($file_allowed_ext, $global_config['forbid_extensions'], $global_config['forbid_mimes'], NV_UPLOAD_MAX_FILESIZE, NV_MAX_WIDTH, NV_MAX_HEIGHT);
	$error = array();
	if (empty($data['ngaycap'])) $error[]= $lang_module['error_ngaycap'];
	if (empty($data['noicap'])) $error[]= $lang_module['error_noicap'];
	if (empty($data['address'])) $error[]= $lang_module['error_address'];
	if (empty($data['affiliate_code'])) $error[]= $lang_module['error_affiliate_code'];
	if (empty($data['provinceid'])) $error[]= $lang_module['error_provinceid'];
	if ($data['districtid']==0) $error[]= $lang_module['error_districtid'];
	//if (empty($data['photo_befor']) or empty($data['photo_after'])) $error[]= $lang_module['error_photo_cccd'];
	//if (empty($data['photo_after'])) $error[]= $lang_module['error_photo_after'];
	if (empty($error))
	{
	if ($_FILES['photo_befor']['tmp_name'] != '') {
            $upload_info = $upload->save_file($_FILES['photo_befor'], NV_ROOTDIR . '/' . $pathSaveUrl, false, true);
            @unlink($_FILES['photo_befor']['tmp_name']);
            if (!empty($upload_info['error'])) {
                $error[] = $upload_info['error'];
            } else {
                if (!empty($data['photo_befor'])) {
                    @unlink(NV_ROOTDIR . NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_name . '/' . $array_data['photo_befor']);
                }
                $data['photo_befor'] = substr($upload_info['name'], $length_substr);
            }
        }
    if ($_FILES['photo_after']['tmp_name'] != '') {
        $upload_info = $upload->save_file($_FILES['photo_after'], NV_ROOTDIR . '/' . $pathSaveUrl, false, true);
        @unlink($_FILES['photo_after']['tmp_name']);
        if (!empty($upload_info['error'])) {
            $error[] = $upload_info['error'];
        } else {
            if (!empty($data['photo_after'])) {
                @unlink(NV_ROOTDIR . NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_name . '/' . $array_data['photo_after']);
            }
            $data['photo_after'] = substr($upload_info['name'], $length_substr);
        }
    }
	
	$table_name = NV_PREFIXLANG . '_' . $module_data . '_users';
	$stmt = $db->prepare('UPDATE ' . $table_name . ' SET numbercard = :numbercard,affiliate_code = :affiliate_code,
	 daterange=:ngaycap, issuedby=:noicap, datatext=:datatext, 
	 provinceid=:provinceid, districtid=:districtid, photo_befor=:photo_befor, 
	 photo_after=:photo_after, address=:address, edit_time=' . NV_CURRENTTIME . 
	 ' WHERE userid =' . $data['userid']);
    $stmt->bindParam(':datatext', serialize($data), PDO::PARAM_STR);
    $stmt->bindParam(':numbercard', $data['cccd'], PDO::PARAM_STR);
    $stmt->bindParam(':affiliate_code', $data['affiliate_code'], PDO::PARAM_STR);
    $stmt->bindParam(':ngaycap', $data['ngaycap'], PDO::PARAM_STR);
    $stmt->bindParam(':noicap', $data['noicap'], PDO::PARAM_STR);
    $stmt->bindParam(':provinceid', $data['provinceid'], PDO::PARAM_INT);
    $stmt->bindParam(':districtid', $data['districtid'], PDO::PARAM_INT);
    $stmt->bindParam(':address', $data['address'], PDO::PARAM_INT);
    $stmt->bindParam(':photo_befor', $data['photo_befor'], PDO::PARAM_INT);
    $stmt->bindParam(':photo_after', $data['photo_after'], PDO::PARAM_INT);
    $stmt->execute();
	if ($stmt->rowCount()) {
		nv_fix_users_parent_order();
         $nv_Cache->delMod($module_name);
		 //Show kết quả đã đăng ký
		 $data=$db->query("SELECT kq.*, u.username, 
		 u.gender,u.first_name ,u.last_name, u.email FROM ".$table_name 
		 .' kq inner join '. NV_USERS_GLOBALTABLE . " u on kq.userid=u.userid
		 WHERE kq.userid = '" . $data['userid'] . "'" )->fetch();
		 $data['fullname']= $data['last_name'].' '.$data['first_name'];
		 $data['gender']= $data['gender']=='F'?$lang_module['gender_1']:$lang_module['gender_2'];
		 
		 $data['step']=5;
     } else {
         $error[] = $lang_module['errorsave'];
     }
	
	}
	$contents = multilevel_register($data,$error);
}
if (defined( 'NV_IS_USER' ) && $nv_Request->get_title('txtCheckss', 'post')=='')
{
	
	$table_name = NV_PREFIXLANG . '_' . $module_data . '_users';
	$data=$db->query("SELECT kq.*, u.username, 
		 u.gender,u.first_name ,u.last_name, u.email FROM ".$table_name 
		 .' kq inner join '. NV_USERS_GLOBALTABLE . " u on kq.userid=u.userid
		 WHERE kq.userid = '" . $user_info['userid'] . "'" )->fetch();
		 $data['fullname']= $data['last_name'].' '.$data['first_name'];
		 $data['gender']= $data['gender']=='F'?$lang_module['gender_1']:$lang_module['gender_2'];
		 $data_order_total=$db->query("SELECT count(*) as total FROM ".$db_config['prefix'] . "_shops_orders o WHERE o.user_id = '" . $user_info['userid'] . "' AND o.transaction_status = 4" )->fetch();
		 $data['fullname']= $data['last_name'].' '.$data['first_name'];
		 $data['gender']= $data['gender']=='F'?$lang_module['gender_1']:$lang_module['gender_2'];
	if($data_order_total['total'] > 0){
			if($data['affiliate_code'] == ''){
				$data['step']=4;
				$data['act1']=1;
				$error = array();
			}else{
				$data['step']=7;
				$data['act1']=1;
				$error = array();
			}
	}else{
		$data['step']=6;
		$data['act1']=1;
		$error = array();
	}
	$contents = multilevel_register($data,$error);
}

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
