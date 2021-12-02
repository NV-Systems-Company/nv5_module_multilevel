<?php

/**
 * @Project NUKEVIET 4.x
 * @Author NVholding <contact@nvholding.vn>
 * @Copyright (C) 2021 NVholding. All rights reserved
 * @License: Not free read more http://nukeviet.vn/vi/store/modules/nvtools/
 * @Createdate Sat, 17 Jul 2021 08:08:05 GMT
 */

if (!defined('NV_MAINFILE'))
    die('Stop!!!');

$module_version = array(
    'name' => 'Multilevel',
    'modfuncs' => 'main,detail,search,register,customer,customer_groups,order,or_view,warranty,manager_npp,manager,reward,memberlist,agency,possiton,usersp,staff,users,product,shareholder,shareholded,warehouselogs,importplan,discounts,saleoff,depot,agencycontent,maps',
    'change_alias' => 'main,detail,search',
    'submenu' => 'main,detail,search,register,customer,customer_groups,order,warranty,manager,manager_npp,reward,memberlist,agency,possiton,usersp,staff,users,product,shareholder,shareholded,warehouselogs,importplan,discounts,saleoff,depot,agencycontent,maps',
    'is_sysmod' => 1,
    'virtual' => 0,
    'version' => '4.3.03',
    'date' => 'Sat, 17 Jul 2021 08:08:05 GMT',
    'author' => 'NVholding (contact@nvholding.vn)',
    'uploads_dir' => array($module_name),
    'note' => 'Module quản lý user đa cấp'
);