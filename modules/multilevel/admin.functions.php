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

$allow_func = array( 'main', 'config', 'city', 'district', 'ward');

define( 'ACTION_METHOD', $nv_Request->get_string( 'action', 'get,post', '' ) ); 	
	
	
	
define( 'TABLE_LOCALION_NAME', NV_PREFIXLANG . '_' . $module_data ); 
define( 'TABLE_SHOP_NAME', $db_config['prefix'] . '_shops'  ); 
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

$sql = 'SELECT * FROM ' . TABLE_LOCALION_NAME . '_city';
$global_multilevel_city = $nv_Cache->db($sql, 'city_id', 'location');
 
$sql = 'SELECT * FROM ' . TABLE_LOCALION_NAME . '_district';
$global_multilevel_district = $nv_Cache->db($sql, 'district_id', 'location');
 
$sql = 'SELECT * FROM ' . TABLE_LOCALION_NAME . '_ward';
$global_multilevel_ward = $nv_Cache->db($sql, 'ward_id', 'location');

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


$array_permissions_action['ketoan'] = array(
    'title' => $lang_module['ketoan'],
    'description' => $lang_module['ketoan_description'],
    'key' => 'ketoan',
    'list_op' => array(
        'main',
        'product',
        'tranfer',
        'warehouse',
        'discounts',
        'warehouse_logs',
        'orders',
        'shareholder',
        'shareholded',
        'or_del',
        'or_view',
        'orview_shareholder',
        'customer',
        'export'
    ),
    'submenu' => array(
        'warehouse_logs',
        'shareholder',
        'shareholded',
        'product',
        'orders',
        'discounts',
        'customer'
    ),
);

$array_permissions_action['kho'] = array(
    'title' => $lang_module['kho'],
    'description' => $lang_module['kho_description'],
    'key' => 'kho',
    'list_op' => array(
        'main',
        'product',
        'warehouse',
        'tranfer',
        'warehouse_logs',
        'importplan',
        'orders',
        'shareholder',
        'shareholded',
        'or_view',
        'orview_shareholder',
        'customer',
        'export'
    ),
    'submenu' => array(
        'warehouse_logs',
        'importplan',
        'shareholder',
        'shareholded',
        'product',
        'orders',
        'customer'
    ),
);

//neu la admin lev 2 hoac 1
if( defined( 'NV_IS_SPADMIN' ) )
{
    $submenu['product'] = $lang_module['product'];
    $submenu['orders'] = $lang_module['orders'];
    $submenu['shareholder'] = $lang_module['shareholder'];
    $submenu['shareholded'] = $lang_module['shareholded'];
    $submenu['warehouse_logs'] = $lang_module['warehouse_logs'];
    $submenu['importplan'] = $lang_module['importplan'];
    $submenu['customer'] = $lang_module['customer'];
    $submenu['discounts'] = $lang_module['discounts'];
    $submenu['saleoff'] = $lang_module['saleoff'];
    $submenu['prounit'] = $lang_module['prounit'];
    $submenu['depot'] = $lang_module['depot'];
    $submenu['config'] = $lang_module['config'];

    $allow_func = array(
        'main',
        'customer',
        'customerajax',
        'change_cat',
        'prounit',
        'product',
        'addproduct',
        'discounts',
        'saleoff',
        'saleoff_detail',
        'orders',
        'shareholder',
        'shareholded',
        'or_del',
        'or_view',
        'orview_shareholder',
        'warehouse',
        'warehouse_logs',
        'importplan',
        'config',
        'depot',
        'tranfer',
        'userajax',
        'export'
    );
}
else
{
    $list_allow_func = '';
    foreach( $module_config[$module_name] as $key => $value )
    {
        if( isset( $array_permissions_action[$key] ) )
        {
            $value = explode( ',', $value );
            if( in_array( $admin_info['userid'], $value ) )
            {
                $array_chuc_danh[$key] = $key;
                $list_allow_func .= implode( ',', $array_permissions_action[$key]['list_op'] ) . ',';
                $list_submenu = $array_permissions_action[$key]['submenu'];
                foreach( $list_submenu as $keysub )
                {
                    $submenu[$keysub] = $lang_module[$keysub];
                }
            }
        }
    }
    $list_allow_func = substr( $list_allow_func, 0, strlen( $list_allow_func ) - 1 );
    $allow_func = explode( ',', $list_allow_func );
}

require_once NV_ROOTDIR . '/modules/' . $module_file . '/global.functions.php';
define('NV_IS_FILE_ADMIN', true);
/* 
$_sql = 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_cat WHERE status=1 ORDER BY sort ASC';
$array_global_cat = $nv_Cache->db($_sql, 'id', $module_name);
 */
$_sql = 'SELECT * FROM ' . TABLE_SHOP_NAME . '_units ORDER BY id ASC';
$array_units = $nv_Cache->db($_sql, 'id', $module_name);

$_sql = 'SELECT id, ' . NV_LANG_DATA . '_title AS title FROM ' . TABLE_SHOP_NAME . '_rows WHERE status=1';
$array_shops_rows = $nv_Cache->db($_sql, 'id', 'shops');

/* quet update cac tk da co don hang
$sql = 'SELECT t2.userid FROM ' . NV_PREFIXLANG . '_' . $module_data . '_orders AS t1 INNER JOIN ' . NV_TABLE_AFFILIATE . '_users AS t2 ON t1.customer_id=t2.userid WHERE t1.chossentype!=3 AND t2.haveorder=0';
$result = $db->query($sql);
while ( $row = $result->fetch()){
    $db->query('UPDATE ' . NV_TABLE_AFFILIATE . '_users SET haveorder=1 WHERE userid=' . $row['userid']);
}
*/

/**
 * nv_fix_order()
 *
 * @param integer $parentid
 * @param integer $order
 * @paraminteger $lev
 * @return
 *
 */
function nv_fix_order($table_name, $parentid = 0, $sort = 0, $lev = 0)
{
    global $db;

    $sql = 'SELECT id, parentid FROM ' . $table_name . ' WHERE parentid=' . $parentid . ' ORDER BY weight ASC';
    $result = $db->query($sql);
    $array_order = array();
    while ($row = $result->fetch()) {
        $array_order[] = $row['id'];
    }
    $result->closeCursor();
    $weight = 0;
    if ($parentid > 0) {
        ++$lev;
    } else {
        $lev = 0;
    }
    foreach ($array_order as $order_i) {
        ++$sort;
        ++$weight;
        $sql = 'UPDATE ' . $table_name . ' SET weight=' . $weight . ', sort=' . $sort . ', lev=' . $lev . ' WHERE id=' . $order_i;
        $db->query($sql);

        $sort = nv_fix_order($table_name, $order_i, $sort, $lev);
    }
    $numsub = $weight;

    if ($parentid > 0) {
        $sql = "UPDATE " . $table_name . " SET numsub=" . $numsub;
        if ($numsub == 0) {
            $sql .= ",subid=''";
        } else {
            $sql .= ",subid='" . implode(",", $array_order) . "'";
        }
        $sql .= " WHERE id=" . intval($parentid);
        $db->query($sql);
    }
    return $sort;
}

/**
 * nvGetCustomeridAgency()
 *
 * ham lay tat ca cac DL nhap hang truc tiep tu cty
 * @return
 */

function nvGetCustomeridAgency()
{
    global $db;

    $list_custusmer = array();
    $result = $db->query('SELECT userid, subcatid FROM ' . NV_TABLE_AFFILIATE . '_users WHERE possitonid>0' );

    while ( $row = $result->fetch()){
        if( !empty( $row['subcatid'] )){
            $list_custusmer[] = $row['subcatid'];
        }
    }
    $list_custusmer = implode(',', $list_custusmer );
    return $list_custusmer;

}


//update noi dung cham soc khach hang
function nvUpdatemsQueueByHeader( $proid )
{
    global $db, $module_data;

    $result = $db->query('SELECT order_id, proid FROM ' . NV_PREFIXLANG . '_' . $module_data . '_message_queue WHERE proid=' . $proid );

    while ( list( $order_id, $proid ) = $result->fetch(3)){
        //lay thong tin don hang dat cua kh
        $data_order = $db->query('SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_orders WHERE order_id=' . $order_id )->fetch();
        if(!empty( $data_order )){
            $day_received = ($data_order['order_shipcod'] == 1) ? NV_DEFINE_DAY_RECEIVED : 0;
            $booktime = $data_order['order_time'];

            //lay kich ban cham soc dc kich hoat
            $result_h = $db->query('SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_scenario_header WHERE proid =' . $proid );
            while ( $data = $result_h->fetch()){
                if( $data['status'] == 1 ){
                    $customer['phone'] = $data_order['order_phone'];
                    $customer['fullname'] = $data_order['order_name'];
                    $customer['email'] = $data_order['order_email'];
                    $customer['address'] = $data_order['order_address'];
                    $customer['gender'] = 2;

                    $sql = 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_scenario_detail WHERE status=1 AND scenarioid =' . $data['id'];
                    $result = $db->query($sql);
                    while ( $row = $result->fetch()){

                        $receiver = '';
                        if( $row['sendtype'] == 1 || $row['sendtype'] == 3 ){
                            $receiver = $data_order['order_phone'];
                        }elseif( $row['sendtype'] == 2 ){
                            $receiver = $data_order['order_email'];
                        }
                        //co nguoi nhan thi moi tao noi dung cham soc
                        if( !empty( $receiver )){
                            $title = nv_build_content_customer($row['sendtype'], $row['title'], $customer);
                            $content = nv_build_content_customer($row['sendtype'], $row['content'], $customer);

                            //neu mua hang nhan ngay thi chinh lai thoi gian gui sms ngay sau thoi diem mua hang 1h
                            $timesend = 0;
                            if( $day_received == 0 && $row['daysend'] == 0){
                                $timesend = $booktime + 3600;
                            }
                            else{
                                $timesend = $booktime + (( $day_received + $row['daysend']) * 86400 );
                            }
                            //neu thoi gian gui sms thoa man dk lon hon thoi diem hien tai
                            if( $timesend > NV_CURRENTTIME ){
                                $sql = 'INSERT INTO ' . NV_PREFIXLANG . '_' . $module_data . '_message_queue( order_id, proid, sid, sid_detail, title, receiver, content, timesend, sendtype, active ) 
                            VALUES (  ' . intval( $order_id ) . ', ' . intval( $proid ) . ', ' . intval( $data['id'] ) . ', ' . intval( $row['id'] ) . ', ' . $db->quote( $title ) . ', ' . $db->quote( $receiver ) . ', ' . $db->quote( $content ) . ', ' . $timesend . ', ' . intval( $row['sendtype'] ) . ', 1)';
                                $db->query($sql);
                            }
                        }
                    }
                }else{
                    //xoa cac message khong co sid dc kich hoat
                    $db->exec("DELETE FROM " . NV_PREFIXLANG . "_" . $module_data . "_message_queue WHERE sid=" . $data['id']);
                }
            }

        }
    }
}


//update noi dung cham soc khach hang
function nvUpdatemsQueueByDetail( $sid_detail, $active, $insert, $scenarioid )
{
    global $db, $module_data;

    //tao kich ban khi them ban ghi moi
    if( $insert == 1 ){
        //lay thong tin bang header
        $data_scenario_header = $db->query( 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_scenario_header WHERE id=' . $scenarioid )->fetch();

        $result = $db->query('SELECT order_id FROM ' . NV_PREFIXLANG . '_' . $module_data . '_orders_id WHERE proid=' . $data_scenario_header['proid']);
        while( list( $order_id ) = $result->fetch(3)){
            $data_order = $db->query('SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_orders WHERE order_id=' . $order_id )->fetch();
            if(!empty( $data_order )) {

                list( $customer['shop_mobile'] ) = $db->query('SELECT mobile FROM ' . NV_TABLE_AFFILIATE . '_users WHERE userid=' . $data_order['user_id'] )->fetch(3);

                $day_received = ($data_order['order_shipcod'] == 1) ? NV_DEFINE_DAY_RECEIVED : 0;
                $booktime = $data_order['order_time'];

                $customer['phone'] = $data_order['order_phone'];
                $customer['fullname'] = $data_order['order_name'];
                $customer['email'] = $data_order['order_email'];
                $customer['address'] = $data_order['order_address'];
                $customer['gender'] = 2;
                $receiver = '';

                $sql = 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_scenario_detail WHERE id =' . $sid_detail;
                $row = $db->query($sql)->fetch();

                if ($row['sendtype'] == 1 || $row['sendtype'] == 3) {
                    $receiver = $data_order['order_phone'];
                } elseif ($row['sendtype'] == 2) {
                    $receiver = $data_order['order_email'];
                }

                //co nguoi nhan thi moi tao noi dung cham soc
                if (!empty($receiver)) {

                    $title = nv_build_content_customer($row['sendtype'], $row['title'], $customer);
                    $content = nv_build_content_customer($row['sendtype'], $row['content'], $customer);

                    //neu mua hang nhan ngay thi chinh lai thoi gian gui sms ngay sau thoi diem mua hang 1h
                    $timesend = 0;
                    if ($day_received == 0 && $row['daysend'] == 0) {
                        $timesend = $booktime + 3600;
                    } else {
                        $timesend = $booktime + (($day_received + $row['daysend']) * 86400);
                    }

                    //neu thoi gian gui sms thoa man dk lon hon thoi diem hien tai
                    if ($timesend > NV_CURRENTTIME) {
                        $sql = 'INSERT INTO ' . NV_PREFIXLANG . '_' . $module_data . '_message_queue( order_id, proid, sid, sid_detail, title, receiver, content, timesend, sendtype, active ) 
                        VALUES (  ' . intval($order_id) . ', ' . intval($data_scenario_header['proid']) . ', ' . intval($row['scenarioid']) . ', ' . intval($row['id']) . ', ' . $db->quote($title) . ', ' . $db->quote($receiver) . ', ' . $db->quote($content) . ', ' . $timesend . ', ' . intval($row['sendtype']) . ', ' . intval($active) . ')';
                        $db->query($sql);
                    }
                }
            }
        }
    }else{
        $result = $db->query('SELECT id, order_id, proid FROM ' . NV_PREFIXLANG . '_' . $module_data . '_message_queue WHERE sid_detail=' . $sid_detail );

        while ( list( $id, $order_id, $proid ) = $result->fetch(3)){
            //lay thong tin don hang dat cua kh
            $data_order = $db->query('SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_orders WHERE order_id=' . $order_id )->fetch();
            if(!empty( $data_order )){
                $day_received = ($data_order['order_shipcod'] == 1) ? NV_DEFINE_DAY_RECEIVED : 0;
                $booktime = $data_order['order_time'];

                list( $customer['shop_mobile'] ) = $db->query('SELECT mobile FROM ' . NV_TABLE_AFFILIATE . '_users WHERE userid=' . $data_order['user_id'] )->fetch(3);

                $customer['phone'] = $data_order['order_phone'];
                $customer['fullname'] = $data_order['order_name'];
                $customer['email'] = $data_order['order_email'];
                $customer['address'] = $data_order['order_address'];
                $customer['gender'] = 2;

                $sql = 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_scenario_detail WHERE id =' . $sid_detail;
                $row = $db->query($sql)->fetch();

                $receiver = '';
                if( $row['sendtype'] == 1 || $row['sendtype'] == 3 ){
                    $receiver = $data_order['order_phone'];
                }elseif( $row['sendtype'] == 2 ){
                    $receiver = $data_order['order_email'];
                }
                //co nguoi nhan thi moi tao noi dung cham soc
                if( !empty( $receiver )){
                    $title = nv_build_content_customer($row['sendtype'], $row['title'], $customer);
                    $content = nv_build_content_customer($row['sendtype'], $row['content'], $customer);

                    //neu mua hang nhan ngay thi chinh lai thoi gian gui sms ngay sau thoi diem mua hang 1h
                    $timesend = 0;
                    if( $day_received == 0 && $row['daysend'] == 0){
                        $timesend = $booktime + 3600;
                    }
                    else{
                        $timesend = $booktime + (( $day_received + $row['daysend']) * 86400 );
                    }

                    $sql = 'UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_message_queue SET 
                    order_id=' . intval( $order_id ) . ', proid=' . intval( $proid ) . ', 
                    sid=' . intval( $row['scenarioid'] ) . ', 
                    sid_detail=' . intval( $row['id'] ) . ', 
                    title=' . $db->quote( $title ) . ', 
                    receiver=' . $db->quote( $receiver ) . ', 
                    content=' . $db->quote( $content ) . ', 
                    timesend=' . $timesend . ', 
                    sendtype=' . intval( $row['sendtype'] ) . ', active=' . $active . ' WHERE id=' . $id;
                    $db->query($sql);

                }
            }
        }
    }

}

//nhap hang cho thanh vien
function adminnhapkhohanghoa( $customerid, $depotid, $productid, $quantity, $price, $type, $typeorder = 3, $order_id = 0 ){

    global $db, $module_data;

    $customerid = intval($customerid);
    if ( $productid > 0 and $quantity > 0 ) {
        //khong phai khach le
        if( $typeorder != 3 ) {
            $sql = 'SELECT COUNT(*) FROM ' . NV_PREFIXLANG . '_' . $module_data . '_warehouse_logs WHERE customerid=' . $customerid . ' AND productid=' . $productid . ' AND depotid=' . $depotid;
            $check_exits = $db->query($sql)->fetchColumn();
            if ($check_exits == 0) {
                $sql = 'INSERT INTO ' . NV_PREFIXLANG . '_' . $module_data . '_warehouse_logs( customerid, depotid, productid, quantity_in, price_in, quantity_out, price_out ) 
                VALUES ( ' . $customerid . ', ' . $depotid . ', ' . $productid . ', ' . $quantity . ', 0, 0, ' . $price . ')';

                $res = $db->query($sql);
            } else {
                $sql = 'UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_warehouse_logs SET quantity_in = quantity_in ' . $type . ' ' . $quantity . ', price_out= price_out ' . $type . ' ' . $price . ' WHERE customerid =' . $customerid . ' AND productid=' . $productid . ' AND depotid=' . $depotid;
                $res = $db->query($sql);
            }
            save_warehouse_order_customer( $quantity, $price, $customerid, $depotid, $productid, $type, $order_id );
        }
    }
}