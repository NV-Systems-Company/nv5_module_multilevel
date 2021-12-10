<?php

/**
 * @Project NUKEVIET 4.x
 * @Author NVholding <contact@nvholding.vn>
 * @Copyright (C) 2021 NVholding. All rights reserved
 * @License: Not free read more http://nukeviet.vn/vi/store/modules/nvtools/
 * @Createdate Sat, 17 Jul 2021 08:08:05 GMT
 */

if (!defined('NV_SYSTEM'))
    die('Stop!!!');

define('NV_IS_MOD_MULTILEVEL', true);
define('TABLE_LOCALION_NAME', NV_PREFIXLANG . "_" . $module_data);
require NV_ROOTDIR . '/modules/' . $module_file . '/global.functions.php';
function nv_Province()
{
    global $db, $module_data;
	$list = array();
    $sql = "SELECT * FROM " . NV_PREFIXLANG . "_" . $module_data . "_province WHERE status=1 ORDER BY weight ASC";
	$result = $db->query( $sql );
    while( $row = $result->fetch() )
    {
        $list[$row['id']] = array( //
            'id' => $row['id'], //
            'title' => $row['title'], //
            'weight' => ( int )$row['weight'] //
        );
    }
    return $list;
}
function nv_multilevel_get_path_dir()
{
    global $module_upload, $db;

    $currentpath = $module_upload . '/' . date( 'Ym' );

    if( file_exists( NV_UPLOADS_REAL_DIR . '/' . $currentpath ) )
    {
        $upload_real_dir_page = NV_UPLOADS_REAL_DIR . '/' . $currentpath;
    }
    else
    {
        $upload_real_dir_page = NV_UPLOADS_REAL_DIR . '/' . $module_upload;
        $e = explode( '/', $currentpath );
        if( !empty( $e ) )
        {
            $cp = '';
            foreach( $e as $p )
            {
                if( !empty( $p ) and !is_dir( NV_UPLOADS_REAL_DIR . '/' . $cp . $p ) )
                {
                    $mk = nv_mkdir( NV_UPLOADS_REAL_DIR . '/' . $cp, $p );
                    if( $mk[0] > 0 )
                    {
                        $upload_real_dir_page = $mk[2];
                        try
                        {
                            $db->query( "INSERT INTO " . NV_UPLOAD_GLOBALTABLE . "_dir (dirname, time) VALUES ('" . NV_UPLOADS_DIR . "/" . $cp . $p . "', 0)" );
                        }
                        catch ( PDOException $e )
                        {
                            trigger_error( $e->getMessage() );
                        }
                    }
                }
                elseif( !empty( $p ) )
                {
                    $upload_real_dir_page = NV_UPLOADS_REAL_DIR . '/' . $cp . $p;
                }
                $cp .= $p . '/';
            }
        }
        $upload_real_dir_page = str_replace( '\\', '/', $upload_real_dir_page );
    }

    $currentpath = str_replace( NV_ROOTDIR . '/', '', $upload_real_dir_page );
    return $currentpath;
}


function get_sub_nodes_shops( $parentid )
{
    global $db_config, $module_data, $db, $user_data_affiliate;

    $sql = 'SELECT t1.*, t2.numsubcat, t2.code, t2.possitonid, t2.lev, t2.agencyid, t2.provinceid, t2.status, t2.pendingdelete FROM ' . NV_USERS_GLOBALTABLE . ' AS t1 INNER JOIN ' . NV_PREFIXLANG . '_' . $module_data . '_users AS t2 ON t1.userid=t2.userid WHERE t2.ishidden=0 AND t2.parentid=' . $parentid . ' ORDER BY t2.sort';

    if( $user_data_affiliate['permission'] == 0 ){
        $sql .= ' AND t2.status=1';
    }
    $res = $db->query( $sql );
    while( $tmp = $res->fetch() )
    {
        $array_data[] = $tmp;
    }
    return $array_data;
}
