<?php

/**
 * @Project NUKEVIET 4.x
 * @Author NVholding <contact@nvholding.vn>
 * @Copyright (C) 2021 NVholding. All rights reserved
 * @License: Not free read more http://nukeviet.vn/vi/store/modules/nvtools/
 * @Createdate Sat, 17 Jul 2021 08:08:05 GMT
 */

if (!defined('NV_IS_FILE_ADMIN'))
    die('Stop!!!');

$getCity = getCity();
$getDistrict = getDistrict();

$page_title = $lang_module['district'];

if( ACTION_METHOD == 'weight' )
{
	$json = array();

	$district_id = $nv_Request->get_int( 'district_id', 'get,post', 0 );

	$token = $nv_Request->get_title( 'token', 'post', '', 1 );

	$new_vid = $nv_Request->get_int( 'new_vid', 'post', 0 );

	if( ! isset( $getDistrict[$district_id] ) )
	{
		$json['error'] = $lang_module['district_error_security'];
	}

	if( ! isset( $json['error'] ) )
	{
		if( $new_vid > 0 )
		{
			$sql = 'SELECT district_id FROM ' . TABLE_LOCALION_NAME . '_district WHERE district_id != ' . $district_id . ' ORDER BY weight ASC';

			$result = $db->query( $sql );

			$weight = 0;

			while( $row = $result->fetch() )
			{
				$weight++;

				if( $weight == $new_vid ) $weight++;

				$query = 'UPDATE ' . TABLE_LOCALION_NAME . '_district SET weight=' . $weight . " WHERE district_id=" . $row['district_id'];
				$db->query( $query );
			}

			$query = 'UPDATE ' . TABLE_LOCALION_NAME . '_district SET weight=' . $new_vid . ' WHERE district_id=' . $district_id;

			$db->query( $query );

			$nv_Cache->delMod( $module_name );

			nv_insert_logs( NV_LANG_DATA, $module_name, 'Change Weight district', "district_id: " . $district_id, $admin_info['userid'] );

			$json['success'] = $lang_module['district_update_success'];
		}
	}

	get_output_json( $json );

}

if( ACTION_METHOD == 'delete' )
{
	$json = array();

	$district_id = $nv_Request->get_int( 'district_id', 'post', 0 );

	$token = $nv_Request->get_title( 'token', 'post', '', 1 );

	$listid = $nv_Request->get_string( 'listid', 'post', '' );

	if( $listid != '' and md5( $global_config['sitekey'] . session_id() ) == $token )
	{
		$del_array = array_map( 'intval', explode( ',', $listid ) );
	}
	elseif( $token == md5( $global_config['sitekey'] . session_id() . $district_id ) )
	{
		$del_array = array( $district_id );
	}

	if( ! empty( $del_array ) )
	{

		$_del_array = array();
		$no_del_array = array();

		$a = 0;
		foreach( $del_array as $district_id )
		{

			$ward_total = $db->query( 'SELECT COUNT(*) total FROM ' . TABLE_LOCALION_NAME . '_ward WHERE district_id = ' . ( int )$district_id )->fetchColumn();

			if( $ward_total )
			{
				$json['error'] = sprintf( $lang_module['district_error_ward'], $ward_total );
			}
			else
			{
				$db->query( 'DELETE FROM ' . TABLE_LOCALION_NAME . '_district WHERE district_id = ' . ( int )$district_id );

				$json['id'][$a] = $district_id;

				$_del_array[] = $district_id;

				++$a;
			}
		}

		$count = sizeof( $_del_array );

		if( $count )
		{
			fixWeightDistrict();

			nv_insert_logs( NV_LANG_DATA, $module_name, 'log_del_district', implode( ', ', $_del_array ), $admin_info['userid'] );

			$nv_Cache->delMod( $module_name );

			$json['success'] = $lang_module['district_delete_success'];
		}

	}
	else
	{
		$json['error'] = $lang_module['district_error_security'];
	}

	get_output_json( $json );

}

if( ACTION_METHOD == 'add' || ACTION_METHOD == 'edit' )
{
	$data = array(
		'district_id' => 0,
		'city_id' => 0,
		'title' => '',
		'alias' => '',
		'weight' => 0,
		'status' => 0,
		);
	$error = array();

	$data['city_id'] = $nv_Request->get_int( 'city_id', 'get,post', 0 );
	$data['district_id'] = $nv_Request->get_int( 'district_id', 'get,post', 0 );

	if( $data['district_id'] > 0 )
	{
		$data = $db->query( 'SELECT * FROM ' . TABLE_LOCALION_NAME . '_district WHERE district_id=' . $data['district_id'] )->fetch();

		$caption = $lang_module['district_edit'];

	}
	else
	{
		$caption = $lang_module['district_add'];
	}

	if( $nv_Request->get_int( 'save', 'post' ) == 1 )
	{

		$data['district_id'] = $nv_Request->get_int( 'district_id', 'post', 0 );
		$data['city_id'] = $nv_Request->get_int( 'city_id', 'post', 0 );
		$data['title'] = $nv_Request->get_title( 'title', 'post', '', 1 );

		if( empty( $data['title'] ) )
		{
			$error['title'] = $lang_module['district_error_title'];
		}
		if( empty( $data['city_id'] ) )
		{
			$error['city'] = $lang_module['city_error_city'];
		}
		if( empty( $error ) )
		{
			$data['alias'] = change_alias( $data['title'] . '-' . $data['district_id'] );

			if( $data['district_id'] == 0 )
			{
				$weight = $db->query( 'SELECT max(weight) FROM ' . TABLE_LOCALION_NAME . '_district WHERE city_id= "' . $data['city_id'] . '"' )->fetchColumn();
				$weight = intval( $weight ) + 1;

				$query = 'INSERT INTO ' . TABLE_LOCALION_NAME . '_district (city_id,title,alias,weight,status)VALUES(    
					' . intval( $data['city_id'] ) . ', 
					' . $db->quote( $data['title'] ) . ', 
					' . $db->quote( $data['alias'] ) . ', 
					' . intval( $weight ) . ', 1 )';

				$data['district_id'] = ( int )$db->insert_id( $query );

				if( $data['district_id'] > 0 )
				{
					$data['alias'] = change_alias( $data['title'] . '-' . $data['district_id'] );
					$sql = 'UPDATE ' . TABLE_LOCALION_NAME . '_district SET 
						alias = ' . $db->quote( $data['alias'] ) . ' 
						WHERE district_id=' . $data['district_id'];
					if( $db->query( $sql ) )
					{
						$nv_Request->set_Session( $module_data . '_success', $lang_module['district_insert_success'] );

						nv_insert_logs( NV_LANG_DATA, $module_name, 'Add A District', 'district_id: ' . $data['district_id'], $admin_info['userid'] );
					}
					else
					{
						$error['warning'] = $lang_module['district_error_save'];

					}

				}
				else
				{
					$error['warning'] = $lang_module['district_error_save'];

				}

			}
			else
			{
				$sql = 'UPDATE ' . TABLE_LOCALION_NAME . '_district SET 
					city_id = ' . intval( $data['city_id'] ) . ', 
					title = ' . $db->quote( $data['title'] ) . ', 
					alias = ' . $db->quote( $data['alias'] ) . ' 
					WHERE district_id=' . $data['district_id'];

				if( $db->query( $sql ) )
				{
					$nv_Request->set_Session( $module_data . '_success', $lang_module['city_update_success'] );

					nv_insert_logs( NV_LANG_DATA, $module_name, 'Edit A District', 'district_id: ' . $data['district_id'], $admin_info['userid'] );
				}
				else
				{
					$error['warning'] = $lang_module['district_error_save'];

				}

			}

			if( empty( $error ) )
			{
				$nv_Cache->delMod( $module_name );
				Header( 'Location: ' . NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op . '&city_id=' . $data['city_id'] );
				die();
			}

		}

	}
	$xtpl = new XTemplate( "district_add.tpl", NV_ROOTDIR . "/themes/" . $global_config['module_theme'] . "/modules/" . $module_file );
	$xtpl->assign( 'LANG', $lang_module );
	$xtpl->assign( 'GLANG', $lang_global );
	$xtpl->assign( 'NV_BASE_SITEURL', NV_BASE_SITEURL );
	$xtpl->assign( 'MODULE_FILE', $module_file );
	$xtpl->assign( 'CAPTION', $caption );
	$xtpl->assign( 'CANCEL', NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op );
	$xtpl->assign( 'DATA', $data );

	foreach( $getCity as $key => $city )
	{
		$xtpl->assign( 'CITY', array(
			'key' => $key,
			'name' => $city['title'],
			'selected' => ( $key == $data['city_id'] ) ? 'selected="selected"' : '' ) );
		$xtpl->parse( 'main.city' );
	}

	if( isset( $error['title'] ) )
	{
		$xtpl->assign( 'error_title', $error['title'] );
		$xtpl->parse( 'main.error_title' );
	}

	if( isset( $error['city'] ) )
	{
		$xtpl->assign( 'error_city', $error['city'] );
		$xtpl->parse( 'main.error_city' );
	}
	if( isset( $error['warning'] ) )
	{
		$xtpl->assign( 'error_warning', $error['warning'] );
		$xtpl->parse( 'main.error_warning' );
	}

	$xtpl->parse( 'main' );
	$contents = $xtpl->text( 'main' );
	include NV_ROOTDIR . '/includes/header.php';
	echo nv_admin_theme( $contents );
	include NV_ROOTDIR . '/includes/footer.php';

	exit();
}

/* Hiện danh sách quốc gia*/

$per_page = 50;

$page = $nv_Request->get_int( 'page', 'get', 1 );

$city_id = $nv_Request->get_int( 'city_id', 'get', 0 );

$sql = TABLE_LOCALION_NAME . '_district WHERE 1';

if( $city_id > 0 )
{
	$sql .= ' AND city_id = ' . $city_id;
}

$db_slave->sqlreset()->select( 'COUNT(*)' )->from( $sql );

$num_items = $db_slave->query( $db_slave->sql() )->fetchColumn();

$sort = $nv_Request->get_string( 'sort', 'get', '' );

$order = $nv_Request->get_string( 'order', 'get' ) == 'desc' ? 'desc' : 'asc';

$sort_data = array( 'title', 'weight' );
$sql .= " ORDER BY  city_id  ASC";
if( isset( $sort ) && in_array( $sort, $sort_data ) )
{

	$sql .= ", " . $sort;
}
else
{
	$sql .= ", weight";
}

if( isset( $order ) && ( $order == 'desc' ) )
{
	$sql .= " DESC";
}
else
{
	$sql .= " ASC";
}

$base_url = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op . '&amp;city_id=' . $city_id;

$db_slave->sqlreset()->select( '*' )->from( $sql )->limit( $per_page )->offset( ( $page - 1 ) * $per_page );

$result = $db_slave->query( $db_slave->sql() );

$array = array();

while( $rows = $result->fetch() )
{
	$array[] = $rows;
}

$xtpl = new XTemplate( "district.tpl", NV_ROOTDIR . "/themes/" . $global_config['module_theme'] . "/modules/" . $module_file );
$xtpl->assign( 'LANG', $lang_module );
$xtpl->assign( 'GLANG', $lang_global );
$xtpl->assign( 'NV_BASE_SITEURL', NV_BASE_SITEURL );
$xtpl->assign( 'MODULE_FILE', $module_file );
$xtpl->assign( 'TOKEN', md5( $global_config['sitekey'] . session_id() ) );
$xtpl->assign( 'ADD_NEW', NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op . '&amp;action=add&city_id=' . $city_id );

if( $nv_Request->get_string( $module_data . '_success', 'session' ) )
{
	$xtpl->assign( 'SUCCESS', $nv_Request->get_string( $module_data . '_success', 'session' ) );

	$xtpl->parse( 'main.success' );

	$nv_Request->unset_request( $module_data . '_success', 'session' );

}

if( ! empty( $array ) )
{
	$a = 1;
	if( $city_id > 0 )
	{
		$xtpl->parse( 'main.weightshowlang' );
	}
	foreach( $array as $item )
	{

		$item['class'] = ( $a % 2 ) ? 'class="second"' : '';

		$item['token'] = md5( $global_config['sitekey'] . session_id() . $item['district_id'] );

		$item['city'] = isset( $getCity[$item['city_id']] ) ? $getCity[$item['city_id']]['title'] : '';

		$item['edit'] = NV_BASE_ADMINURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&" . NV_NAME_VARIABLE . "=" . $module_name . "&" . NV_OP_VARIABLE . "=district&action=edit&token=" . $item['token'] . "&district_id=" . $item['district_id'];

		$item['ward_link'] = NV_BASE_ADMINURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&" . NV_NAME_VARIABLE . "=" . $module_name . "&" . NV_OP_VARIABLE . "=ward&district_id=" . $item['district_id'];

		$item['ward_add'] = NV_BASE_ADMINURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&" . NV_NAME_VARIABLE . "=" . $module_name . "&" . NV_OP_VARIABLE . "=ward&action=add&city_id=" . $item['city_id'] . '&district_id=' . $item['district_id'];

		$item['city_link'] = NV_BASE_ADMINURL . "index.php?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&" . NV_NAME_VARIABLE . "=" . $module_name . "&" . NV_OP_VARIABLE . "=district&city_id=" . $item['city_id'];

		$xtpl->assign( 'LOOP', $item );
		if( $city_id > 0 )
		{
			for( $i = 1; $i <= $num_items; ++$i )
			{
				$xtpl->assign( 'WEIGHT', array( 'w' => $i, 'selected' => ( $i == $item['weight'] ) ? ' selected="selected"' : '' ) );

				$xtpl->parse( 'main.loop.weightshow.weight' );
			}
			$xtpl->parse( 'main.loop.weightshow' );

		}
		$xtpl->parse( 'main.loop' );
		++$a;
	}

}

$generate_page = nv_generate_page( $base_url, $num_items, $per_page, $page );

if( ! empty( $generate_page ) )
{

	$xtpl->assign( 'GENERATE_PAGE', $generate_page );
	$xtpl->parse( 'main.generate_page' );
}

$xtpl->parse( 'main' );
$contents = $xtpl->text( 'main' );

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme( $contents );
include NV_ROOTDIR . '/includes/footer.php';
