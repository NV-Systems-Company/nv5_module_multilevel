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

/**
 * nv_theme_multilevel_main()
 * 
 * @param mixed $array_data
 * @return
 */
function nv_theme_multilevel_main($array_data)
{
    global $module_info, $lang_module, $lang_global, $op;

    $xtpl = new XTemplate($op . '.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_info['module_theme']);
    $xtpl->assign('LANG', $lang_module);
    $xtpl->assign('GLANG', $lang_global);

    //------------------
    // Viết code vào đây
    //------------------

    $xtpl->parse('main');
    return $xtpl->text('main');
}
function multilevel_register($array_data,$error=array(),$array_province=array())
{
    global $global_config, $module_name, $module_data,$module_info, $lang_module, $lang_global, $op,$module_config;
    $global_config['module_theme'] = $global_config['site_theme'];
	$xtpl = new XTemplate('multilevel_register.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_info['module_theme']);
	$xtpl->assign('LANG', $lang_module);
    $xtpl->assign('GLANG', $lang_global);
	$xtpl->assign('code', strtoupper($array_data['username']));
	$xtpl->assign('checkss', NV_CHECK_SESSION.$array_data['step']);
    $xtpl->assign('USER_REGISTER', NV_BASE_SITEURL.$array_data['username']);
    $xtpl->assign('NV_NAME_VARIABLE', NV_NAME_VARIABLE);
    $xtpl->assign('MODULE_NAME', $module_name);
    $xtpl->assign('NV_OP_VARIABLE', NV_OP_VARIABLE);
    $xtpl->assign('OP', 'register' );
	$array_data['nguoigioithieu']=empty($array_data['nguoigioithieu'])?strtoupper($array_data['username']):$array_data['nguoigioithieu'];
    $array_data['title']=$lang_module['register'];
	$array_data['act1']=$array_data['step']==''?'is-active':'';
	$array_data['act2']=$array_data['step']==2?'is-active':'';
	$array_data['act3']=$array_data['step']==3?'is-active':'';
	$xtpl->assign('DATA', $array_data );
	if (!empty($error))
	{
		$xtpl->assign('ERROR',implode('<br/>- ', $error));
        $xtpl->parse('main.error');
	}
	
	if (empty($array_data['step']) or ($array_data['step']==''))
	{
		$array_gender = array();
		$array_gender['N'] = $lang_module['gender_0'];
		$array_gender['F'] = $lang_module['gender_1'];
		$array_gender['M'] = $lang_module['gender_2'];
		foreach( $array_gender as $key => $gender )
		{
			$xtpl->assign( 'OPTION', array(
				'key' => $key,
				'title' => $gender,
				'selected' => ( $key == $array_data['gender'] ) ? ' selected="selected"' : '' ) );
			$xtpl->parse( 'main.step1.gender' );
		}
		$xtpl->parse( 'main.step1' );
	}
	else
	if ($array_data['step']==2)
	{
		
		if( $array_data['photo_befor'] != '' )
		{
			$xtpl->parse( 'main.step2.image_befor' );
		}
		if( $array_data['photo_after'] != '' )
		{
			$xtpl->parse( 'main.step2.image_after' );
		}
		
		$array_province = nv_Province();
		foreach( $array_province as $province )
		{
			$xtpl->assign( 'OPTION', array(
				'key' => $province['id'],
				'title' => $province['title'],
				'selected' => ( $province['id'] == $array_data['provinceid'] ) ? ' selected="selected"' : '' ) );
			$xtpl->parse( 'main.step2.select_province' );
		}
		if( $array_data['provinceid'] > 0 ){
			$xtpl->parse('main.step2.load_district');
		}
		$xtpl->parse('main.step2');
	}
    else
	if ($array_data['step']==3)
	{
		$array_data['title']=$lang_module['ok_register'];
		$xtpl->assign('DATA', $array_data );
		
		$xtpl->parse('main.step3');
	}
	$xtpl->parse('main');
    return $xtpl->text('main');
}
function multilevel_info_root($array_data)
{
    global $module_info, $lang_module, $lang_global, $op;

    $xtpl = new XTemplate('multilevel_info.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_info['module_theme']);
    $xtpl->assign('LANG', $lang_module);
    $xtpl->assign('GLANG', $lang_global);
    $xtpl->assign('username', $array_data['username']);

    //------------------
    // Viết code vào đây
    //------------------

    $xtpl->parse('main');
    return $xtpl->text('main');
}
function multilevel_no_user($array_data)
{
    global $module_info, $lang_module, $lang_global, $op;

    $xtpl = new XTemplate('multilevel_no_user.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_info['module_theme']);
    $xtpl->assign('LANG', $lang_module);
    $xtpl->assign('GLANG', $lang_global);

    //------------------
    // Viết code vào đây
    //------------------

    $xtpl->parse('main');
    return $xtpl->text('main');
}
/**
 * nv_theme_multilevel_detail()
 * 
 * @param mixed $array_data
 * @return
 */
function nv_theme_multilevel_detail($array_data)
{
    global $module_info, $lang_module, $lang_global, $op;

    $xtpl = new XTemplate($op . '.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_info['module_theme']);
    $xtpl->assign('LANG', $lang_module);
    $xtpl->assign('GLANG', $lang_global);

    //------------------
    // Viết code vào đây
    //------------------

    $xtpl->parse('main');
    return $xtpl->text('main');
}

/**
 * nv_theme_multilevel_search()
 * 
 * @param mixed $array_data
 * @return
 */
function nv_theme_multilevel_search($array_data)
{
    global $module_info, $lang_module, $lang_global, $op;

    $xtpl = new XTemplate($op . '.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_info['module_theme']);
    $xtpl->assign('LANG', $lang_module);
    $xtpl->assign('GLANG', $lang_global);

    //------------------
    // Viết code vào đây
    //------------------

    $xtpl->parse('main');
    return $xtpl->text('main');
}
function multilevel_register_npp($data,$error=array())
{
    global $global_config, $module_name, $module_data,$module_info, $lang_module, $lang_global, $op,$module_config;
    $xtpl = new XTemplate('multilevel_register_npp.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_info['module_theme']);
	$xtpl->assign('LANG', $lang_module);
    $xtpl->assign('GLANG', $lang_global);
	$xtpl->assign('code', strtoupper($data['username']));
	$xtpl->assign('txtCheckss', NV_CHECK_SESSION);
    $xtpl->assign('TEMPLATE', $module_info['template']);
    $xtpl->assign('NV_NAME_VARIABLE', NV_NAME_VARIABLE);
    $xtpl->assign('MODULE_NAME', $module_name);
    $xtpl->assign('NV_OP_VARIABLE', NV_OP_VARIABLE);
    $xtpl->assign('OP', 'manager_npp' );
    $xtpl->assign('DATA', $data );
    $xtpl->assign('script', NV_BASE_SITEURL.'themes/' . $module_info['template'] .'/js/select2.min.js' );
	if (!empty($error))
	{
		$xtpl->assign('ERROR',implode('<br/>- ', $error));
        $xtpl->parse('main.error');
	}
	
	
	$array_province = nv_Province();
	foreach( $array_province as $province )
	{
		$xtpl->assign( 'OPTION', array(
			'key' => $province['id'],
			'title' => $province['title'],
			'selected' =>  in_array( $province['id'],$data['provinceid']) ? ' selected ' : '' ) );
		$xtpl->parse( 'main.select_province' );
	}
	$xtpl->parse('main');
	
    return $xtpl->text('main');
}
function nv_memberslist_theme($data)
{
    global $module_info, $lang_module, $lang_global, $op;

    $xtpl = new XTemplate($op . '.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_info['module_theme']);
    $xtpl->assign('LANG', $lang_module);
    $xtpl->assign('GLANG', $lang_global);
	
    

    $xtpl->parse('main.view');
    $xtpl->parse('main');
    return $xtpl->text('main');
}



function nv_affilate_maps( $array_data )
{
    global $module_info, $module_file, $array_agency, $array_possiton, $global_config, $module_name, $lang_module, $user_info, $array_province, $user_data_affiliate, $op;


    $link_warehouse = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=warehouselogs&userid=';
    $link_doanhso = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=doanhso&userid=';
    $link_affiliate = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=';
    $link_export = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=export';
    $link_load_sub = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op . '&loadsub=1';
    $xtpl = new XTemplate( 'maps.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file );
    $xtpl->assign( "LANG", $lang_module );
    $xtpl->assign( 'NV_BASE_SITEURL', NV_BASE_SITEURL );
    $xtpl->assign( 'TEMPLATE', $module_info['template'] );
    $xtpl->assign( 'module_file', $module_file );
    $xtpl->assign( 'user_info', $user_info );
    $xtpl->assign('NV_NAME_VARIABLE', NV_NAME_VARIABLE);
    $xtpl->assign('NV_OP_VARIABLE', NV_OP_VARIABLE);
    $xtpl->assign('MODULE_NAME', $module_name);
    $xtpl->assign('OP', $op);


    $xtpl->assign( "LOADSUB", $link_load_sub );
    $array_data['postion'] = ( $array_data['agencyid']> 0 && isset( $array_agency[$array_data['agencyid']] ) )? $array_agency[$array_data['agencyid']]['title'] : $array_possiton[$array_data['possitonid']]['title'];
    $array_data['fullname'] = nv_show_name_user( $array_data['first_name'] , $array_data['last_name'] , $array_data['username']  );
    $array_data['province_name'] = isset( $array_province[$array_data['provinceid']] )? $array_province[$array_data['provinceid']]['title'] : '';

    $xtpl->assign( 'DATA_ROOT', $array_data );

    if( ! empty( $array_data['data'] ) )
    {

        foreach( $array_data['data'] as $data_i )
        {
            $data_i['postion'] = ( $data_i['agencyid']> 0 && isset( $array_agency[$data_i['agencyid']] ) )? $array_agency[$data_i['agencyid']]['title'] : $array_possiton[$data_i['possitonid']]['title'];
            $data_i['checkss'] = md5($data_i['userid'] . $global_config['sitekey'] . session_id());
            if( isset( $data_i['possitonid'] ) && $data_i['possitonid'] == 0){
                $data_i['link_edit'] = $link_affiliate . 'register&userid=' . $data_i['userid'] . '&checkss=' . md5($data_i['userid'] . $global_config['sitekey'] . session_id());
                $data_i['link_warehouse'] = $link_warehouse . $data_i['userid'] . '&checkss=' . md5($data_i['userid'] . $global_config['sitekey'] . session_id());
            }else{
                if( $user_info['userid'] == $data_i['userid'] ){
                    $data_i['link_edit'] = $link_affiliate . 'editinfo';
                }else{
                    $data_i['link_edit'] = $data_i['lang_edit'] = '';
                }

                $data_i['link_warehouse'] = $link_doanhso . $data_i['userid'] . '&checkss=' . md5($data_i['userid'] . $global_config['sitekey'] . session_id());
            }
            if( $data_i['numsubcat'] > 0 ){
                $data_i['hasnumsubcat'] = ' class=hasnumsubcat';
            }else{
                $data_i['hasnumsubcat'] = '';
            }

            $data_i['province_name'] = isset( $array_province[$data_i['provinceid']] )? $array_province[$data_i['provinceid']]['title'] : '';
            $data_i['fullname'] = nv_show_name_user( $data_i['first_name'] , $data_i['last_name'] , $data_i['username']  );
            $data_i['pendingdelete_text'] = date('H:i, d/m/Y', $data_i['pendingdelete'] );
            $xtpl->assign( "SUBITEM", $data_i );
            if( $user_data_affiliate['permission'] == 1 ){
                if( $data_i['status'] == 0 ){
                    $xtpl->parse( 'main.subitem.permission.active' );
                }
                if( $data_i['pendingdelete'] > 0 ){
                    $xtpl->parse( 'main.subitem.permission.pendingdelete' );
                }else{
                    $xtpl->parse( 'main.subitem.permission.nopendingdelete' );
                }
                $xtpl->parse( 'main.subitem.permission' );
            }

            $xtpl->parse( 'main.subitem' );
        }
    }

    $xtpl->parse( 'main' );
    $content_i = $xtpl->text( 'main' );
    return $content_i;
}


function nv_affilate_maps_sub( $array_data )
{
    global $module_info, $module_file, $array_agency, $array_possiton, $global_config, $module_name, $lang_module, $user_info, $array_province, $user_data_affiliate, $op;


    $link_warehouse = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=warehouselogs&userid=';
    $link_doanhso = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=doanhso&userid=';
    $link_affiliate = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=';
    $link_export = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=export';
    $link_load_sub = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op . '&loadsub=1';
    $xtpl = new XTemplate( 'maps.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file );

    $xtpl->assign( "LANG", $lang_module );
    $xtpl->assign( "LOADSUB", $link_load_sub );

    if( ! empty( $array_data ) )
    {
        foreach( $array_data as $data_i )
        {
            $data_i['postion'] = ( $data_i['agencyid']> 0 && isset( $array_agency[$data_i['agencyid']] ) )? $array_agency[$data_i['agencyid']]['title'] : $array_possiton[$data_i['possitonid']]['title'];
            $data_i['checkss'] = md5($data_i['userid'] . $global_config['sitekey'] . session_id());
            if( isset( $data_i['possitonid'] ) && $data_i['possitonid'] == 0){
                $data_i['link_edit'] = '';
                $data_i['link_warehouse'] = $link_warehouse . $data_i['userid'] . '&checkss=' . md5($data_i['userid'] . $global_config['sitekey'] . session_id());
            }else{
                if( $user_info['userid'] == $data_i['userid'] ){
                    $data_i['link_edit'] = $link_affiliate . 'editinfo';
                }else{
                    $data_i['link_edit'] = $data_i['lang_edihasnumsubcatt'] = '';
                }

                $data_i['link_warehouse'] = $link_doanhso . $data_i['userid'] . '&checkss=' . md5($data_i['userid'] . $global_config['sitekey'] . session_id());
            }
            if( $data_i['numsubcat'] > 0 ){
                $data_i['hasnumsubcat'] = ' class=hasnumsubcat';
            }else{
                $data_i['hasnumsubcat'] = '';
            }
            $data_i['pendingdelete_text'] = date('H:i, d/m/Y', $data_i['pendingdelete'] );
            $data_i['province_name'] = isset( $array_province[$data_i['provinceid']] )? $array_province[$data_i['provinceid']]['title'] : '';
            $data_i['fullname'] = nv_show_name_user( $data_i['first_name'] , $data_i['last_name'] , $data_i['username']  );
            $xtpl->assign( "SUBITEM", $data_i );
            if( $user_data_affiliate['permission'] == 1 ){
                if( $data_i['status'] == 0 ){
                    $xtpl->parse( 'tree.subitem.permission.active' );
                }
                if( $data_i['pendingdelete'] > 0 ){
                    $xtpl->parse( 'tree.subitem.permission.pendingdelete' );
                }else{
                    $xtpl->parse( 'tree.subitem.permission.nopendingdelete' );
                }
                $xtpl->parse( 'tree.subitem.permission' );
            }
            $xtpl->parse( 'tree.subitem' );
        }
    }

    $xtpl->parse( 'tree' );
    $content_i = $xtpl->text( 'tree' );
    return $content_i;
}