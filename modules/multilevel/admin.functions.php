<?php

/**
 * @Project NUKEVIET 4.x
 * @Author NVholding <contact@nvholding.vn>
 * @Copyright (C) 2021 NVholding. All rights reserved
 * @License: Not free read more http://nukeviet.vn/vi/store/modules/nvtools/
 * @Createdate Sat, 17 Jul 2021 08:08:05 GMT
 */

if (!defined('NV_ADMIN') or !defined('NV_MAINFILE') or !defined('NV_IS_MODADMIN'))
    die('Stop!!!');

define('NV_IS_FILE_ADMIN', true);

$allow_func = array( 'main', 'config', 'city', 'district', 'ward');

define( 'ACTION_METHOD', $nv_Request->get_string( 'action', 'get,post', '' ) ); 	
	
	
	
define( 'TABLE_LOCALION_NAME', NV_PREFIXLANG . '_' . $module_data ); 
function getCity()
{
	global $module_name, $nv_Cache;

	$sql = 'SELECT city_id, title FROM ' . TABLE_LOCALION_NAME . '_city WHERE status=1 ORDER BY weight ASC';
	
	return $nv_Cache->db($sql, 'city_id', $module_name);
}

function getDistrict()
{
	global $module_name, $nv_Cache;

	$sql = 'SELECT district_id, city_id, title FROM ' . TABLE_LOCALION_NAME . '_district WHERE status=1 ORDER BY weight ASC';

	return $nv_Cache->db($sql, 'district_id', $module_name);
}

function getWard()
{
	global $module_name, $nv_Cache;

	$sql = 'SELECT ward_id, district_id, city_id, title FROM ' . TABLE_LOCALION_NAME . '_ward WHERE status=1 ORDER BY weight ASC';
	
	return $nv_Cache->db($sql, 'ward_id', $module_name);
}


function fixWeightCity()
{
	global $db, $module_data;

	$sql = 'SELECT city_id FROM ' . TABLE_LOCALION_NAME . '_city ORDER BY weight ASC';
	$result = $db->query( $sql );
	$weight = 0;
	while( $row = $result->fetch() )
	{
		$weight++;
		$query = 'UPDATE ' . TABLE_LOCALION_NAME . '_city SET weight=' . $weight . ' WHERE city_id=' . $row['city_id'];
		$db->query( $query );
	}
}

function fixWeightDistrict()
{
	global $db, $module_data;
	$sql = 'SELECT city_id FROM ' . TABLE_LOCALION_NAME . '_city ORDER BY weight ASC';
	$result = $db->query( $sql );
	while( $row = $result->fetch() )
	{
	
		$sql = 'SELECT district_id FROM ' . TABLE_LOCALION_NAME . '_district WHERE city_id=' . $row['city_id'] . ' ORDER BY weight ASC';
		$resultd = $db->query( $sql );
		$weight = 0;
		while( $rowd = $resultd->fetch() )
		{
			$weight++;
			$query = 'UPDATE ' . TABLE_LOCALION_NAME . '_district SET weight=' . $weight . ' WHERE district_id=' . $rowd['district_id'];
			$db->query( $query );
		}
	
	
	
	
		$query = 'UPDATE ' . TABLE_LOCALION_NAME . '_city SET weight=' . $weight . ' WHERE city_id=' . $row['city_id'];
		$db->query( $query );
	}

}
 
function fixWeightWard()
{
	global $db, $module_data;
	$sql = 'SELECT district_id FROM ' . TABLE_LOCALION_NAME . '_district ORDER BY weight ASC';
	$result = $db->query( $sql );
	while( $row = $result->fetch() )
	{
		$sql = 'SELECT ward_id FROM ' . TABLE_LOCALION_NAME . '_ward WHERE district_id=' . $row['district_id'] . ' ORDER BY weight ASC';
		$resultw = $db->query( $sql );
		$weight = 0;
		while( $roww = $resultw->fetch() )
		{
			$weight++;
			$query = 'UPDATE ' . TABLE_LOCALION_NAME . '_ward SET weight=' . $weight . ' WHERE ward_id=' . $roww['ward_id'];
			$db->query( $query );
		}
		
	}
	
}

$sql = 'SELECT * FROM ' . NV_PREFIXLANG . '_location_city';
$global_raovat_city = $nv_Cache->db($sql, 'city_id', 'location');
 
$sql = 'SELECT * FROM ' . NV_PREFIXLANG . '_location_district';
$global_raovat_district = $nv_Cache->db($sql, 'district_id', 'location');
 
$sql = 'SELECT * FROM ' . NV_PREFIXLANG . '_location_ward';
$global_raovat_ward = $nv_Cache->db($sql, 'ward_id', 'location');

function getOutputJson( $json )
{
	global $global_config, $db, $lang_global, $lang_module, $language_array, $nv_parse_ini_timezone, $countries, $module_info, $site_mods;

	@Header( 'Content-Type: application/json' );
	@Header( 'Content-Type: text/html; charset=' . $global_config['site_charset'] );
	@Header( 'Content-Language: ' . $lang_global['Content_Language'] );
	@Header( 'Last-Modified: ' . gmdate( 'D, d M Y H:i:s', strtotime( '-1 day' ) ) . " GMT" );
	@Header( 'Expires: ' . gmdate( 'D, d M Y H:i:s', NV_CURRENTTIME - 60 ) . " GMT" );
	
	echo json_encode( $json );
	unset( $GLOBALS['db'], $GLOBALS['lang_module'], $GLOBALS['language_array'], $GLOBALS['nv_parse_ini_timezone'],$GLOBALS['countries'], $GLOBALS['module_info'], $GLOBALS['site_mods'], $GLOBALS['lang_global'], $GLOBALS['global_config'], $GLOBALS['client_info'] );
	
	exit();
}

