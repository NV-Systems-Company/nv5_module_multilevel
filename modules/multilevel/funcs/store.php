<?php

/**
 * @Project NUKEVIET 4.x
 * @Author NV SYSTEMS LTD <hoangnt@nguyenvan.vn>
 * @Copyright (C) 2019 NV SYSTEMS LTD. All rights reserved
 * @License: Not free read more http://nukeviet.systems/
 * @Createdate Sun, 17 Mar 2019 11:32:42 GMT
 */
if ( ! defined( 'NV_IS_MOD_MULTILEVEL' ) ) die( 'Stop!!!' );


$page_title = $module_info['custom_title'];
$key_words = $module_info['keywords'];
define('STORE', $db_config['dbsystem']. '.' .NV_PREFIXLANG. '_' . $module_data );
$global_config['module_theme'] = $global_config['site_theme'];
print_r($global_config['site_theme']);
$xtpl = new XTemplate( 'store.tpl', NV_ROOTDIR . '/themes/' . $global_config['site_theme'] . '/modules/' . $module_file );
			
			$xtpl->assign( 'NV_BASE_SITEURL', NV_BASE_SITEURL );
			$xtpl->assign( 'module_name', $module_name );
			
			$base_url = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op;
			
			
		   $id_province  = $id_district = $id_ward = 0;
		   
		   $where ='';
			$catid_search = 0;
			if(count($array_op) > 0)
			{
				

					
					// tiếp tục phân tích tỉnh thành quận huyện xã phường
					if(!empty($array_op[1]))
					{
						// TÌM ID TỈNH THÀNH DỰA VÀO ALIAS 
						$id_province = $db->query("SELECT id FROM ".$db_config['dbsystem']. "." . STORE . "_province WHERE alias like '". $array_op[1] ."'  ORDER BY weight ASC")->fetchColumn();
						if($id_province > 0)
						{
							$base_url .= '/'.$array_op[1];
							$where .=' AND provinceid='.$id_province;
						}
					}
					
					if(!empty($array_op[1]) and !empty($array_op[2]) and $id_province > 0 )
					{
						$id_district = $db->query("SELECT id FROM ".$db_config['dbsystem']. "." . STORE . "_district WHERE provinceid =". $id_province ." AND alias like '". $array_op[2] ."'")->fetchColumn();
						if($id_district > 0)
						{
							$base_url .= '/'. $array_op[2];
							$where .=' AND districtid='.$id_district;
						}
					}
					
					if(!empty($array_op[1]) and !empty($array_op[2]) and !empty($array_op[3])  and $id_tinhthanh > 0 and $id_district > 0)
					{
						$id_ward = $db->query("SELECT ward_id FROM ".$db_config['dbsystem']. "." . STORE . "_ward WHERE  districtid =". $id_district ." AND alias like '". $array_op[3] ."'")->fetchColumn();
						if($id_ward > 0)
						{
							$base_url .= '/'. $array_op[3];
							$where .=' AND wardid='.$id_ward;
						}
					}
					
				
				
				
				
				
				
			}
			
			
			
			
			// $sql = 'SELECT * FROM '. STORE . '_rows WHERE status=1 '. $where .' ORDER BY weight DESC';
			 
			$per_page = 20;
			$page = $nv_Request->get_int( 'page', 'post,get', 1 );
			$db->sqlreset()
				->select( 'COUNT(*)' )
				->from( '' . STORE . '_users mu' )
				->join('LEFT JOIN ' . NV_USERS_GLOBALTABLE . ' u ON mu.userid = u.userid')
				->where('status=1 '. $where);
			$sth = $db->prepare( $db->sql() );

			$sth->execute();
			$num_items = $sth->fetchColumn();

			$db->select( 'mu.*,u.photo as photo, mu.img_map as image' )
				->order( 'weight ASC' )
				->limit( $per_page )
				->offset( ( $page - 1 ) * $per_page );
			$sth = $db->prepare( $db->sql() );

			$sth->execute();
			
			
			$generate_page = nv_generate_page( $base_url, $num_items, $per_page, $page );
			if( !empty( $generate_page ) )
			{
				$xtpl->assign( 'NV_GENERATE_PAGE', $generate_page );
				$xtpl->parse( 'main.generate_page' );
			}
			
			 //$list_store = $db->query($sql)->fetchAll();
			// print_r($sql);die; 
			while( $row = $sth->fetch() )
			{
				$row['link'] = nv_url_rewrite(NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $row['username'],true);
				$row['googmaps'] = @unserialize( $row['googmaps'] );
				if( $row['googmaps'] )
				{
					$xtpl->assign( 'lat', isset( $row['googmaps']['lat'] ) ? $row['googmaps']['lat'] : '' );
					$xtpl->assign( 'lng', isset( $row['googmaps']['lng'] ) ? $row['googmaps']['lng'] : '' );
					$xtpl->assign( 'zoom', isset( $row['googmaps']['zoom'] ) ? $row['googmaps']['zoom'] : '' );
				}else{
					$xtpl->assign( 'lat', 21.01324600018122 );
					$xtpl->assign( 'lng', 105.83596636250002 );
					$xtpl->assign( 'GOOGLEMAPZOOM1', 15 );
				}
				// HÌNH ẢNH LOẠI
				if($row['img_map'] != ''){
					$image=NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' .$module_upload. '/' .$row['image'];
				}else{
					$image=NV_BASE_SITEURL . 'themes/' . $global_config['site_theme'] . '/images/icons/map-icon.png';
					$row['image'] = NV_BASE_SITEURL . 'themes/' . $global_config['site_theme'] . '/images/no_image.gif';
				}
				$xtpl->assign( 'image', $image);
				$row['province'] = province($row['provinceid']);
				$row['district'] = district($row['districtid']);
				//$row['image'] = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_upload . '/' . $row['image'] ;;
				$xtpl->assign( 'row', $row );
				$xtpl->parse( 'main.loop' );
				$xtpl->parse( 'main.loop_left' );
			}
			$sql = 'SELECT * FROM '  .$db_config['dbsystem']. '.' . NV_PREFIXLANG. '_' . $module_data . '_province ORDER BY weight ASC';
			$global_raovat_city = $nv_Cache->db( $sql, 'id', 'multilevel' );
			foreach( $global_raovat_city as $key => $item )
			{
				$xtpl->assign( 'CITY', array(
					'key' => $key,
					'alias' =>  $item['alias'],
					'name' => $item['title'],
					'selected' => ( $id_province == $key ) ? 'selected="selected"' : '' ) );
				$xtpl->parse( 'main.city' );
			}
			if( $id_province )
			{
				$sql = 'SELECT districtid, title, alias, type FROM ' . NV_PREFIXLANG. '_' . $module_data . '_district WHERE status = 1 AND provinceid= ' . intval( $id_tinhthanh ) . ' ORDER BY weight ASC';
				$result = $db->query( $sql );
				while( $data = $result->fetch() )
				{
					$xtpl->assign( 'DISTRICT', array(
						'key' => $data['districtid'],
						'alias' =>  $data['alias'],
						'type' =>  $data['type'],
						'name' => $data['title'],
						'selected' => ( $data['districtid'] == $id_district) ? 'selected="selected"' : '' ) );
					$xtpl->parse( 'main.district' );
				}
			}
			if( $id_district )
			{
				$sql = 'SELECT wardid, title, alias, type FROM ' . NV_PREFIXLANG. '_' . $module_data . '_ward WHERE status = 1 AND districtid= ' . intval( $id_quanhuyen );
				$result = $db->query( $sql );
				while( $data = $result->fetch() )
				{
					$xtpl->assign( 'WARD', array(
						'key' => $data['wardid'],
						'alias' =>  $data['alias'],
						'type' =>  $data['type'],
						'name' => $data['title'],
						'selected' => ( $data['wardid'] == $id_ward ) ? 'selected="selected"' : '' ) );
					$xtpl->parse( 'main.ward' );
				}
			}
			
			
            $xtpl->parse( 'main' );
			$contents = $xtpl->text( 'main' );

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme( $contents );
include NV_ROOTDIR . '/includes/footer.php';
